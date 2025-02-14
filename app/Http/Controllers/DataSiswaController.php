<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSiswa;

class DataSiswaController extends Controller
{
    /**
     * Tampilkan daftar siswa.
     */
    public function index(Request $request)
    {
        $query = DataSiswa::query();

        // Fitur pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('NIS', 'like', "%$search%")
                  ->orWhere('Nama', 'like', "%$search%");
        }

        $datasiswas = $query->get();
        return view('data.index', compact('datasiswas'));
    }

    /**
     * Tampilkan form tambah siswa.
     */
    public function create()
    {
        return view('data.create');
    }

    /**
     * Simpan data siswa baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NIS' => 'required|unique:datasiswas,NIS',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Alamat' => 'required',
        ]);

        DataSiswa::create($request->all());

        return redirect()->route('datasiswas.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit siswa.
     */
    public function edit($id)
    {
        $siswa = DataSiswa::findOrFail($id);
        return view('data.edit', compact('siswa'));
    }

    /**
     * Update data siswa.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'NIS' => 'required|unique:datasiswas,NIS,' . $id,
            'Nama' => 'required',
            'Kelas' => 'required',
            'Alamat' => 'required',
        ]);

        $siswa = DataSiswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('datasiswas.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Hapus data siswa.
     */
    public function destroy($id)
    {
        $siswa = DataSiswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('datasiswas.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
