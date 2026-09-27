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
                    Daftar Kamar
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
                    Rooms
                </span>

            </div>

        </div>

        {{-- Table --}}
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4
        dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">

            {{-- Table Header --}}
            <div class="mb-4 flex items-center justify-between gap-4">
                {{-- Filter Tipe Kamar --}}
                <div class="flex items-center gap-1 rounded-lg bg-gray-100 p-1 dark:bg-gray-800">

                    {{-- Semua --}}
                    <a href="{{ route('rooms.index') }}"
                        class="rounded-md px-4 py-2 text-sm font-medium
        {{ !request('type')
            ? 'bg-white text-gray-800 shadow-sm dark:bg-gray-700 dark:text-white'
            : 'text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white' }}">
                        Semua
                    </a>

                    {{-- Tipe Kamar --}}
                    @foreach ($roomTypes as $roomType)
                        <a href="{{ route('rooms.index', ['type' => strtolower($roomType->name)]) }}"
                            class="rounded-md px-4 py-2 text-sm font-medium
            {{ strtolower(request('type')) === strtolower($roomType->name)
                ? 'bg-white text-gray-800 shadow-sm dark:bg-gray-700 dark:text-white'
                : 'text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white' }}">
                            {{ $roomType->name }}
                        </a>
                    @endforeach

                </div>

                {{-- Tambah --}}
                <a href="{{ route('rooms.create') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5
            text-theme-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                    Tambah Kamar
                </a>

            </div>

            {{-- Table --}}
            <div class="max-w-full overflow-x-auto custom-scrollbar">

                <table class="min-w-full">
                    <thead>
                        <tr class="border-t border-gray-100 dark:border-gray-800">

                            <th class="py-3 text-start">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    No. Kamar
                                </p>
                            </th>

                            <th class="py-3 text-start">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Tipe
                                </p>
                            </th>

                            <th class="py-3 text-start">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Harga
                                </p>
                            </th>

                            <th class="py-3 text-start">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Status
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

                        @forelse ($rooms as $room)
                            <tr class="border-t border-gray-100 dark:border-gray-800">

                                {{-- Room Number --}}
                                <td class="py-3 whitespace-nowrap">
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ $room->room_number }}
                                    </p>
                                </td>

                                {{-- Room Type --}}
                                <td class="py-3 whitespace-nowrap">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $room->roomType->name }}
                                    </p>
                                </td>

                                {{-- Price --}}
                                <td class="py-3 whitespace-nowrap">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        Rp {{ number_format($room->price, 0, ',', '.') }}
                                    </p>
                                </td>

                                {{-- Status --}}
                                <td class="py-3 whitespace-nowrap">

                                    @if ($room->status === 'available')
                                        <span
                                            class="rounded-full bg-success-50 px-2 py-0.5
                                        text-theme-xs font-medium text-success-600
                                        dark:bg-success-500/15 dark:text-success-500">
                                            Available
                                        </span>
                                    @elseif ($room->status === 'occupied')
                                        <span
                                            class="rounded-full bg-brand-50 px-2 py-0.5
                                        text-theme-xs font-medium text-brand-600
                                        dark:bg-brand-500/15 dark:text-brand-500">
                                            Occupied
                                        </span>
                                    @elseif ($room->status === 'maintenance')
                                        <span
                                            class="rounded-full bg-warning-50 px-2 py-0.5
                                        text-theme-xs font-medium text-warning-600
                                        dark:bg-warning-500/15 dark:text-warning-500">
                                            Maintenance
                                        </span>
                                    @else
                                        <span
                                            class="rounded-full bg-gray-50 px-2 py-0.5
                                        text-theme-xs font-medium text-gray-600
                                        dark:bg-gray-500/15 dark:text-gray-400">
                                            Unavailable
                                        </span>
                                    @endif

                                </td>

                                {{-- Action --}}
                                <td class="py-3 whitespace-nowrap">

                                    <div class="flex items-center gap-3">

                                        <a href="{{ route('rooms.show', $room) }}" title="Detail"
                                            class="text-brand-500 hover:text-brand-600">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <a href="{{ route('rooms.edit', $room) }}" title="Edit"
                                            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <button type="button" title="Hapus"
                                            @click="openDeleteModal('{{ route('rooms.destroy', $room) }}')"
                                            class="text-error-500 hover:text-error-600">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada data kamar.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

                @if ($rooms->hasPages())
                    <div class="mt-4 border-t border-gray-100 pt-4 dark:border-gray-800">
                        {{ $rooms->links() }}
                    </div>
                @endif
            </div>
        </div>

        <form x-ref="deleteForm" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <x-confirm-modal title="Hapus Kamar"
            message="Apakah Anda yakin ingin menghapus kamar ini? Data yang sudah dihapus tidak dapat dikembalikan."
            confirm-text="Ya, Hapus" cancel-text="Batal" />

    </div>
@endsection
