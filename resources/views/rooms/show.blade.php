@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-screen-7xl">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Detail Kamar
                </h1>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Informasi detail kamar
                </p>
            </div>

            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('dashboard') }}"
                    class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500">
                    Home
                </a>

                <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>

                <a href="{{ route('rooms.index') }}"
                    class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-500">
                    Rooms
                </a>

                <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>

                <span class="font-medium text-gray-800 dark:text-white">
                    Detail
                </span>
            </div>
        </div>

        {{-- Detail --}}
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                    Kamar {{ $room->room_number }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Nomor Kamar
                    </p>

                    <p class="mt-1 font-medium text-gray-800 dark:text-white">
                        {{ $room->room_number }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Tipe Kamar
                    </p>

                    <p class="mt-1 font-medium text-gray-800 dark:text-white">
                        {{ $room->roomType->name }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Harga per Bulan
                    </p>

                    <p class="mt-1 font-medium text-gray-800 dark:text-white">
                        Rp {{ number_format($room->price, 0, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Status
                    </p>

                    <div class="mt-2">
                        @if ($room->status === 'available')
                            <span
                                class="rounded-full bg-success-50 px-3 py-1 text-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                Available
                            </span>
                        @elseif ($room->status === 'occupied')
                            <span
                                class="rounded-full bg-brand-50 px-3 py-1 text-xs font-medium text-brand-600 dark:bg-brand-500/15 dark:text-brand-500">
                                Occupied
                            </span>
                        @elseif ($room->status === 'maintenance')
                            <span
                                class="rounded-full bg-warning-50 px-3 py-1 text-xs font-medium text-warning-600 dark:bg-warning-500/15 dark:text-warning-500">
                                Maintenance
                            </span>
                        @else
                            <span
                                class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                Unavailable
                            </span>
                        @endif
                    </div>
                </div>

                <div class="md:col-span-2">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Deskripsi
                    </p>

                    <p class="mt-1 text-gray-800 dark:text-white">
                        {{ $room->description ?: '-' }}
                    </p>
                </div>

            </div>

            <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                <a href="{{ route('rooms.index') }}"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                    Kembali
                </a>

                <a href="{{ route('rooms.edit', $room) }}"
                    class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
                    Edit
                </a>
            </div>
        </div>

    </div>
@endsection
