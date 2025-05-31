<?php

namespace App\Livewire\Industri;

use App\Models\Industri;
use Livewire\Component;

class Create extends Component
{
    public $nama, $bidang_usaha, $alamat, $kontak, $email, $website;

    public function save()
    {
        $validated = $this->validate([
            'nama' => 'required|string|max:100',
            'bidang_usaha' => 'required|string|max:100',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'website' => 'nullable|url|max:255',
        ]);

        Industri::create($validated);

        session()->flash('success', 'Data industri berhasil disimpan!');
        return redirect()->route('industri.index');
    }

    public function render()
    {
        return view('livewire.industri.create');
    }
}
