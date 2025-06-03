<?php

namespace App\Livewire\Pkl;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pkl;
use App\Models\Siswa;
use App\Models\Industri;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $queryString = ['search']; // agar search tersimpan di URL saat reload

    public $showForm = false;
    public $siswa_id, $industri_id, $guru_id, $mulai, $selesai;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage(); // reset ke halaman 1 saat search berubah
    }

    public function store()
    {
        $this->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai',
        ]);

        if (Pkl::where('siswa_id', $this->siswa_id)->exists()) {
            session()->flash('error', 'Siswa sudah melaporkan PKL.');
            return;
        }

        Pkl::create([
            'siswa_id' => $this->siswa_id,
            'industri_id' => $this->industri_id,
            'guru_id' => $this->guru_id,
            'mulai' => $this->mulai,
            'selesai' => $this->selesai,
        ]);

        $this->reset(['siswa_id', 'industri_id', 'guru_id', 'mulai', 'selesai', 'showForm']);
        session()->flash('success', 'Data PKL berhasil disimpan.');
    }

    public function render()
    {
        $pkls = Pkl::with(['siswa', 'industri', 'guru'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('siswa', function ($sub) {
                        $sub->where('nama', 'like', '%' . $this->search . '%');
                    })->orWhereHas('industri', function ($sub) {
                        $sub->where('nama', 'like', '%' . $this->search . '%');
                    })->orWhereHas('guru', function ($sub) {
                        $sub->where('nama', 'like', '%' . $this->search . '%');
                    });
                });
            })
            ->latest() //mengurutkan secara descending, data terbaru berada di atas
            ->paginate(10);

        return view('livewire.pkl.index', compact('pkls'));
    }
}