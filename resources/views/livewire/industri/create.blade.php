<div class="p-6 bg-white rounded shadow">
    <form wire:submit.prevent="save">
        <input type="text" wire:model="nama" placeholder="Nama Industri">
        @error('nama') <span class="text-red-500">{{ $message }}</span> @enderror

        <input type="text" wire:model="bidang_usaha" placeholder="Bidang Usaha">
        <input type="text" wire:model="alamat" placeholder="Alamat">
        <input type="text" wire:model="kontak" placeholder="Kontak">
        <input type="email" wire:model="email" placeholder="Email">
        <input type="url" wire:model="website" placeholder="Website (optional)">
        
        <button type="submit">Save</button>
    </form>
</div>
