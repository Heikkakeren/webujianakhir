<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laptop;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $laptops = Laptop::all();

        if (auth()->check()) {
            $transactions = auth()->user()->transactions()->with('laptop')->get();
        } else {
            $transactions = [];
        }

        return view('user.home', compact('laptops', 'transactions'));
    }

    // 🔥 Fungsi checkout() sudah ada
    public function checkout(Request $request)
    {
        $request->validate([
            'laptop_id' => 'required|exists:laptops,id',
            'user_name' => 'required',
            'jumlah' => 'required|numeric|min:1'
        ]);

        $laptop = Laptop::findOrFail($request->laptop_id);
        $jumlah = $request->jumlah;
        $total = $laptop->harga * $jumlah;

        $data = [
            'laptop_id' => $laptop->id,
            'user_name' => $request->user_name,
            'jumlah' => $jumlah,
            'total_harga' => $total
        ];

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        Transaction::create($data);

        return redirect()->back()->with('success', 'Pembelian berhasil!');
    }

    // 🔍 Fungsi search() ditambahkan di sini
    public function search(Request $request)
    {
        $search = $request->input('search');

        // Cari laptop berdasarkan nama atau kode
        $laptops = Laptop::where('nama', 'like', "%$search%")
                         ->orWhere('kode', 'like', "%$search%")
                         ->get();

        if (auth()->check()) {
            $transactions = auth()->user()->transactions()->with('laptop')->get();
        } else {
            $transactions = [];
        }

        return view('user.home', compact('laptops', 'transactions'));
    }
}