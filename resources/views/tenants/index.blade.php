@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-screen-7xl" x-data="{
        confirmModal: false,
        deleteUrl: null,
    
        openDeleteModal(url) {
            this.deleteUrl = url
            this.confirmModal = true
        },
    
        confirmDelete() {
            this.$refs.deleteForm.action = this.deleteUrl
            this.$refs.deleteForm.submit()
        }
    }">

        <div class="mb-6 flex items-center justify-between">
            {{-- Title --}}
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Daftar Penghuni
                </h1>
            </div>

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('dashboard') }}"
                    class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500">
                    Home
                </a>

                <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>

                <a href="{{ route('tenants.index') }}"
                    class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500">
                    Tenants
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4
            dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">

            {{-- Table Header --}}
            <div class="mb-4 flex items-center justify-end">
                <div class="flex items-center gap-3">
                    <a href="{{ route('tenants.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5
                        text-theme-sm font-medium text-white shadow-theme-xs
                        hover:bg-brand-600">
                        Tambah Penghuni
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <div class="max-w-full overflow-x-auto custom-scrollbar">

                <table class="min-w-full">

                    <thead>
                        <tr class="border-t border-gray-100 dark:border-gray-800">

                            <th class="py-3 text-start">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Nama
                                </p>
                            </th>

                            <th class="py-3 text-start">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Email
                                </p>
                            </th>

                            <th class="py-3 text-start">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    No. Telepon
                                </p>
                            </th>

                            <th class="py-3 text-start">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Pekerjaan
                                </p>
                            </th>

                            <th class="py-3 text-start">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Kamar
                                </p>
                            </th>

                            <th class="py-3 text-start">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Status Sewa
                                </p>
                            </th>

                            <th class="py-3 text-start">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Action
                                </p>
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($tenants as $tenant)
                            @php
                                $activeRental = $tenant->rentals->where('status', 'active')->first();
                            @endphp

                            <tr class="border-t border-gray-100 dark:border-gray-800">

                                {{-- Penghuni --}}
                                <td class="py-3 whitespace-nowrap">

                                    <div class="flex items-center gap-3">

                                        {{-- Avatar --}}
                                        {{-- <div
                                            class="flex h-[50px] w-[50px] items-center justify-center
                                            overflow-hidden rounded-full bg-brand-50
                                            text-brand-500 dark:bg-brand-500/15">
                                            <span class="text-lg font-semibold">
                                                {{ strtoupper(substr($tenant->user->name, 0, 1)) }}
                                            </span>
                                        </div> --}}

                                        <div>

                                            <p
                                                class="font-medium text-gray-800 text-theme-sm
                                                dark:text-white/90 capitalize ">
                                                {{ $tenant->user->name }}
                                            </p>

                                        </div>

                                    </div>

                                </td>

                                {{-- Email --}}
                                <td class="py-3 whitespace-nowrap">

                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $tenant->user->email }}
                                    </p>

                                </td>

                                {{-- Phone --}}
                                <td class="py-3 whitespace-nowrap">

                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $tenant->phone }}
                                    </p>

                                </td>

                                {{-- Occupation --}}
                                <td class="py-3 whitespace-nowrap">

                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $tenant->occupation }}
                                    </p>

                                </td>

                                {{-- Room --}}
                                <td class="py-3 whitespace-nowrap">

                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $activeRental?->room?->room_number ?? '-' }}
                                    </p>

                                </td>

                                {{-- Status --}}
                                <td class="py-3 whitespace-nowrap">

                                    @if ($activeRental)
                                        <span
                                            class="rounded-full bg-success-50 px-2 py-0.5
                                            text-theme-xs font-medium text-success-600
                                            dark:bg-success-500/15 dark:text-success-500">
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="rounded-full bg-gray-50 px-2 py-0.5
                                            text-theme-xs font-medium text-gray-600
                                            dark:bg-gray-500/15 dark:text-gray-400">
                                            Belum Sewa
                                        </span>
                                    @endif

                                </td>

                                {{-- Action --}}
                                <td class="py-3 whitespace-nowrap">
                                    <div class="flex items-center gap-3">

                                        {{-- Detail --}}
                                        <a href="{{ route('tenants.show', $tenant) }}" title="Detail"
                                            class="text-brand-500 hover:text-brand-600">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('tenants.edit', $tenant) }}" title="Edit"
                                            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        {{-- Hapus --}}
                                        <button type="button" title="Hapus"
                                            @click="openDeleteModal('{{ route('tenants.destroy', $tenant) }}')"
                                            class="text-red-500 hover:text-red-600">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada data penghuni.
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Form DELETE --}}
            <form x-ref="deleteForm" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>

            {{-- Modal --}}
            <x-confirm-modal title="Hapus Penghuni"
                message="Apakah Anda yakin ingin menghapus penghuni ini? Data yang sudah dihapus tidak dapat dikembalikan."
                confirm-text="Ya, Hapus" cancel-text="Batal" />

        </div>

    </div>
@endsection
