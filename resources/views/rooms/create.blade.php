@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-screen-7xl">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">

            {{-- Title --}}
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Tambah Kamar
                </h1>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Tambahkan data kamar baru.
                </p>
            </div>

            {{-- Breadcrumb --}}
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
                    Tambah
                </span>

            </div>

        </div>

        {{-- Form --}}
        <div
            class="rounded-2xl border border-gray-200 bg-white p-5
        dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">

            <form action="{{ route('rooms.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- Room Number --}}
                    <div>
                        <label for="room_number" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nomor Kamar
                        </label>

                        <input type="text" id="room_number" name="room_number" value="{{ old('room_number') }}"
                            placeholder="Contoh: A01" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                        text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400
                        focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                        dark:border-gray-700 dark:bg-gray-900 dark:text-white/90
                        dark:placeholder:text-gray-400 dark:focus:border-brand-800">

                        @error('room_number')
                            <p class="mt-1 text-sm text-error-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Room Type --}}
                    <div>
                        <label for="room_type_id" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tipe Kamar
                        </label>

                        <select id="room_type_id" name="room_type_id" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                        text-sm text-gray-800 shadow-theme-xs
                        focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                        dark:border-gray-700 dark:bg-gray-900 dark:text-white/90
                        dark:focus:border-brand-800">
                            <option value="">Pilih tipe kamar</option>

                            @foreach ($roomTypes as $roomType)
                                <option value="{{ $roomType->id }}" @selected(old('room_type_id') == $roomType->id)>
                                    {{ $roomType->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('room_type_id')
                            <p class="mt-1 text-sm text-error-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div>
                        <label for="price" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Harga Sewa / Bulan
                        </label>

                        <input type="number" id="price" name="price" value="{{ old('price') }}" min="0"
                            step="1000" placeholder="Contoh: 800000" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                        text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400
                        focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                        dark:border-gray-700 dark:bg-gray-900 dark:text-white/90
                        dark:placeholder:text-gray-400 dark:focus:border-brand-800">

                        @error('price')
                            <p class="mt-1 text-sm text-error-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status
                        </label>

                        <select id="status" name="status" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                        text-sm text-gray-800 shadow-theme-xs
                        focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                        dark:border-gray-700 dark:bg-gray-900 dark:text-white/90
                        dark:focus:border-brand-800">
                            <option value="">Pilih status</option>

                            <option value="available" @selected(old('status') === 'available')>
                                Available
                            </option>

                            <option value="occupied" @selected(old('status') === 'occupied')>
                                Occupied
                            </option>

                            <option value="maintenance" @selected(old('status') === 'maintenance')>
                                Maintenance
                            </option>

                            <option value="unavailable" @selected(old('status') === 'unavailable')>
                                Unavailable
                            </option>
                        </select>

                        @error('status')
                            <p class="mt-1 text-sm text-error-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="md:col-span-2">
                        <label for="description" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Deskripsi
                        </label>

                        <textarea id="description" name="description" rows="4" placeholder="Deskripsi kamar..."
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

                </div>

                {{-- Button --}}
                <div class="mt-6 flex items-center justify-end gap-3">

                    <a href="{{ route('rooms.index') }}"
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
