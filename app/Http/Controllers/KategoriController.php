<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    function index()
    {
        $title = 'kategori';
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori', 'title'));
    }
    function create()
    {
        $title = 'add Kategori';
        return view('kategori.add-kategori', compact('title'));
    }
    function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        Kategori::create($data);
        return redirect('/kategori')->with('insert', 'Data Kategori Berhasil Ditambahkan!');
    }
    function edit(Request $request, $id)
    {
        $title = 'Edit Kategori';
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit-kategori', compact('title', 'kategori'));
    }
    function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        Kategori::where('id', $id)->update($data);
        return redirect('/kategori')->with('update', 'Data kategori Berhasil Diubah!');
    }
    function destroy($id)
    {
        Kategori::destroy($id);
        return redirect('/kategori')->with('delete', 'Data kategori Berhasil Dihapus!');
    }
    function cari(Request $request)
    {
        $title = 'kategori';
        $cari = $request->cari;
        $kategori = Kategori::where('nama', 'like', "%" . $cari . "%")->paginate(5);
        return view('kategori.index', compact('kategori', 'title'));
    }
}
