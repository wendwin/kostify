@props([
    'title' => 'Konfirmasi',
    'message' => 'Apakah Anda yakin ingin melakukan tindakan ini?',
    'confirmText' => 'Hapus',
    'cancelText' => 'Batal',
])

<div x-show="confirmModal" x-cloak class="fixed inset-0 z-99999 flex items-center justify-center p-5">
    {{-- Backdrop --}}
    <div x-show="confirmModal" x-transition.opacity class="absolute inset-0 bg-black/50" @click="confirmModal = false">
    </div>

    {{-- Modal --}}
    <div x-show="confirmModal" x-transition @click.outside="confirmModal = false"
        class="relative w-full max-w-md rounded-2xl bg-white p-6
            dark:bg-gray-900">

        {{-- Icon --}}
        <div class="mb-4 flex justify-center">
            <div
                class="flex h-12 w-12 items-center justify-center rounded-full
                    bg-red-50 text-red-500 dark:bg-red-500/15">
                <i class="fa-solid fa-triangle-exclamation text-lg"></i>
            </div>
        </div>

        {{-- Content --}}
        <div class="text-center">

            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                {{ $title }}
            </h3>

            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                {{ $message }}
            </p>

        </div>

        {{-- Actions --}}
        <div class="mt-6 flex justify-end gap-3">

            <button type="button" @click="confirmModal = false"
                class="rounded-lg border border-gray-300 px-4 py-2.5
                    text-sm font-medium text-gray-700
                    hover:bg-gray-50
                    dark:border-gray-700 dark:text-gray-300
                    dark:hover:bg-gray-800">
                {{ $cancelText }}
            </button>

            <button type="button" @click="confirmDelete()"
                class="rounded-lg bg-red-500 px-4 py-2.5
                    text-sm font-medium text-white
                    hover:bg-red-600">
                {{ $confirmText }}
            </button>

        </div>

    </div>
</div>
