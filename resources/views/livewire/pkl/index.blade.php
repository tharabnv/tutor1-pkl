<div class="py-10">
  <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md overflow-hidden p-6 border border-gray-200">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Laporan PKL</h2>

    @if (session()->has('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
    @endif

    @if (session()->has('error'))
    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
        {{ session('error') }}
    </div>
    @endif
    
    <div class="flex justify-end mb-4">
        <a href="{{ route('pkl.create') }}" 
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Lapor PKL
        </a>
    </div>

    <table class="min-w-full bg-white border border-gray-300 text-sm text-left">
      <thead class="bg-gray-100 text-gray-700">
        <tr>
          <th class="px-4 py-2 border-b">No</th>
          <th class="px-4 py-2 border-b">Nama Siswa</th>
          <th class="px-4 py-2 border-b">Industri</th>
          <th class="px-4 py-2 border-b">Guru Pembimbing</th>
          <th class="px-4 py-2 border-b">Mulai</th>
          <th class="px-4 py-2 border-b">Selesai</th>
          <th class="px-4 py-2 border-b whitespace-nowrap">Durasi (Hari)</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($pkls as $index => $pkl)
          @php
            $durasi = \Carbon\Carbon::parse($pkl->mulai)->diffInDays(\Carbon\Carbon::parse($pkl->selesai));
          @endphp
          <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
            <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
            <td class="px-4 py-2 border-b">{{ $pkl->siswa->nama }}</td>
            <td class="px-4 py-2 border-b">{{ $pkl->industri->nama }}</td>
            <td class="px-4 py-2 border-b">
              {{ $pkl->guru ? $pkl->guru->nama : 'Belum ditentukan' }}
            </td>
            <td class="px-4 py-2 border-b">{{ $pkl->mulai }}</td>
            <td class="px-4 py-2 border-b">{{ $pkl->selesai }}</td>
            <td class="px-4 py-2 border-b">{{ $durasi }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-4 text-gray-500 italic">
              Belum ada data PKL.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
