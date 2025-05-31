<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use App\Models\Industri;
use Livewire\WithPagination;

class Index extends Component
{
    public string $search = ''; // Tambahkan properti pencarian
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $queryString = ['search']; // agar search tersimpan di URL saat reload

    public function render()
    {
        $industris = Industri::query()
        ->where(function ($query) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('bidang_usaha', 'like', '%' . $this->search . '%')
                ->orWhere('alamat', 'like', '%' . $this->search . '%')
                ->orWhere('kontak', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })
        ->paginate(10);

        return view('livewire.industri.index', [
            'industris' => $industris,
        ]);
    }
}
