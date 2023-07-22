<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BukuController extends Controller
{
    function  index()
    {
        $title = 'buku';
        $user = Session::get('id');
        $kategori = Kategori::all();
        $buku = Buku::with('kategori')->where('id', $user)->paginate(5);
        return view('buku.index', compact('buku', 'title', 'kategori'));
    }
    function create()
    {
        $kategori = Kategori::all();
        $title = 'add buku';
        return view('buku.add-buku', compact('title', 'kategori'));
    }
    function store(Request $request)
    {
        // user_id
        $user = User::where('nama', Session::get('nama'))->get();
        $user_id = $user[0]->id;

        $data = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'file' => 'required',
            'cover' => 'nullable',
            'kategori_id' => 'required',
            'user_id' => '',
        ]);

        $data['user_id'] = $user_id;

        // tambah gambar
        $namaFile = null;
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            if ($cover) {
                $extension = $cover->getClientOriginalExtension();
                $namaFile = Str::uuid() . '.' . $extension; // buat nama unique
                $cover->storeAs('public/cover/', $namaFile);
            }
        }
        $data['cover'] = $namaFile;

        // tambah pdf
        if ($request->hasFile('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();
            $namaFile = Str::uuid() . '.' . $extension; // buat nama unique
            $request->file('file')->storeAs('public/pdfs', $namaFile);
        }
        $data['file'] = $namaFile;

        Buku::create($data);
        return redirect('/buku')->with('insert', 'Data Buku Berhasil Ditambahkan!');
    }

    function edit(Request $request, $id)
    {
        $title = 'Edit Buku';
        $buku = Buku::with('kategori')->findOrFail($id);
        $kategori = Kategori::all();
        return view('buku.edit-buku', compact('title', 'buku', 'kategori'));
    }

    function update(Request $request, $id)
    {
        $data = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'file' => 'required|mimes:pdf',
            'cover' => 'nullable',
            'kategori_id' => 'required',
        ]);

        // tambah gambar
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            if ($cover) {
                $extension = $cover->getClientOriginalExtension();
                $namaFile = Str::uuid() . '.' . $extension; // buat nama unique
                $cover->storeAs('public/cover/', $namaFile);
                $data['cover'] = $namaFile;
            } else {
                unset($data['cover']);
            }
        }

        // tambah pdf
        if ($request->hasFile('file')) {
            $pdfPath = $request->file('file')->store('public/pdf');

            $data['file'] = $pdfPath;

            Buku::where('id', $id)->update($data);
            return redirect('/buku')->with('update', 'Data Buku Berhasil Diubah!');
        }
    }
    function destroy($id)
    {
        Buku::destroy($id);
        return redirect('/buku')->with('delete', 'Data Buku Berhasil Dihapus!');
    }

    function cari(Request $request)
    {
        $title = 'Halaman List Buku';
        $cari = $request->cari;
        $kategoriArray = $request->kategori;
        $kategori = Kategori::all();

        if ($kategoriArray) {
            $buku = Buku::with('kategori')
                ->where('judul', 'like', "%" . $cari . "%")
                ->whereIn('kategori_id', $kategoriArray)->paginate(5);
        } else {
            $buku = Buku::with('kategori')
                ->where('judul', 'like', "%" . $cari . "%")->paginate(5);
        }

        return view('buku/index', compact('title', 'buku', 'kategori'));
    }

    function pdf($id)
    {
        $buku = Buku::findOrFail($id);
        $pdf = public_path() . '/storage/pdfs/' . $buku->file;
        return response()->file($pdf);
    }
}
