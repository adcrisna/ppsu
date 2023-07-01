<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Tim;
use App\Models\Jadwal;
use Redirect;
use Auth;
use DB;

class JadwalController extends Controller
{
    public function index(){
        $data['title'] = "Data Jadwal";
        $data['nama'] = Auth::user()->name;
        $data['jadwal'] = Jadwal::all();
        $data['tim'] = Tim::all();
        return view('Jadwal/index',$data);
    }
    public function addJadwal(Request $request) {
        DB::beginTransaction();
        try {
            $jadwal = new Jadwal;
            $jadwal->hari = $request->hari;
            $jadwal->admin_id = Auth::user()->id;
            $jadwal->tim_id = $request->tim;
            $jadwal->save();
            
            DB::commit();
            \Session::flash('msg_success','Data Jadwal Berhasil Ditambah!');
            return Redirect::route('admin.jadwal');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.jadwal');
        }
    }
    public function updateJadwal(Request $request)
    {
        
        DB::beginTransaction();
        try {
            
            $jadwal = Jadwal::find($request->id);
            $jadwal->hari = $request->hari;
            $jadwal->tim_id = $request->tim;
            $jadwal->save();
            
            DB::commit();
            \Session::flash('msg_success','Data Jadwal Berhasil Diubah!');
            return Redirect::route('admin.jadwal');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.jadwal');
        }
    }
    public function deleteJadwal($id)
    {
        DB::beginTransaction();
        try {
            Jadwal::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Jadwal Berhasil Dihapus!');
            return Redirect::route('admin.jadwal');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.jadwal');
        }
    }
}
