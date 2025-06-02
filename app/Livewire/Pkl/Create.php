<?php

namespace App\Livewire\Pkl;

use App\Models\Pkl;
use App\Models\Siswa;
use App\Models\Industri;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Create extends Component
{
    public $siswa_id, 
           $industri_id, 
           $mulai, 
           $selesai, 
           $siswas, 
           $industris, 
           $siswaList;
    
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
        
        // Validasi durasi minimal 90 hari
        $start = Carbon::parse($this->mulai);
        $end   = Carbon::parse($this->selesai);
        $durasi = $start->diffInDays($end);

        if ($durasi < 90) {
            // Tambahkan error pada field 'selesai'
            $this->addError('selesai', 'Durasi PKL minimal harus 90 hari (saat ini '.$durasi.' hari).');
            return; // jangan redirect, biarkan tetap di form
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

    public function mount()
    {
        $userEmail = Auth::user()->email;

        // Hanya ambil siswa yang email-nya sama dengan user yang login
        $this->siswaList = Siswa::where('email', $userEmail)->get();

        // Ambil semua industri untuk dropdown industri
        $this->industris = Industri::all();

        // Jika hanya satu siswa ditemukan, otomatis isi $siswa_id-nya
        if ($this->siswaList->count() === 1) {
            $this->siswa_id = $this->siswaList->first()->id;
        }
    }

}
