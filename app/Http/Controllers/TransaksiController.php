<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cart;
use App\Models\DetailTransaksi;
use App\Models\Member;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function checkuser()
    {
        return Auth::check();
    }
    public function index()
    {
        if ($this->checkuser() == true) {
            if (Auth::user()->role == 'member') {
                $transaksis = Transaksi::where('user_id', Auth::id())->get();
                return view('member/transaksi/index', compact('transaksis'));
            }
        } else {
            return redirect('/login');
        }
    }
    public function store()
    {
        date_default_timezone_set("Asia/Jakarta");
        $carts = Cart::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $totalharga = number_format($carts->sum(function ($item) {
            return (float) str_replace(',', '', $item->totalharga);
        }), 3, '.', ',',);
        $member = Member::where('nama_member', Auth::user()->name)->first();
        // transaksi
        $transaksis = new Transaksi();
        $transaksis->id_members = $member->id;
        $transaksis->user_id = Auth::user()->id;
        $transaksis->total = $totalharga;
        $transaksis->tanggal_transaksi = date("Y-m-d");
        $transaksis->save();

        foreach ($carts as $value) {
            DetailTransaksi::create([
                'id_transaksis' => $transaksis->id,
                'id_barangs' => $value->id_barangs,
                'kuantitas' => $value->stok,
                'harga_satuan' => $value->barang->harga_barang,
                'subtotal' => $value->totalharga,
                'user_id' => Auth::user()->id,
            ]);
            $barang = Barang::where('id', $value->id_barangs)->first();
            $barang->stok = $barang->stok - $value->stok;
            $barang->update();

            $keranjangg = Cart::where('user_id', Auth::user()->id);
            $keranjangg->delete();
        }
        return redirect('keranjang')->with('status', 'Pembelian berhasil');
    }
    public function show($id)
    {
        $transaksi = Transaksi::with('detailtransaksi')->where('id', $id)->firstOrFail();
        return view('member/transaksi/detail-transaksi', compact('transaksi'));
    }
}
