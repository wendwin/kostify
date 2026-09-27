@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl">
        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            {{-- Title --}}
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                    Tambah Penghuni
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

                <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>

                <span class="font-medium text-gray-800 dark:text-white">
                    Tambah
                </span>
            </div>
        </div>

        <form action="{{ route('tenants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">

                {{-- Data Akun --}}
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white/90">
                            Data Akun
                        </h2>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Data ini digunakan untuk membuat akun penghuni.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                        {{-- Nama --}}
                        <div>
                            <label for="name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap" required
                                class="w-full rounded-lg border px-4 py-2.5 text-sm outline-none
            {{ $errors->has('name')
                ? 'border-red-500 focus:border-red-500'
                : 'border-gray-300 focus:border-brand-500 dark:border-gray-700' }}
            bg-transparent text-gray-800 dark:text-white/90">

                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email <span class="text-red-500">*</span>
                            </label>

                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                placeholder="contoh@email.com" required
                                class="w-full rounded-lg border px-4 py-2.5 text-sm outline-none
            {{ $errors->has('email')
                ? 'border-red-500 focus:border-red-500'
                : 'border-gray-300 focus:border-brand-500 dark:border-gray-700' }}
            bg-transparent text-gray-800 dark:text-white/90">

                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Data Pribadi --}}
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white/90">
                            Data Pribadi
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                        {{-- NIK --}}
                        <div>
                            <label for="nik" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                NIK <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                                placeholder="Masukkan NIK" required
                                class="w-full rounded-lg border px-4 py-2.5 text-sm outline-none
            {{ $errors->has('nik')
                ? 'border-red-500 focus:border-red-500'
                : 'border-gray-300 focus:border-brand-500 dark:border-gray-700' }}
            bg-transparent text-gray-800 dark:text-white/90">

                            @error('nik')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nomor Telepon --}}
                        <div>
                            <label for="phone" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nomor Telepon <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                placeholder="08xxxxxxxxxx" required
                                class="w-full rounded-lg border px-4 py-2.5 text-sm outline-none
            {{ $errors->has('phone')
                ? 'border-red-500 focus:border-red-500'
                : 'border-gray-300 focus:border-brand-500 dark:border-gray-700' }}
            bg-transparent text-gray-800 dark:text-white/90">

                            @error('phone')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div>
                            <label for="gender" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>

                            <select name="gender" id="gender" required
                                class="w-full rounded-lg border px-4 py-2.5 text-sm outline-none
        {{ $errors->has('gender')
            ? 'border-red-500 focus:border-red-500'
            : 'border-gray-300 focus:border-brand-500 dark:border-gray-700' }}
        bg-white dark:bg-gray-900 text-gray-800 dark:text-white/90">
                                <option value="">Pilih jenis kelamin</option>

                                <option value="Laki-laki" @selected(old('gender') === 'Laki-laki')>
                                    Laki-laki
                                </option>

                                <option value="Perempuan" @selected(old('gender') === 'Perempuan')>
                                    Perempuan
                                </option>
                            </select>

                            @error('gender')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tempat Lahir --}}
                        <div>
                            <label for="birth_place"
                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tempat Lahir <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="birth_place" id="birth_place" value="{{ old('birth_place') }}"
                                placeholder="Contoh: Bandung" required
                                class="w-full rounded-lg border px-4 py-2.5 text-sm outline-none
            {{ $errors->has('birth_place')
                ? 'border-red-500 focus:border-red-500'
                : 'border-gray-300 focus:border-brand-500 dark:border-gray-700' }}
            bg-transparent text-gray-800 dark:text-white/90">

                            @error('birth_place')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div>
                            <label for="birth_date" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>

                            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}"
                                required
                                class="w-full rounded-lg border px-4 py-2.5 text-sm outline-none
            {{ $errors->has('birth_date')
                ? 'border-red-500 focus:border-red-500'
                : 'border-gray-300 focus:border-brand-500 dark:border-gray-700' }}
            bg-transparent text-gray-800 dark:text-white/90">

                            @error('birth_date')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Pekerjaan --}}
                        <div>
                            <label for="occupation" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Pekerjaan <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="occupation" id="occupation" value="{{ old('occupation') }}"
                                placeholder="Contoh: Karyawan" required
                                class="w-full rounded-lg border px-4 py-2.5 text-sm outline-none
            {{ $errors->has('occupation')
                ? 'border-red-500 focus:border-red-500'
                : 'border-gray-300 focus:border-brand-500 dark:border-gray-700' }}
            bg-transparent text-gray-800 dark:text-white/90">

                            @error('occupation')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="md:col-span-2">
                            <label for="address" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Alamat <span class="text-red-500">*</span>
                            </label>

                            <textarea name="address" id="address" rows="3" placeholder="Masukkan alamat lengkap" required
                                class="w-full rounded-lg border px-4 py-2.5 text-sm outline-none
            {{ $errors->has('address')
                ? 'border-red-500 focus:border-red-500'
                : 'border-gray-300 focus:border-brand-500 dark:border-gray-700' }}
            bg-transparent text-gray-800 dark:text-white/90">{{ old('address') }}</textarea>

                            @error('address')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Dokumen --}}
                        <div class="md:col-span-2">
                            <label for="identity_document"
                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Dokumen Identitas <span class="text-red-500">*</span>
                            </label>

                            <input type="file" name="identity_document" id="identity_document"
                                accept="image/jpeg,image/png"
                                class="w-full rounded-lg border px-4 py-2.5 text-sm outline-none
                {{ $errors->has('identity_document')
                    ? 'border-red-500 focus:border-red-500'
                    : 'border-gray-300 focus:border-brand-500 dark:border-gray-700' }}
                bg-transparent text-gray-800 dark:text-white/90
                file:mr-4 file:rounded-md file:border-0
                file:bg-gray-100 file:px-4 file:py-2
                file:text-sm file:font-medium
                dark:file:bg-gray-800">

                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Format yang diperbolehkan: JPG, JPEG, PNG. Maksimal 2 MB.
                            </p>

                            @error('identity_document')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
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

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                        {{-- Nama Kontak --}}
                        <div>
                            <label for="emergency_contact_name"
                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Kontak Darurat <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="emergency_contact_name" id="emergency_contact_name"
                                value="{{ old('emergency_contact_name') }}" placeholder="Nama keluarga/kontak darurat"
                                required
                                class="w-full rounded-lg border px-4 py-2.5 text-sm outline-none
            {{ $errors->has('emergency_contact_name')
                ? 'border-red-500 focus:border-red-500'
                : 'border-gray-300 focus:border-brand-500 dark:border-gray-700' }}
            bg-transparent text-gray-800 dark:text-white/90">

                            @error('emergency_contact_name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nomor Kontak --}}
                        <div>
                            <label for="emergency_contact_phone"
                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nomor Kontak Darurat <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="emergency_contact_phone" id="emergency_contact_phone"
                                value="{{ old('emergency_contact_phone') }}" placeholder="08xxxxxxxxxx" required
                                class="w-full rounded-lg border px-4 py-2.5 text-sm outline-none
            {{ $errors->has('emergency_contact_phone')
                ? 'border-red-500 focus:border-red-500'
                : 'border-gray-300 focus:border-brand-500 dark:border-gray-700' }}
            bg-transparent text-gray-800 dark:text-white/90">

                            @error('emergency_contact_phone')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Action --}}
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('tenants.index') }}"
                        class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                        Batal
                    </a>

                    <button type="submit"
                        class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
                        Simpan
                    </button>
                </div>

            </div>
        </form>
    </div>
@endsection
