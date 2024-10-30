<?php

namespace App\Http\Controllers;

use App\Models\Information; // Pastikan ini menggunakan nama model yang benar
use App\Models\Kategori; // Pastikan Kategori juga diimpor
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage; // Pastikan untuk mengimpor Storage

class InformationController extends Controller
{
    // Menampilkan semua informasi
    public function index()
    {
        $informations = Information::with('kategori')->get(); // Load kategori dengan informasi
        return view('informations.index', compact('informations'));
    }

    // Menampilkan form untuk menambah informasi baru
    public function create()
    {
        $kategoris = Kategori::all(); // Dapatkan semua kategori untuk form
        return view('informations.create', compact('kategoris'));
    }

    // Menyimpan informasi baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string', // Pastikan ini sesuai dengan kolom di tabel
            'foto' => 'nullable|image|max:2048', // Validasi foto (optional)
            'kategori_id' => 'required|exists:kategori,id', // Validasi kategori_id
        ]);

        $data = $request->all();

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('uploads', 'public'); // Menyimpan foto di storage/app/public/uploads
        }

        // Simpan informasi baru
        Information::create($data);

        return redirect()->route('informations.index')->with('success', 'Informasi berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit informasi yang sudah ada
    public function edit($id)
{
    $information = Information::findOrFail($id);
    $kategoris = Kategori::all(); // Dapatkan semua kategori untuk form

    return view('informations.edit', compact('information', 'kategoris'));
}

    // Memperbarui informasi yang sudah ada di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string', // Pastikan ini sesuai dengan kolom di tabel
            'foto' => 'nullable|image|max:2048', // Validasi foto (optional)
            'kategori_id' => 'required|exists:kategori,id', // Validasi kategori_id
        ]);

        $information = Information::findOrFail($id);
        $data = $request->all();

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto yang lama jika ada
            if ($information->foto) {
                Storage::disk('public')->delete($information->foto);
            }
            $data['foto'] = $request->file('foto')->store('uploads', 'public'); // Menyimpan foto di storage/app/public/uploads
        }

        // Update informasi
        $information->update($data);

        return redirect()->route('informations.index')->with('success', 'Informasi berhasil diperbarui!');
    }

    // Menghapus informasi dari database
    public function destroy($id)
    {
        $information = Information::findOrFail($id);
        // Hapus foto jika ada
        if ($information->foto) {
            Storage::disk('public')->delete($information->foto);
        }
        $information->delete();

        return redirect()->route('informations.index')->with('success', 'Informasi berhasil dihapus!');
    }
}
