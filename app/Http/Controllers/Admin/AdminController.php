<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // Menampilkan semua akun admin (skenario "Kelola Data Admin")
    public function index()
    {
        $admins = Admin::latest()->paginate(10);

        return view('admin.akun.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.akun.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Admin::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Akun admin berhasil ditambahkan.');
    }

    public function edit(Admin $akun)
    {
        return view('admin.akun.edit', ['admin' => $akun]);
    }

    public function update(Request $request, Admin $akun)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('admins', 'email')->ignore($akun->id)],
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $akun->nama = $validated['nama'];
        $akun->email = $validated['email'];

        if (!empty($validated['password'])) {
            $akun->password = Hash::make($validated['password']);
        }

        $akun->save();

        return redirect()->route('admin.akun.index')->with('success', 'Akun admin berhasil diperbarui.');
    }

    public function destroy(Admin $akun)
    {
        // SEKENARIO GAGAL: tidak bisa hapus akun sendiri yang sedang login
        if ($akun->id === Auth::guard('admin')->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri yang sedang login.');
        }

        $akun->delete();

        return back()->with('success', 'Akun admin berhasil dihapus.');
    }
}