@php
    use App\Models\User;

@endphp

<x-app-layout>
    <x-slot:title>
        Buyers
    </x-slot:title>

    <main class="min-h-screen py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">

            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
                <div>
                    <h1 class="text-4xl font-extrabold text-secondary tracking-tight">
                        Buyers <span class="text-primary underline decoration-tertiary/30 text-5xl">.</span>
                    </h1>
                    <p class="text-slate-500 mt-2 flex items-center gap-2">
                        <span class="w-8 h-[2px] bg-tertiary"></span>
                        Manage and organize buyers account effectively.
                    </p>
                </div>

                @can('create', User::class)
                    <a href="{{ route('admin.buyer.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-primary hover:bg-tertiary text-white text-sm font-bold rounded-xl shadow-lg shadow-primary/20 transition-all duration-300 hover:-translate-y-1 gap-2 group">
                        <div class="bg-white/20 p-1 rounded-md group-hover:rotate-90 transition-transform duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </div>
                        Add New buyer
                    </a>
                @endcan
            </div>
            {{-- <div
                class="flex flex-col bg-background rounded-xl shadow-lg p-8 text-white relative overflow-hidden border-b-4 border-accent md:flex-row md:items-center justify-between mb-10 gap-6">
                <div>
                    <h1 class="text-4xl font-extrabold text-secondary tracking-tight">
                        Categories <span class="text-primary underline decoration-tertiary/30 text-5xl">.</span>
                    </h1>
                    <p class="text-slate-500 mt-2 flex items-center gap-2">
                        <span class="w-8 h-[2px] bg-tertiary"></span>
                        Manage and organize your classification tags effectively.
                    </p>
                </div>

                @can('create', seller::class)
                    <a href="{{ route('admin.buyer.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-primary hover:bg-tertiary text-white text-sm font-bold rounded-xl shadow-lg shadow-primary/20 transition-all duration-300 hover:-translate-y-1 gap-2 group">
                        <div class="bg-white/20 p-1 rounded-md group-hover:rotate-90 transition-transform duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </div>
                        Add New seller
                    </a>
                @endcan
            </div> --}}

            {{-- 📋 Categories Table Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        {{-- Table Head --}}
                        <thead class="bg-primary">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-widest w-20">
                                    ID</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-widest">
                                    Seller Name</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-widest">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-widest">
                                    Role ID</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-widest">
                                    Created At</th>
                                <th scope="col"
                                    class="px-6 py-4 text-right text-xs font-bold text-white uppercase tracking-widest">
                                    Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-slate-50">
                            @forelse ($buyers as $buyer)
                                <tr
                                    class="transition-all duration-300 ease-in-out group border-l-4 border-transparent hover:border-primary hover:bg-slate-50">

                                    {{-- ID --}}
                                    <td class="px-6 py-5 pl-8 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 bg-slate-100 text-tertiary rounded-md text-xs font-bold font-mono border border-slate-200/50">
                                            #{{ str_pad($buyer->id, 3, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>

                                    {{-- Name --}}
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div
                                            class="text-sm font-bold text-secondary group-hover:text-primary transition-colors">
                                            {{ $buyer->name }}
                                        </div>
                                    </td>

                                    {{-- Email --}}
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm text-slate-500 lowercase">
                                            {{ $buyer->email }}
                                        </div>
                                    </td>

                                    {{-- Role ID (Styled as Badge) --}}
                                    <td class="px-6 py-5 whitespace-nowrap text-center">
                                        <span
                                            class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-black uppercase border border-blue-100">
                                            ID: {{ $buyer->role_id }}
                                        </span>
                                    </td>

                                    {{-- Created At --}}
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-xs text-slate-400 font-medium">
                                            {{ $buyer->created_at->format('d M Y') }}
                                            <span
                                                class="block text-[10px] text-slate-300">{{ $buyer->created_at->diffForHumans() }}</span>
                                        </div>
                                    </td>

                                    {{-- Action Control --}}
                                    <td class="px-6 py-5 whitespace-nowrap text-right">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ route('admin.buyer.edit', $buyer->id) }}"
                                                class="p-2 bg-white border border-slate-200 text-tertiary hover:bg-tertiary hover:text-white rounded-lg transition-all duration-200 shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>

                                            <button type="button"
                                                onclick="confirmDelete('{{ route('admin.buyer.destroy', $buyer->id) }}')"
                                                class="p-2 bg-white border border-red-100 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all duration-200 shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-12 text-center text-slate-400 italic">
                                        No buyers data available at the moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                @if ($buyers->hasPages())
                    <div class="px-8 py-5 bg-slate-50 border-t border-slate-100">
                        {{ $buyers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
</x-app-layout>
