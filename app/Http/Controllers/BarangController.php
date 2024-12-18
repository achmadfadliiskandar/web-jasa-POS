<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function checkuser()
    {
        return Auth::check();
    }
    public function index()
    {
        if ($this->checkuser() == true) {
            if (Auth::user()->role == 'member' && Member::where('nama_member', Auth::user()->name)->exists()) {
                $barangs = Barang::where('user_id', Auth::id())->get();
                return view('member/barang/index', compact('barangs'));
            }elseif (Auth::user()->role == 'admin') {
                $barangs = Barang::all();
                return view('member/barang/index', compact('barangs'));
            }else {
                return redirect('/dashboard');
            }
        } else {
            return redirect('/login');
        }
    }
    public function create()
    {
        if ($this->checkuser() == true) {
            if (Auth::user()->role == 'member' || Auth::user()->role == 'admin') {
                return view('member/barang/create');
            }
        } else {
            return redirect('/login');
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);
        // inputan gambar ke folder gambar_barang di public
        $gambarbarang = time() . '.' . $request->gambar_barang->getClientOriginalExtension();
        $request->gambar_barang->move(public_path('gambar_barang'), $gambarbarang);
        // end
        $barang = new Barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_barang = number_format($request->harga_barang, 0, ',', '.');
        $barang->stok = $request->stok;
        $barang->gambar_barang = $gambarbarang;
        $barang->user_id = Auth::id();
        $barang->save();
        return redirect('/barang')->with('status', 'Barang Berhasil Ditambah');
    }
    public function edit($id)
    {
        $barang = Barang::findorFail($id);
        return view('member/barang/edit', compact('barang'));
    }
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Update nama, harga, dan stok
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_barang = number_format($request->harga_barang, 0, ',', '.');
        $barang->stok = $request->stok;

        // Cek jika ada gambar baru yang diupload
        if ($request->hasFile('gambar_barang')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar_barang) {
                $oldImagePath = public_path('gambar_barang/' . $barang->gambar_barang);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Hapus file gambar lama
                }
            }
            // Simpan gambar baru
            $gambarNama = time() . '.' . $request->gambar_barang->getClientOriginalExtension();
            $request->gambar_barang->move(public_path('gambar_barang'), $gambarNama);
            $barang->gambar_barang = $gambarNama; // Update nama gambar
        }
        $barang->save(); // Simpan perubahan ke database
        return redirect('/barang')->with('status', 'Data Barang Berhasil Diubah');
    }
    public function delete($id)
    {
        $barang = Barang::findOrFail($id);
        // Hapus gambar dari folder jika ada
        if ($barang->gambar_barang) {
            $imagePath = public_path('gambar_barang/' . $barang->gambar_barang);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Hapus file gambar
            }
        }
        // Hapus data barang dari database
        $barang->delete();
        return redirect('/barang')->with('status', 'Data Barang Berhasil Dihapus');
    }
}
