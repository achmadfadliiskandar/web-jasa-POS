<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function checkuser()
    {
        return Auth::check();
    }
    public function index()
    {
        if ($this->checkuser() == true) {
            if (Auth::user()->role == 'member') {
                $barangs = Barang::where('user_id', Auth::id())->get();
                $carts = Cart::where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->get();
                return view('member/cart/index', compact('barangs', 'carts'));
            }
        } else {
            return redirect('/login');
        }
    }
    public function addCart(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barangid = $barang->id;
        $cart = Cart::where('user_id', Auth::user()->id)->where('id_barangs', $barangid)->get();
        // dd($cart);
        if ($cart->count(0)) {
            return back()->with("warning", 'barangnya sudah ada');
        } else {
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->id_barangs = $barang->id;
            $cart->stok = 1;
            if ($request->stok > $barang->stok) {
                return back()->with('warning', 'jumlahnya kebanyakan wkwk');
            } else {
                $cart->totalharga = (float) $barang->harga_barang * (int) $cart->stok;
                $cart->save();
                return redirect('keranjang')->with('status', 'keranjang berhasil ditambahkan');
            }
        }
    }
    public function increaseCart($id)
    {
        $cart = Cart::findOrFail($id);
        $barang = Barang::findOrFail($cart->id_barangs);
        $stok = $cart->stok + 1;
        if ($stok > $barang->stok) {
            return back()->with('warning', 'jumlahnya kebanyakan wkwk');
        }
        $cart->stok = $stok;
        $cart->totalharga = (float) $cart->barang->harga_barang * (int) $cart->stok;
        $cart->save();
        return redirect('keranjang')->with('status', 'stok keranjang berhasil ditambah');
    }
    public function decreaseCart($id)
    {
        $cart = Cart::findOrFail($id);
        $barang = Barang::findOrFail($cart->id_barangs);
        $stok = $cart->stok - 1;
        if ($stok < 1) {
            return back()->with('warning', 'jumlahnya kedikitan wkwk');
        }
        $cart->stok = $stok;
        $cart->totalharga = (float) $cart->barang->harga_barang * (int) $cart->stok;
        $cart->save();
        return redirect('keranjang')->with('status', 'stok keranjang berhasil dikurang');
    }
    public function ForceUpCart(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required|numeric',
        ]);
        $cart = Cart::findOrFail($id);
        $stokInput = $request->input('stok');
        $barang = Barang::findOrFail($cart->id_barangs);
        $maxStok = $barang->stok;
        if ($stokInput < 1) {
            return back()->with('warning', 'Jumlahnya terlalu sedikit wkwk');
        }
        if ($stokInput > $maxStok) {
            return back()->with('warning', 'Jumlahnya kebanyakan wkwk');
        }
        $cart->stok = $stokInput;
        $cart->totalharga = (float) $barang->harga_barang * (int) $stokInput;
        $cart->save();
        return redirect('keranjang')->with('status', 'Keranjang berhasil diperbarui');
    }
    public function DeleteCart($id){
        $cart = Cart::findorFail($id);
        $cart->delete();
        return redirect('keranjang')->with('status', 'Barang Berhasil dihapus dari Keranjang');
    }
    
}
