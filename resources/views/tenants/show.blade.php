@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl">

        {{-- Header --}}
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Detail Penghuni
                </h1>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Informasi lengkap data penghuni.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('tenants.index') }}"
                    class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                    Kembali
                </a>

                <a href="{{ route('tenants.edit', $tenant) }}"
                    class="rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                    Edit Penghuni
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- Profil --}}
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-6 text-center">

                    <div
                        class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-brand-100 text-3xl font-semibold text-brand-600 dark:bg-brand-500/10 dark:text-brand-400">
                        {{ strtoupper(substr($tenant->user->name, 0, 1)) }}
                    </div>

                    <h2 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white/90">
                        {{ $tenant->user->name }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {{ $tenant->user->email }}
                    </p>

                    <div class="mt-4">
                        <span
                            class="inline-flex rounded-full bg-success-50 px-3 py-1 text-xs font-medium text-success-600 dark:bg-success-500/10 dark:text-success-400">
                            Penghuni
                        </span>
                    </div>
                </div>
            </div>

            {{-- Data Pribadi --}}
            <div
                class="lg:col-span-2 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white/90">
                        Data Pribadi
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2">

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            NIK
                        </p>

                        <p class="mt-1 font-medium text-gray-800 dark:text-white/90">
                            {{ $tenant->nik }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Nomor Telepon
                        </p>

                        <p class="mt-1 font-medium text-gray-800 dark:text-white/90">
                            {{ $tenant->phone }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Jenis Kelamin
                        </p>

                        <p class="mt-1 font-medium text-gray-800 dark:text-white/90">
                            {{ $tenant->gender }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Tempat, Tanggal Lahir
                        </p>

                        <p class="mt-1 font-medium text-gray-800 dark:text-white/90">
                            {{ $tenant->birth_place }},
                            {{ $tenant->birth_date->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Pekerjaan
                        </p>

                        <p class="mt-1 font-medium text-gray-800 dark:text-white/90">
                            {{ $tenant->occupation }}
                        </p>
                    </div>

                    <div class="sm:col-span-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Alamat
                        </p>

                        <p class="mt-1 font-medium text-gray-800 dark:text-white/90">
                            {{ $tenant->address }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- Kontak Darurat --}}
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white/90">
                        Kontak Darurat
                    </h2>
                </div>

                <div class="space-y-5 p-6">

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Nama
                        </p>

                        <p class="mt-1 font-medium text-gray-800 dark:text-white/90">
                            {{ $tenant->emergency_contact_name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Nomor Telepon
                        </p>

                        <p class="mt-1 font-medium text-gray-800 dark:text-white/90">
                            {{ $tenant->emergency_contact_phone }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- Akun --}}
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white/90">
                        Informasi Akun
                    </h2>
                </div>

                <div class="space-y-5 p-6">

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Nama
                        </p>

                        <p class="mt-1 font-medium text-gray-800 dark:text-white/90">
                            {{ $tenant->user->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Email
                        </p>

                        <p class="mt-1 font-medium text-gray-800 dark:text-white/90">
                            {{ $tenant->user->email }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- Dokumen --}}
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white/90">
                        Dokumen Identitas
                    </h2>
                </div>

                <div class="p-6">
                    @if ($tenant->identity_document)
                        <a href="{{ Storage::url($tenant->identity_document) }}" target="_blank"
                            class="inline-flex items-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                            Lihat Dokumen
                        </a>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Belum ada dokumen identitas.
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
