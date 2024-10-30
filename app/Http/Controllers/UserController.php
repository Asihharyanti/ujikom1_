<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat pengguna baru
        
$user = new User();
$user->name = 'Admin';
$user->email = 'admin@example.com';
$user->password = Hash::make('password'); // Pastikan ini di-hash
$user->save();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }
}
