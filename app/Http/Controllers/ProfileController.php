<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // Upload & crop avatar jika ada
        if ($request->filled('crop_data')) {
            
            $user = $request->user();

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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
