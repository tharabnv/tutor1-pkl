<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Lapor Praktik Kerja Lapangan</h2>

        <form wire:submit.prevent="save">
            {{-- Nama Siswa --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Siswa</label>
                <select wire:model="siswa_id" class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">Pilih Siswa</option>
                    @foreach ($siswaList as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                    @endforeach
                </select>
                @error('siswa_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Industri --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Industri</label>
                <select wire:model="industri_id" class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">Pilih Industri</option>
                    @foreach($industris as $industri)
                        <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
                    @endforeach
                </select>
                @error('industri_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Tanggal PKL --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Mulai</label>
                <input type="date" wire:model="mulai" class="w-full border border-gray-300 rounded-md px-3 py-2">
                @error('mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Selesai</label>
                <input type="date" wire:model="selesai" class="w-full border border-gray-300 rounded-md px-3 py-2">
                @error('selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end">
                <button type="button" wire:click="cancel" class="mr-2 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
