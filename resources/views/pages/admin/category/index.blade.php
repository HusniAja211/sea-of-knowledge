@php
    use App\Models\Category;

@endphp

<x-app-layout>
    <x-slot:title>
        Categories
    </x-slot:title>

    <main class="min-h-screen py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">

            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
                <div>
                    <h1 class="text-4xl font-extrabold text-secondary tracking-tight">
                        Categories <span class="text-primary underline decoration-tertiary/30 text-5xl">.</span>
                    </h1>
                    <p class="text-slate-500 mt-2 flex items-center gap-2">
                        <span class="w-8 h-[2px] bg-tertiary"></span>
                        Manage and organize your classification tags effectively.
                    </p>
                </div>

                @can('create', Category::class)
                    <a href="{{ route('admin.category.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-primary hover:bg-tertiary text-white text-sm font-bold rounded-xl shadow-lg shadow-primary/20 transition-all duration-300 hover:-translate-y-1 gap-2 group">
                        <div class="bg-white/20 p-1 rounded-md group-hover:rotate-90 transition-transform duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </div>
                        Add New Category
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

                @can('create', Category::class)
                    <a href="{{ route('admin.category.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-primary hover:bg-tertiary text-white text-sm font-bold rounded-xl shadow-lg shadow-primary/20 transition-all duration-300 hover:-translate-y-1 gap-2 group">
                        <div class="bg-white/20 p-1 rounded-md group-hover:rotate-90 transition-transform duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </div>
                        Add New Category
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
                                    class="px-8 py-4 text-left text-xs font-bold text-white uppercase tracking-widest w-24">
                                    ID
                                </th>
                                <th scope="col"
                                    class="px-8 py-4 text-left text-xs font-bold text-white uppercase tracking-widest">
                                    Category Name
                                </th>
                                <th scope="col"
                                    class="px-8 py-4 text-right text-xs font-bold text-white uppercase tracking-widest">
                                    Action Control
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-slate-50">
                            @forelse ($categories as $category)
                                <tr
                                    class="transition-all duration-300 ease-in-out group border-l-4 border-transparent hover:border-primary hover:bg-slate-300">

                                    <td class="px-8 py-5 pl-10 whitespace-nowrap">
                                        <span
                                            class="px-2.5 py-1.5 bg-slate-100 text-tertiary rounded-lg text-xs font-bold font-mono shadow-inner border border-slate-200/50">
                                            #{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>

                                    {{-- Kolom Nama Kategori --}}
                                    <td class="px-8 py-5 whitespace-nowrap">
                                        <span
                                            class="text-base font-semibold text-secondary group-hover:text-primary transition-colors duration-300 uppercase tracking-tight">
                                            {{ $category->name }}
                                        </span>
                                    </td>

                                    {{-- Kolom Action Control --}}
                                    <td class="px-8 py-5 whitespace-nowrap text-right">
                                        <div class="flex justify-end items-center gap-3">
                                            {{-- Edit Button --}}
                                            <a href="{{ route('admin.category.edit', $category->id) }}"
                                                class="inline-flex items-center px-4 py-2.5 bg-white border-2 border-tertiary/20 text-tertiary hover:bg-tertiary hover:text-white hover:border-tertiary text-xs font-bold rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-tertiary/20 hover:-translate-y-0.5">
                                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                                Edit
                                            </a>

                                            {{-- Delete Button --}}
                                            <button type="button"
                                                onclick="confirmDelete('{{ route('admin.category.destroy', $category->id) }}')"
                                                class="inline-flex items-center px-4 py-2.5 bg-white border-2 border-red-100 text-red-500 hover:bg-red-500 hover:text-white hover:border-red-500 text-xs font-bold rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-red-500/20 hover:-translate-y-0.5">
                                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-12 text-center text-slate-400 italic">
                                        No categories data available at the moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                @if ($categories->hasPages())
                    <div class="px-8 py-5 bg-slate-50 border-t border-slate-100">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
</x-app-layout>
