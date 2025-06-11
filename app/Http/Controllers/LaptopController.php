<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laptop;
use Illuminate\Support\Facades\Storage;

class LaptopController extends Controller
{
    public function index()
    {
        $laptops = Laptop::all();
        return view('admin.laptops.index', compact('laptops'));
    }

    public function create()
    {
        return view('admin.laptops.create');
    }

    public function store(Request $request)
    {
        // Validasi: ganti semua kode_laptop → kode
        $request->validate([
            'kode' => 'required|unique:laptops,kode',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
           'stok' => 'required|integer|min:0',
            'prosesor' => 'nullable|string',
            'ram' => 'nullable|string',
            'penyimpanan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        Laptop::create($data);
        return redirect('/admin/laptops')->with('success', 'Laptop berhasil ditambahkan!');
    }

    public function edit(Laptop $laptop)
    {
        return view('admin.laptops.edit', compact('laptop'));
    }

    public function update(Request $request, Laptop $laptop)
    {
        // Validasi: ganti kode_laptop → kode
        $request->validate([
            'kode' => 'required|unique:laptops,kode,'.$laptop->id,
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'prosesor' => 'nullable|string',
            'ram' => 'nullable|string',
            'penyimpanan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($laptop->gambar) Storage::disk('public')->delete($laptop->gambar);
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        $laptop->update($data);
        return redirect('/admin/laptops')->with('success', 'Laptop berhasil diubah!');
    }

    public function destroy(Laptop $laptop)
    {
        if ($laptop->gambar) Storage::disk('public')->delete($laptop->gambar);
        $laptop->delete();
        return redirect('/admin/laptops')->with('success', 'Laptop berhasil dihapus!');
    }
}