<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    function  index()
    {
        $title = 'buku';
        $kategori = Kategori::all();

        //seleksi buku sesuai user
        $userLogin = Session::get('user');
        if ($userLogin == 1) {
            $buku = Buku::with('kategori', 'user')->paginate(5);
        } else {
            $buku = Buku::with('kategori')->where('user_id', $userLogin)->paginate(5);
        }
        return view('buku.index', compact('buku', 'title', 'kategori', 'userLogin'));
    }
    function create()
    {
        $kategori = Kategori::all();
        $title = 'add buku';
        return view('buku.add-buku', compact('title', 'kategori'));
    }
    function store(Request $request)
    {

        $userLogin = Session::get('user');
        $user_id = User::where('id', $userLogin)->first();
        $data = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'file' => 'required',
            'cover' => 'required',
            'kategori_id' => 'required',
        ]);

        $data['user_id'] = $userLogin;

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
            'file' => 'mimes:pdf',
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
        $buku = Buku::findOrFail($id);
        $pdfPath = $buku->file;

        if ($request->hasFile('file')) {
            $pdf = $request->file('file');
            if ($pdf) {
                $extension = $request->file('file')->getClientOriginalExtension();
                $pdfPath = Str::uuid() . '.' . $extension; // buat nama unique
                $request->file('file')->storeAs('public/pdfs', $pdfPath);
            } else {
                unset($data['file']);
            }
        }
        $data['file'] = $pdfPath;
        Buku::where('id', $id)->update($data);
        return redirect('/buku')->with('update', 'Data Buku Berhasil Diubah!');
    }
    function destroy($id)
    {
        Buku::destroy($id);
        return redirect('/buku')->with('delete', 'Data Buku Berhasil Dihapus!');
    }

    function cari(Request $request, $id)
    {
        $userLogin = $id;
        $title = 'Halaman List Buku';
        $cari = $request->cari;
        $kategoriArray = $request->kategori;
        $kategori = Kategori::all();

        $isAdmin = Auth::user()->isAdmin;

        if ($isAdmin) {
            if (!$cari && $kategoriArray) {
                $buku = Buku::with('kategori')
                    ->whereIn('kategori_id', $kategoriArray)
                    ->get();
            } else {
                if ($cari) {
                    if ($kategoriArray) {
                        $buku = Buku::with('kategori')
                            ->whereIn('kategori_id', $kategoriArray)
                            ->where('judul', 'like', "%" . $cari . "%")
                            ->get();
                    } else {
                        $buku = Buku::with('kategori')
                            ->where('judul', 'like', "%" . $cari . "%")
                            ->get();
                    }
                } else {
                    return $this->index();
                }
            }
        } else {
            if (!$cari && $kategoriArray) {
                $buku = Buku::with('kategori')
                    ->whereIn('kategori_id', $kategoriArray)
                    ->where('user_id', $userLogin)
                    ->get();
            } else {
                if ($cari) {
                    if ($kategoriArray) {
                        $buku = Buku::with('kategori')
                            ->whereIn('kategori_id', $kategoriArray)
                            ->where('judul', 'like', "%" . $cari . "%")
                            ->where('user_id', $userLogin)
                            ->get();
                    } else {
                        $buku = Buku::with('kategori')
                            ->where('judul', 'like', "%" . $cari . "%")
                            ->where('user_id', $userLogin)
                            ->get();
                    }
                } else {
                    return $this->index();
                }
            }
        }

        session(['filter-buku' => $buku]);


        return view('buku/index', compact('title', 'buku', 'kategori', 'userLogin'));
    }

    function pdf($id)
    {
        $buku = Buku::findOrFail($id);
        if ($buku && Storage::exists('public/pdfs/' . $buku->file)) {
            $pdf = public_path() . '/storage/pdfs/' . $buku->file;
            return response()->file($pdf);
        } else {
            return redirect('/buku')->with('error', 'Data Buku Tidak Ditemukan!');
        }
    }

    public function laporan_pdf(Request $request)
    {
        $title = 'Halaman Laporan';
        $buku = Buku::all();
        $kontrak = session('filter-buku');

        $html = View('laporan/laporan_cetak', compact('kontrak', 'title', 'kos'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('invoice.pdf', ['Attachment' => false]);
    }
}
