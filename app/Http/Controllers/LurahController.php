<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Tim;
use App\Models\Jadwal;
use App\Models\Kegiatan;
use Redirect;
use Auth;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KegiatanExport;

class LurahController extends Controller
{
    public function index(){
        $data['title'] = "Dashboard";
        $data['nama'] = Auth::user()->name;
        $data['kegiatan'] = Kegiatan::all();
        return view('Lurah/index',$data);
    }
    public function profile()
    {
        $data['title'] = "Profile";
        $data['nama'] = Auth::user()->name;
        $data['admin'] = User::find(Auth::user()->id);
        return view('Lurah/profile',$data);
    }
    public function updateProfile(Request $request)
    {
        DB::beginTransaction();
        try {
            if (empty($request->password)) {
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->username = $request->username;
                $user->alamat = $request->alamat;
                $user->telepon = $request->phone;
                $user->nip = $request->nip;
                $user->nik = $request->nik;
                $user->save();
            }else {
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->username = $request->username;
                $user->alamat = $request->alamat;
                $user->telepon = $request->phone;
                $user->nip = $request->nip;
                $user->nik = $request->nik;
                $user->password = bcrypt($request->password);
                $user->save();
            }
            DB::commit();
            \Session::flash('msg_success','Data Lurah Berhasil Diubah!');
            return Redirect::route('lurah.profile');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('lurah.profile');
        }
    }
    public function kegiatan()
    {
        $data['title'] = "Data Kegiatan";
        $data['nama'] = Auth::user()->name;
        $data['kegiatan'] = Kegiatan::all();
        return view('Lurah/kegiatan',$data);
    }
    public function detail($id){
        $data['title'] = "Detail Kegiatan";
        $data['nama'] = Auth::user()->name;
        $data['detail'] = Kegiatan::find($id);
        return view('Lurah/detail',$data);
    }
    public function laporan(Request $request){
        return Excel::download(new KegiatanExport($request->tanggalAwal, $request->tanggalAkhir), 'data_kegiatan.xlsx');
    }
}
