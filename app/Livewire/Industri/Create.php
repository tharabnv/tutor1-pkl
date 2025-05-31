<?php

namespace App\Livewire\Industri;

use App\Models\Industri;
use Livewire\Component;

class Create extends Component
{
    public $nama;
    public $bidang_usaha;
    public $alamat;
    public $kontak;
    public $email;
    public $website;

    protected function rules()
    {
        return [
            'nama' => [
                'required',
                'string',
                'max:100',
                function ($attribute, $value, $fail) {
                    // Normalize: trim + lowercase
                    $normalizedInput = strtolower(trim($value));

                    // Cek apakah sudah ada industri dengan nama yang sama (case-insensitive)
                    $exists = Industri::whereRaw('LOWER(nama) = ?', [$normalizedInput])->exists();

                    if ($exists) {
                        $fail('Nama industri sudah ada.');
                    }
                },
            ],
            'bidang_usaha' => 'required|string|max:100',
            'alamat'      => 'required|string',
            'kontak'      => 'required|regex:/^[0-9+\-()]*$/|max:20',
            'email'       => 'required|email|max:100',
            'website'     => 'nullable|url|max:255',
        ];
    }

    public function save()
    {
        // Gunakan rules() di atas
        $validated = $this->validate();

        // Simpan ke database
        Industri::create($validated);

        session()->flash('success', 'Data industri berhasil disimpan!');
        return redirect()->route('industri.index');
    }

    public function render()
    {
        return view('livewire.industri.create');
    }
}
