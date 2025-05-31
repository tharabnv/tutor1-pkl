<?php

namespace App\Livewire\Pkl;

use App\Models\Pkl;
use App\Models\Siswa;
use App\Models\Industri;
use Livewire\Component;

class Create extends Component
{
    public $siswa_id, $industri_id, $mulai, $selesai;
    
    public function save()
    {
        $this->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'industri_id' => 'required|exists:industris,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai',
        ]);

        if (Pkl::where('siswa_id', $this->siswa_id)->exists()) {
            session()->flash('error', 'Siswa ini sudah melapor PKL.');
            return redirect()->route('pkl.index');
        }

        Pkl::create([
            'siswa_id' => $this->siswa_id,
            'industri_id' => $this->industri_id,
            'mulai' => $this->mulai,
            'selesai' => $this->selesai,
        ]);

        session()->flash('success', 'Data PKL berhasil disimpan!');
        return redirect()->route('pkl.index');
    }

    public function render()
    {
        return view('livewire.pkl.create', [
        'siswas' => \App\Models\Siswa::all(),
        'industris' => \App\Models\Industri::all(),
    ]);
    }

    public function cancel()
    {
        return redirect()->route('pkl.index'); // sesuaikan path view-nya
    }
}
