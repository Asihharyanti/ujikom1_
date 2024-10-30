<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Pastikan ini ada

class HomeController extends Controller
{
    public function adminIndex()
    {
        return view('admin.dashboard'); // Mengarah ke resources/views/admin/dashboard.blade.php
    }
}
