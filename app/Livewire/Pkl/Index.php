<?php

namespace App\Livewire\Pkl;

use Livewire\Component;
use App\Models\Pkl;
use App\Models\Siswa;
use App\Models\Industri;

class Index extends Component
{
    public $showForm = false;
    public $siswa_id, $industri_id, $guru_id, $mulai, $selesai;

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
        $pkls = Pkl::with(['siswa', 'industri', 'guru'])->latest()->get();

        return view('livewire.pkl.index', [
            'pkls' => $pkls
        ]);
    }
}
