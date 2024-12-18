<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Member;
use App\Models\PaketMember;
use App\Models\Pendapat;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function checkuser(){
        return Auth::check();
    }
    public function profile(){
        if ($this->checkuser() == true) {
            $idActive = Auth::id();
            $user = User::findorFail($idActive);
            return view('admin/profile-admin',compact('user'));
        } else {
            return redirect('/login');
        }
    }
    public function ubahprofile(Request $request,$id){
        $users = User::findorFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->save();
        return redirect('/admin-profile');
    }
    public function acceptcs(){
        $kritiksarans = Pendapat::latest()->paginate();
        return view('admin/acceptcs',compact('kritiksarans'));
    }
    public function deleteks($id){
        $kritiksaran = Pendapat::findOrFail($id);
        $kritiksaran->delete();
        return redirect('admin-kritiksaran')->with('status','saran berhasil dihapus');
    }
    // BAGIAN CRUD UNTUK PENGGUNA(USER)
    public function userlist(){
        $users = User::where('role','!=','admin')->get();
        return view('admin/user/index',compact('users'));
    }
    public function useradd(){
        return view('admin/user/create');
    }
    public function userstore(Request $request){
        $validated = $request->validate([
            'name' =>  ['required','string'],
            'email' => ['required', 'email','unique:users'],
            'role'=>['required','in:member,guest'],
            'password' => ['required','min:8']
        ]);
        $flight = new User();
        $flight->name = $request->name;
        $flight->email = $request->email;
        $flight->role = $request->role;
        $flight->password = Hash::make($request->password);        
        $flight->save();
        return redirect('/admin-datauser')->with('status','User Baru Berhasil Ditambahkan');
    }
    public function useredit($id){
        $users = User::findorFail($id);
        return view('admin/user/edit',compact('users'));
    }
    public function userupdate(Request $request,$id){
        $users = User::findorFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->role = $request->role;
        $users->save();
        return redirect('/admin-datauser')->with('status','Data User Berhasil Diubah');
    }
    public function userdelete($id){
        $users = User::findorFail($id);
        $users->delete();
        return redirect('/admin-datauser')->with('status','Data User Berhasil Dihapus');
    }
    // BAGIAN CRUD UNTUK PENGGUNA(USER)

    // BAGIAN CRUD UNTUK PAKET-MEMBER
    public function adminpm(){
        $paketmembers = PaketMember::all();
        return view('admin/paket-member/index',compact('paketmembers'));
    }
    public function adminaddpm(){
        return view('admin/paket-member/create');
    }
    public function adminstorepm(Request $request){
        $request->validate([
            'durasi' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required|string|in:tersedia,tidak_tersedia'
        ]);
        $product = new PaketMember();
        $product->durasi = $request->durasi;
        $product->harga = $request->harga;
        $product->status = $request->status;
        $product->user_id = Auth::id();
        $product->save();   
        return redirect('/admin-paketmember')->with('status','Paket Member Berhasil Ditambahkan');
    }
    public function admineditpm($id){
        $paketmember = PaketMember::findorFail($id);
        return view('admin/paket-member/edit',compact('paketmember'));
    }
    public function adminupdatepm(Request $request,$id){
        $paketmember = PaketMember::findOrFail($id);
        $paketmember->durasi = $request->durasi;
        $paketmember->harga = $request->harga;
        $paketmember->status = $request->status;
        $paketmember->user_id = Auth::id();
        $paketmember->save();   
        return redirect('/admin-paketmember')->with('status','Paket Member Berhasil Diubah');
    }
    public function admindeletepm($id){
        $paketmember = PaketMember::findOrFail($id);
        $paketmember->delete();
        return redirect('/admin-paketmember')->with('status','Paket Member Berhasil Dihapus');                
    }
    // BAGIAN CRUD UNTUK PAKET-MEMBER

    // BAGIAN ADMIN UNTUK MENAMBAHKAN / MENGUBAH MEMBER
    public function adminmemberlist(){
        $members = Member::latest()->paginate();
        $pakets = PaketMember::all();
        $usermembers = User::where('role','member')->get();
        return view('admin/member/index',compact('members','usermembers','pakets'));
    }
    public function adminnewmember(Request $request){
        $request->validate([
            'telepon' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'alamat'=>'required'
        ]);
        $member = new Member();
        $member->id_pakets = $request->id_pakets;
        $member->nama_member = $request->nama_member;
        $member->telepon = $request->telepon;
        $member->alamat = $request->alamat;
        $member->tanggal_mulai = $request->tanggal_mulai;
        $member->tanggal_selesai = $request->tanggal_selesai;
        $member->user_id = Auth::id();
        $member->save();   
        return redirect('/admin-datamember')->with('status','Member Berhasil Ditambahkan');
    }
    public function adminupdatemember(Request $request,$id){
        $request->validate([
            'telepon' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'alamat'=>'required'
        ]);
        $member = Member::findOrFail($id);
        $member->id_pakets = $request->id_pakets;
        $member->telepon = $request->telepon;
        $member->alamat = $request->alamat;
        $member->tanggal_mulai = $request->tanggal_mulai;
        $member->tanggal_selesai = $request->tanggal_selesai;
        $member->user_id = Auth::id();
        $member->save();   
        return redirect('/admin-datamember')->with('status','Member Berhasil Diubah');
    }
    public function admindeletemember($id){
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect('/admin-datamember')->with('status','Member Berhasil Dihapus');
    }
    // BAGIAN ADMIN UNTUK MENAMBAHKAN / MENGUBAH MEMBER

    // BAGIAN ADMIN UNTUK MELIHAT DATA TRANSAKSI
    public function admintf(){
        $transaksis = Transaksi::latest()->paginate(5);
        return view('admin/transaksi/index',compact('transaksis'));
    }
    // BAGIAN ADMIN UNTUK MELIHAT DATA TRANSAKSI

    // BAGIAN ADMIN UNTUK MELIHAT KESELURUHAN DATA TRANSAKSI SECARA SPESIFIK
    public function admintfshow($id)
    {
        $transaksi = Transaksi::with('detailtransaksi')->where('id', $id)->firstOrFail();
        return view('admin/transaksi/detail', compact('transaksi'));
    }
    // BAGIAN ADMIN UNTUK MELIHAT KESELURUHAN DATA TRANSAKSI SECARA SPESIFIK
    
    // BAGIAN ADMIN UNTUK MELAKUKAN CRUD FRENTLY ASKED QUESTION
    public function adminfaq(){
        $faqs = Faq::latest()->paginate();
        return view('admin/faq/index',compact('faqs'));
    }
    public function adminnewfaq(Request $request){
        $request->validate([
            'pertanyaan'=>'required',
            'jawaban'=>'required'
        ]);
        $faqs = new Faq();
        $faqs->pertanyaan = $request->pertanyaan;
        $faqs->jawaban = $request->jawaban;
        $faqs->save();   
        return redirect('/admin-faq')->with('status','Faq Berhasil Ditambahkan');
    }
    public function adminupdatefaq(Request $request,$id){
        $request->validate([
            'pertanyaan'=>'required',
            'jawaban'=>'required'
        ]);
        $faqs = Faq::findorFail($id);
        $faqs->pertanyaan = $request->pertanyaan;
        $faqs->jawaban = $request->jawaban;
        $faqs->save();   
        return redirect('/admin-faq')->with('status','Faq Berhasil DiUpdate');
    }
    public function admindeletefaq($id){
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect('/admin-faq')->with('status','Faq Berhasil Dihapus');
    }
    // BAGIAN ADMIN UNTUK MELAKUKAN CRUD FRENTLY ASKED QUESTION
}
