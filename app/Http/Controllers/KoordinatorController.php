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

class KoordinatorController extends Controller
{
    public function index(){
        $data['title'] = "Dashboard";
        $data['nama'] = Auth::user()->name;
        $data['kegiatan'] = Kegiatan::where('koordinator_id',Auth::user()->id)->get();
        return view('Koordinator/index',$data);
    }
    public function profile()
    {
        $data['title'] = "Profile";
        $data['nama'] = Auth::user()->name;
        $data['admin'] = User::find(Auth::user()->id);
        return view('Koordinator/profile',$data);
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
            \Session::flash('msg_success','Data Koordinator Berhasil Diubah!');
            return Redirect::route('koordinator.profile');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('koordinator.profile');
        }
    }
    public function kegiatan()
    {
        $data['title'] = "Data Kegiatan";
        $data['nama'] = Auth::user()->name;
        $data['kegiatan'] = Kegiatan::where('koordinator_id',Auth::user()->id)->get();
        $data['tim'] = Tim::where('koordinator_id',Auth::user()->id)->first();
        return view('Koordinator/kegiatan',$data);
    }
    public function detail($id){
        $data['title'] = "Detail Kegiatan";
        $data['nama'] = Auth::user()->name;
        $data['detail'] = Kegiatan::find($id);
        return view('Koordinator/detail',$data);
    }
    public function addKegiatan(Request $request) {
        DB::beginTransaction();
        try {
            $namafoto1 = "Foto 1"."  ".$request->timName." ".date("Y-m-d H-i-s");
            $extention1 = $request->file('foto1')->extension();
            $photo1 = sprintf('%s.%0.8s', $namafoto1, $extention1);
            $destination1 = base_path() .'/public/foto';
            $request->file('foto1')->move($destination1,$photo1);

            $namafoto2 = "Foto 2"."  ".$request->timName." ".date("Y-m-d H-i-s");
            $extention2 = $request->file('foto2')->extension();
            $photo2 = sprintf('%s.%0.8s', $namafoto2, $extention2);
            $destination2 = base_path() .'/public/foto';
            $request->file('foto2')->move($destination2,$photo2);

            $namafoto3 = "Foto 3"."  ".$request->timName." ".date("Y-m-d H-i-s");
            $extention3 = $request->file('foto3')->extension();
            $photo3 = sprintf('%s.%0.8s', $namafoto3, $extention3);
            $destination3 = base_path() .'/public/foto';
            $request->file('foto3')->move($destination3,$photo3);

            $kegiatan = new Kegiatan;
            $kegiatan->tim_id = $request->tim;
            $kegiatan->koordinator_id = Auth::user()->id;
            $kegiatan->tanggal_mulai = $request->tanggalMulai;
            $kegiatan->tanggal_selesai = $request->tanggalSelesai;
            $kegiatan->sumber_informasi = $request->sumberInformasi;
            $kegiatan->kondisi_lapangan = $request->kondisiLapangan;
            $kegiatan->penanganan = $request->penanganan;
            $kegiatan->proses_pengerjaan = $request->prosesPengerjaan;
            $kegiatan->keterangan = $request->keterangan;
            $kegiatan->status = "Menunggu";
            $kegiatan->foto1 = $photo1;
            $kegiatan->foto2 = $photo2;
            $kegiatan->foto3 = $photo3;
            $kegiatan->save();
            
            DB::commit();
            \Session::flash('msg_success','Kegiatan Berhasil Ditambah!');
            return Redirect::route('koordinator.kegiatan');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('koordinator.kegiatan');
        }
    }
    public function jadwal()
    {
        $data['title'] = "Data Jadwal";
        $data['nama'] = Auth::user()->name;
        $dataTim = Tim::where('koordinator_id',Auth::user()->id)->first();
        $data['tim'] = Tim::where('koordinator_id',Auth::user()->id)->first();
        $data['jadwal'] = Jadwal::where('tim_id',$dataTim->id)->first();
        return view('Koordinator/jadwal',$data);
    }
}
