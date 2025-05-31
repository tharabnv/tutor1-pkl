<div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400 bg-black bg-opacity-30">
  <div class="flex items-center justify-center min-h-screen px-4 text-center">

    <div class="inline-block w-full max-w-md overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg">
      <form wire:submit.prevent="save">
        <div class="p-6">
          <h2 class="text-xl font-semibold text-gray-800 mb-4">Lapor PKL</h2>

          {{-- Nama Siswa --}}
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Siswa</label>
            <select wire:model="siswa_id">
                <option value="">Pilih Siswa</option>
                @foreach ($siswas as $siswa)
                    <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                @endforeach
            </select>
            @error('siswa_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Industri --}}
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Industri</label>
            <select wire:model="industri_id" class="w-full border rounded-md px-3 py-2">
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
            <input type="date" wire:model="mulai" class="w-full border rounded-md px-3 py-2">
            @error('mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Selesai</label>
            <input type="date" wire:model="selesai" class="w-full border rounded-md px-3 py-2">
            @error('selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Tombol --}}
          <div class="flex justify-end mt-6">
            <button wire:click="cancel" type="button" class="mr-2 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>
