@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-screen-7xl">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">

            {{-- Title --}}
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Tambah Tipe Kamar
                </h1>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Tambahkan tipe kamar baru.
                </p>
            </div>

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm">

                <a href="{{ route('dashboard') }}"
                    class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500">
                    Home
                </a>

                <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>

                <a href="{{ route('room-types.index') }}"
                    class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500">
                    Room Types
                </a>

                <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>

                <span class="font-medium text-gray-800 dark:text-white">
                    Tambah
                </span>

            </div>

        </div>

        {{-- Form --}}
        <div
            class="rounded-2xl border border-gray-200 bg-white p-5
        dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">

            <form action="{{ route('room-types.store') }}" method="POST">
                @csrf

                {{-- Name --}}
                <div class="mb-5">
                    <label for="name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Tipe Kamar
                    </label>

                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Contoh: Standard" required
                        class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                    text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400
                    focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                    dark:border-gray-700 dark:bg-gray-900 dark:text-white/90
                    dark:placeholder:text-gray-400 dark:focus:border-brand-800">

                    @error('name')
                        <p class="mt-1 text-sm text-error-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-6">
                    <label for="description" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Deskripsi
                    </label>

                    <textarea id="description" name="description" rows="4" placeholder="Contoh: Kamar standar dengan fasilitas dasar."
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                    text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400
                    focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                    dark:border-gray-700 dark:bg-gray-900 dark:text-white/90
                    dark:placeholder:text-gray-400 dark:focus:border-brand-800">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-error-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Button --}}
                <div class="flex items-center justify-end gap-3">

                    <a href="{{ route('room-types.index') }}"
                        class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm
                    font-medium text-gray-700 hover:bg-gray-50
                    dark:border-gray-700 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                        Batal
                    </a>

                    <button type="submit"
                        class="rounded-lg bg-brand-500 px-4 py-2.5 text-sm
                    font-medium text-white shadow-theme-xs hover:bg-brand-600">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection
