<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use App\Models\Industri; // ✅ Ini yang benar

class Index extends Component
{
    public function render()
    {
         return view('livewire.industri.index', [
            'industris' => Industri::all(), // ✅ ini yang penting
        ]);
    }
}
