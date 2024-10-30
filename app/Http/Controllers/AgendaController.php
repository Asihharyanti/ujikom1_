<?php

namespace App\Http\Controllers;

use App\Models\Agenda; // Pastikan model Agenda diimpor
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    // Menampilkan semua agenda
    public function index()
    {
        $agendas = Agenda::with('kategori')->get(); // Load kategori dengan agenda
        return view('agendas.index', compact('agendas'));
    }

    // Menampilkan form untuk menambah agenda baru
    public function create()
    {
        $kategoris = Kategori::all(); // Dapatkan semua kategori untuk form
        return view('agendas.create', compact('kategoris'));
    }

    // Menyimpan agenda baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date', // Validasi tanggal
            'kategori_id' => 'required|exists:kategori,id', // Validasi kategori_id
        ]);
        
        // Simpan agenda baru
        Agenda::create($request->all());
        
        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit agenda yang sudah ada
    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        $kategoris = Kategori::all(); // Dapatkan semua kategori untuk form

        return view('agendas.edit', compact('agenda', 'kategoris'));
    }

    // Memperbarui agenda yang sudah ada di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date', // Validasi tanggal
            'kategori_id' => 'required|exists:kategori,id', // Validasi kategori_id
        ]);

        $agenda = Agenda::findOrFail($id);
        $agenda->update($request->all());
        
        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil diperbarui!');
    }

    // Menghapus agenda dari database
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();
        
        return redirect()->route('agendas.index')->with('success', 'Agenda berhasil dihapus!');
    }
}
