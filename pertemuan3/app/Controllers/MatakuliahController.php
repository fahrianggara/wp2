<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class MatakuliahController extends BaseController
{
    public function index()
    {
        return view('v_form', [
            'judul' => 'Validation Matakuliah',
        ]);
    }

    public function store()
    {
        $rules = [
            'kode' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Kode Matkul harus diisi.',
                    'min_length' => 'Kode Matkul harus terdiri dari 3 karakter.'
                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama Matkul harus diisi.',
                    'min_length' => 'Nama Matkul harus terdiri dari 3 karakter.'
                ]
            ],
            'sks' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'SKS harus diisi.',
                    'min_length' => 'SKS harus terdiri dari 1 karakter.'
                ]
            ]
        ];

        if (!$this->validate($rules)) // <-- Validasi input gagal
        {
            session()->setFlashdata('errors', $this->validator);
            return redirect()->back()->withInput();
        } else { // <-- Jika validasi berhasil
            echo "<h1>Form berhasil di submit</h1>";
            echo "<p>Nama: {$this->request->getPost('nama')}</p>";
            echo "<p>Kode: {$this->request->getPost('kode')}</p>";
            echo "<p>SKS: {$this->request->getPost('sks')}</p>";
            echo "<a href='" . base_url('matakuliah') . "'>Kembali</a>";
        }
    }
}