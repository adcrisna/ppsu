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

class AdminController extends Controller
{
    public function index(){
        $data['title'] = "Dashboard";
        $data['nama'] = Auth::user()->name;
        $data['koordinator'] = User::where('role',2)->get();
        $data['tim'] = Tim::all();
        $data['area'] = Area::all();
        $data['kegiatan'] = Kegiatan::all();
        return view('Admin/index',$data);
    }

    public function profile()
    {
        $data['title'] = "Profile";
        $data['nama'] = Auth::user()->name;
        $data['admin'] = User::find(Auth::user()->id);
        return view('Admin/profile',$data);
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
            \Session::flash('msg_success','Data Admin Berhasil Diubah!');
            return Redirect::route('admin.profile');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.profile');
        }
    }
    public function lurah()
    {
        $data['title'] = "Data Lurah";
        $data['nama'] = Auth::user()->name;
        $data['lurah'] = User::where('role','3')->first();
        return view('Admin/dataLurah',$data);
    }
    public function updateLurah(Request $request)
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
            return Redirect::route('admin.lurah');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.lurah');
        }
    }
    public function koordinator() {
        $data['title'] = "Data Koordinator";
        $data['nama'] = Auth::user()->name;
        $data['koordinator'] = User::where('role','2')->get();
        return view('Admin/dataKoordinator',$data);
    }

    public function addKoordinator(Request $request) {
        DB::beginTransaction();
        try {
            $cekData = User::where('username',$request->username)->first();
            if (!empty($cekData)) {
                \Session::flash('msg_error','Username Sudah Digunakan!');
                return Redirect::route('admin.koordinator');
            }
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->alamat = $request->alamat;
            $user->telepon = $request->phone;
            $user->nip = $request->nip;
            $user->nik = $request->nik;
            $user->role = 2;
            $user->password = bcrypt($request->password);
            $user->save();
            
            DB::commit();
            \Session::flash('msg_success','Data Koordinator Berhasil Ditambah!');
            return Redirect::route('admin.koordinator');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.koordinator');
        }
    }
    public function updateKoordinator(Request $request)
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
            \Session::flash('msg_success','Data Koordinator Berhasil Diubah!');
            return Redirect::route('admin.koordinator');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.koordinator');
        }
    }
    public function deleteKoordinator($id)
    {
        DB::beginTransaction();
        try {
            User::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Koordinator Berhasil Dihapus!');
            return Redirect::route('admin.koordinator');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.koordinator');
        }
    }
}
