<div class="py-10">
  <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md overflow-hidden p-4 border border-gray-300">

    <h2 class="text-xl font-semibold text-gray-800 mb-4">Data Industri</h2>

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm text-left text-gray-700 border border-gray-300">
        <thead class="bg-gray-200 text-gray-700 font-medium">
          <tr>
            <th class="px-3 py-2 border-b">No</th>
            <th class="px-3 py-2 border-b">Nama</th>
            <th class="px-3 py-2 border-b">Bidang Usaha</th>
            <th class="px-3 py-2 border-b">Alamat</th>
            <th class="px-3 py-2 border-b">Kontak</th>
            <th class="px-3 py-2 border-b">Email</th>
          </tr>
        </thead>
        <tbody>
          @forelse($industris as $key => $industri)
          <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
            <td class="px-3 py-2 border-b">{{ $key + 1 }}</td>
            <td class="px-3 py-2 border-b">{{ $industri->nama }}</td>
            <td class="px-3 py-2 border-b">{{ $industri->bidang_usaha }}</td>
            <td class="px-3 py-2 border-b">{{ $industri->alamat }}</td>
            <td class="px-3 py-2 border-b whitespace-nowrap">{{ $industri->kontak }}</td>
            <td class="px-3 py-2 border-b">{{ $industri->email }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center py-3 text-gray-500 italic">
              Belum ada data industri.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>
