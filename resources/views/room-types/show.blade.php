@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-screen-7xl">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Detail Tipe Kamar
                </h1>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Informasi detail tipe kamar.
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
                    Detail
                </span>

            </div>

        </div>

        {{-- Detail --}}
        <div
            class="rounded-2xl border border-gray-200 bg-white p-5
        dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- Name --}}
                <div>
                    <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                        Nama Tipe Kamar
                    </p>

                    <p class="font-medium text-gray-800 dark:text-white/90">
                        {{ $roomType->name }}
                    </p>
                </div>

                {{-- Created At --}}
                <div>
                    <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                        Dibuat
                    </p>

                    <p class="font-medium text-gray-800 dark:text-white/90">
                        {{ $roomType->created_at->format('d M Y H:i') }}
                    </p>
                </div>

                {{-- Description --}}
                <div class="md:col-span-2">
                    <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                        Deskripsi
                    </p>

                    <p class="text-gray-800 dark:text-white/90">
                        {{ $roomType->description ?? '-' }}
                    </p>
                </div>

            </div>

            {{-- Action --}}
            <div class="mt-6 flex justify-end gap-3">

                <a href="{{ route('room-types.index') }}"
                    class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm
                font-medium text-gray-700 hover:bg-gray-50
                dark:border-gray-700 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                    Kembali
                </a>

                <a href="{{ route('room-types.edit', $roomType) }}"
                    class="rounded-lg bg-brand-500 px-4 py-2.5 text-sm
                font-medium text-white hover:bg-brand-600">
                    Edit
                </a>

            </div>

        </div>

    </div>
@endsection
