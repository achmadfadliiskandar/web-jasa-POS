<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\User;
use App\Models\Member;
use App\Models\PaketMember;
use App\Models\Pendapat;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function checkuser()
    {
        return Auth::check();
    }
    public function welcome()
    {
        $paketmembers = PaketMember::where('status', 'tersedia')->get();
        $faqs = Faq::latest()->paginate();
        return view('frontend/welcome', compact('paketmembers', 'faqs'));
    }
    public function sendck(Request $request){
        $validated = $request->validate([
            'nama' => 'required',
            'email'=> 'required|email',
            'kritik_saran'=> 'required'
        ]);
        $pendapat = new Pendapat();
        $pendapat->nama = $request->nama;
        $pendapat->email = $request->email;
        $pendapat->kritik_saran = $request->kritik_saran;
        $pendapat->save();
        return redirect('/')->with('status','Terima Kasih Atas kritik dan saranya');
    }
    public function index()
    {
        if ($this->checkuser() == true) {
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'guest') {
                $members = Member::count();
                $transaksis = Transaksi::sum('total');
                $tfpenjualan = Transaksi::count();
                return view('frontend/index', compact('members', 'transaksis', 'tfpenjualan'));
            } else {
                $transaksis = Transaksi::where('user_id',Auth::user()->id)->sum('total');
                $tfpenjualan = Transaksi::where('user_id',Auth::user()->id)->count();
                return view('frontend/index', compact('transaksis', 'tfpenjualan'));
            }
        } else {
            return redirect('/login');
        }
    }
}
