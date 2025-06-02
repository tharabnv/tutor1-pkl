<div class="py-10">
  <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md overflow-hidden p-4 border border-gray-300">

    <h2 class="text-xl font-semibold text-gray-800 mb-4">Data Industri</h2>

    {{-- Search Bar --}}
    <div class="flex justify-between mb-4">
      <form method="GET" class="mb-2">
        <input type="text" name="search" placeholder="Cari industri..." class="border rounded px-2 py-1 w-64" value="{{ request()->query('search') }}">
        <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Cari</button>
        <a href="{{ route('industri.index') }}" class="bg-gray-500 text-white px-4 py-1 rounded">Reset</a>
      </form>

      <a href="{{ route('industri.create') }}" 
         class="bg-green-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
         Tambah Industri
      </a>
    </div>

    {{-- Table wrapper scroll --}}
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm text-left text-gray-700 border border-gray-300 table-auto">
        <thead class="bg-gray-300 text-gray-700 font-medium">
          <tr>
            <th class="px-3 py-2 border-b w-10">No</th>
            <th class="px-3 py-2 border-b w-64">Nama</th>
            <th class="px-3 py-2 border-b w-64">Bidang Usaha</th>
            <th class="px-3 py-2 border-b w-72">Alamat</th>
            <th class="px-3 py-2 border-b w-40">Kontak</th>
            <th class="px-3 py-2 border-b w-60">Email</th>
            <th class="px-3 py-2 border-b w-48">Website</th>
          </tr>
        </thead>
        <tbody>
          @forelse($industris as $key => $industri)
          <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
            <td class="px-3 py-2 border-b">{{ ($industris->currentPage() - 1) * $industris->perPage() + $key + 1 }}</td>
            <td class="px-3 py-2 border-b">{{ $industri->nama }}</td>
            <td class="px-3 py-2 border-b">{{ $industri->bidang_usaha }}</td>
            <td class="px-3 py-2 border-b">{{ $industri->alamat }}</td>
            <td class="px-3 py-2 border-b whitespace-nowrap">{{ $industri->kontak }}</td>
            <td class="px-3 py-2 border-b">{{ $industri->email }}</td>
            <td class="px-3 py-2 border-b max-w-[180px] truncate">
              <a href="{{ $industri->website }}" target="_blank" class="text-blue-600 underline">
                {{ $industri->website }}
              </a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-3 text-gray-500 italic">
              Belum ada data industri.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>

      {{-- Pagination --}}
      <div class="mt-4">
        {{ $industris->links() }}
      </div>
    </div>

  </div>
</div>