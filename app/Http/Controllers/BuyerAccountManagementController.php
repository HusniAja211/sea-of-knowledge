<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Role;

class BuyerAccountManagementController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        
        $this->authorizeResource(User::class, 'user');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $threshold = now()->subSeconds(60);
        $search = $request->search;

        $buyers = User::with('role')
            ->whereHas('role', function ($query) {
                $query->where('name', 'buyer');
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
                });
            })
            ->orderByRaw('created_at >= ? DESC', [$threshold])
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.buyer-account-management.index', compact('buyers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('pages.admin.buyer-account-management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'nik'      => 'required|digits:16|unique:users,nik',
            'password' => 'required|min:8',
            'address'  => 'nullable|string|max:500',
            'pfp'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'crop_data' => 'nullable|string', // JSON crop info
        ]);

        // Ambil role dari db
        $role = Role::where('name', 'buyer')->firstOrFail();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nik' => $validated['nik'],
            'password' => Hash::make($validated['password']),
            'address' => $validated['address'] ?? null,
            'role_id' => $role->id,
        ]);        

        // Upload & crop avatar jika ada
        if ($request->filled('crop_data')) {

            if (!str_starts_with($request->crop_data, 'data:image/png;base64,')) {
                abort(422, 'Invalid image format');
            }

            $image = str_replace('data:image/png;base64,', '', $request->crop_data);
            $image = str_replace(' ', '+', $image);

            $decoded = base64_decode($image);

            if (strlen($decoded) > 2 * 1024 * 1024) {
                abort(422, 'Image too large');
            }

            $filename = 'avatars/' . $user->id . '_' . time() . '.png';

            Storage::disk('public')->put($filename, $decoded);

            $user->update([
                'pfp' => $filename
            ]);
        }

        return redirect()->route('admin.buyer.index')
            ->with('success', 'Buyer successfully added.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.admin.buyer-account-management.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'nik' => 
            [
                'nullable',
                'digits:16',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'address' => 'nullable|string|max:500',
            'pfp'  => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

          $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nik' => $validated['nik'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        // Upload & crop avatar jika ada
        if ($request->filled('crop_data')) {

            // HAPUS FILE LAMA
            if ($user->pfp && Storage::disk('public')->exists($user->pfp)) {
                Storage::disk('public')->delete($user->pfp);
            }

            if (!str_starts_with($request->crop_data, 'data:image/png;base64,')) {
                abort(422, 'Invalid image format');
            }

            $image = str_replace('data:image/png;base64,', '', $request->crop_data);
            $image = str_replace(' ', '+', $image);

            $decoded = base64_decode($image);

            if (strlen($decoded) > 2 * 1024 * 1024) {
                abort(422, 'Image too large');
            }

            $filename = 'avatars/' . $user->id . '_' . time() . '.png';

            Storage::disk('public')->put($filename, $decoded);

            $user->update([
                'pfp' => $filename
            ]);
        }

         return redirect()
            ->route('admin.buyer.index')
            ->with('success', 'Buyer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
         // if ($category->products()->exists()) {
        //     return redirect()->route('admin.buyer.index')
        //         ->with('error', 'Cannot delete buyer data with associated products.');
        // }

        $user->delete();
        return redirect()->route('admin.buyer.index')
            ->with('success', 'Buyer deleted successfully.');
    }
}
