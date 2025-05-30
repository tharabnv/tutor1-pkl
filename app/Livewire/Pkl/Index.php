<?php

namespace App\Livewire\Pkl;

use Livewire\Component;
use App\Models\Pkl;  

class Index extends Component
{
    public function render()
    {
        $pkls = Pkl::with(['siswa', 'industri', 'guru'])->latest()->get();

        return view('livewire.pkl.index', [
            'pkls' => $pkls
        ]);
    }
}
