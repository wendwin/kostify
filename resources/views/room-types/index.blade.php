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
        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">

            {{-- Title --}}
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Daftar Tipe Kamar
                </h1>
            </div>

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('dashboard') }}"
                    class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500">
                    Home
                </a>

                <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>

                <span class="font-medium text-gray-800 dark:text-white">
                    Room Types
                </span>
            </div>

        </div>

        {{-- Table --}}
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4
            dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">

            {{-- Table Header --}}
            <div class="mb-4 flex items-center justify-end">
                <div class="flex items-center gap-3">

                    <a href="{{ route('room-types.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5
                    text-theme-sm font-medium text-white shadow-theme-xs
                    hover:bg-brand-600">
                        Tambah Tipe Kamar
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
                                    Deskripsi
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

                        @forelse ($roomTypes as $roomType)
                            <tr class="border-t border-gray-100 dark:border-gray-800">

                                {{-- Name --}}
                                <td class="py-3 whitespace-nowrap">
                                    <p
                                        class="font-medium text-gray-800 text-theme-sm
                                    dark:text-white/90">
                                        {{ $roomType->name }}
                                    </p>
                                </td>

                                {{-- Description --}}
                                <td class="py-3">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $roomType->description ?? '-' }}
                                    </p>
                                </td>

                                {{-- Action --}}
                                <td class="py-3 whitespace-nowrap">
                                    <div class="flex items-center gap-3">

                                        {{-- Detail --}}
                                        <a href="{{ route('room-types.show', $roomType) }}" title="Detail"
                                            class="text-brand-500 hover:text-brand-600">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('room-types.edit', $roomType) }}" title="Edit"
                                            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        {{-- Hapus --}}
                                        <button type="button" title="Hapus"
                                            @click="openDeleteModal('{{ route('room-types.destroy', $roomType) }}')"
                                            class="text-red-500 hover:text-red-600">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada tipe kamar.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

        {{-- Form DELETE --}}
        <form x-ref="deleteForm" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        {{-- Modal --}}
        <x-confirm-modal title="Hapus Tipe Kamar"
            message="Apakah Anda yakin ingin menghapus tipe kamar ini? Data yang sudah dihapus tidak dapat dikembalikan."
            confirm-text="Ya, Hapus" cancel-text="Batal" />
    </div>
@endsection
