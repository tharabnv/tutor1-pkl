<div>
    {{-- Header Content --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Products') }}
        </h2>
    </x-slot>

    {{-- Body Content --}}
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-lg rounded-lg p-6">
                
                {{-- Tombol Create a New Product --}}
                <div class="flex justify-between mb-4">
                    <button class="px-4 py-2 font-bold text-gray bg-white-600 rounded-lg shadow hover:bg-blue-700 transition">
                        Create a New Product
                    </button>
                </div>

                {{-- Kontrol Rows per Page dan Searching --}}
                <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg mb-4">
                    <!-- Kolom Kiri -->
                    <div class="flex items-center space-x-2">
                        <label for="rows-per-page" class="font-medium text-gray-700">Rows per Page: </label>
                        <select id="rows-per-page" class="w-24 px-5 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <!-- Kolom Kanan -->
                    <div class="flex items-center space-x-2">
                        <label for="search" class="font-medium text-gray-700">Search:</label>
                        <input
                            id="search"
                            type="text"
                            placeholder="Type to search..."
                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300 w-48"
                        />
                    </div>
                </div>

                {{-- Tabel Produk --}}
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 border-collapse">
                        <thead class="text-xs text-gray-800 uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Product Name</th>
                                <th scope="col" class="px-6 py-3">Description</th>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="px-6 py-3">Price</th>
                                <th scope="col" class="px-6 py-3">Image</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="bg-white border-b border-gray-200">
                                <td class="px-6 py-4">{{ $product->id }}</td>
                                <td class="px-6 py-4">{{ $product->name }}</td>
                                <td class="px-6 py-4">{{ $product->description }}</td>
                                <td class="px-6 py-4">{{ $product->category }}</td>
                                <td class="px-6 py-4">${{ $product->price }}</td>
                                <td class="px-6 py-4">
                                    <img src="{{ $product->image }}" alt="Product Image" class="w-16 h-16 object-cover rounded">
                                </td>
                                <td class="px-6 py-4">
                                    <button class="px-3 py-1 text-black bg-red-500 rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
