<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-8 w-full max-w-2xl">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Industri</h2>

        <form wire:submit.prevent="save" class="space-y-5">
            {{-- Nama Industri --}}
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Industri</label>
                <input type="text" id="nama" wire:model="nama"
                       class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
                       placeholder="Contoh: PT. Sukses">
                @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Bidang Usaha --}}
            <div>
                <label for="bidang_usaha" class="block text-sm font-medium text-gray-700">Bidang Usaha</label>
                <input type="text" id="bidang_usaha" wire:model="bidang_usaha"
                       class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
                       placeholder="Contoh: Teknologi Informasi">
            </div>

            {{-- Alamat --}}
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" id="alamat" wire:model="alamat"
                       class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
                       placeholder="Alamat lengkap industri">
            </div>

            {{-- Kontak dan Email --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="kontak" class="block text-sm font-medium text-gray-700">Kontak</label>
                    <input type="text" id="kontak" wire:model="kontak"
                           class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
                           placeholder="08xxxxxxxxxx"
                           maxlength="20"
                           oninput="this.value = this.value.replace(/[^0-9+\-()]/g, '')">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" wire:model="email"
                           class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
                           placeholder="example@gmail.com">
                </div>
            </div>

            {{-- Website --}}
            <div>
                <label for="website" class="block text-sm font-medium text-gray-700">Website (Opsional)</label>
                <input type="url" id="website" wire:model="website"
                       class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
                       placeholder="https://example.com">
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('industri.index') }}"
                   class="bg-gray-200 text-gray-700 px-5 py-2 rounded-md hover:bg-gray-300 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
