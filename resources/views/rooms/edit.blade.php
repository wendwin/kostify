@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-screen-7xl">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Edit Kamar
                </h1>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Perbarui informasi kamar
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
                    Edit
                </span>
            </div>
        </div>

        {{-- Form --}}
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

            <form action="{{ route('rooms.update', $room) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                    {{-- Nomor Kamar --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nomor Kamar
                        </label>

                        <input type="text" name="room_number" value="{{ old('room_number', $room->room_number) }}"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 outline-none focus:border-brand-500 dark:border-gray-700 dark:text-white">

                        @error('room_number')
                            <p class="mt-1 text-sm text-error-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tipe --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tipe Kamar
                        </label>

                        <select name="room_type_id" required
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 outline-none focus:border-brand-500 dark:border-gray-700 dark:text-white">
                            @foreach ($roomTypes as $roomType)
                                <option value="{{ $roomType->id }}" @selected(old('room_type_id', $room->room_type_id) == $roomType->id)>
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

                    {{-- Harga --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Harga per Bulan
                        </label>

                        <input type="number" name="price" value="{{ old('price', $room->price) }}" min="0"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 outline-none focus:border-brand-500 dark:border-gray-700 dark:text-white">

                        @error('price')
                            <p class="mt-1 text-sm text-error-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status
                        </label>

                        <select name="status" required
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 outline-none focus:border-brand-500 dark:border-gray-700 dark:text-white">
                            <option value="available" @selected(old('status', $room->status) === 'available')>
                                Available
                            </option>

                            <option value="occupied" @selected(old('status', $room->status) === 'occupied')>
                                Occupied
                            </option>

                            <option value="maintenance" @selected(old('status', $room->status) === 'maintenance')>
                                Maintenance
                            </option>

                            <option value="unavailable" @selected(old('status', $room->status) === 'unavailable')>
                                Unavailable
                            </option>
                        </select>

                        @error('status')
                            <p class="mt-1 text-sm text-error-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Deskripsi
                        </label>

                        <textarea name="description" rows="4"
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 outline-none focus:border-brand-500 dark:border-gray-700 dark:text-white">{{ old('description', $room->description) }}</textarea>

                        @error('description')
                            <p class="mt-1 text-sm text-error-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-800">
                    <a href="{{ route('rooms.index') }}"
                        class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                        Batal
                    </a>

                    <button type="submit"
                        class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>

    </div>
@endsection
