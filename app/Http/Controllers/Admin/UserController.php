<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan semua user terdaftar (skenario "Kelola Data User")
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%')
                  ->orWhere('email', 'like', '%' . $request->cari . '%');
        }

        $users = $query->latest()->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    // Hapus akun user (beserta keranjang & pesanan miliknya, cascade dari FK)
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}