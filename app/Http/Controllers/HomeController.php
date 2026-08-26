<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        $produkTerbaru = Produk::latest()->take(8)->get();

        return view('home', compact('produkTerbaru'));
    }
}