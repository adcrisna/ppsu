<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Tim;
use App\Models\Kegiatan;
use Redirect;
use Auth;
use DB;

class KegiatanController extends Controller
{
    public function index(){
        $data['title'] = "Data Kegiatan";
        $data['nama'] = Auth::user()->name;
        $data['kegiatan'] = Kegiatan::all();
        return view('Kegiatan/index',$data);
    }
    public function detail($id){
        $data['title'] = "Detail Kegiatan";
        $data['nama'] = Auth::user()->name;
        $data['detail'] = Kegiatan::find($id);
        return view('Kegiatan/detail',$data);
    }
    public function updateKegiatan(Request $request)
    {
        
        DB::beginTransaction();
        try {
                $kegiatan = Kegiatan::find($request->id);
                $kegiatan->status = $request->status;
                $kegiatan->catatan = $request->catatan;
                $kegiatan->save();
            DB::commit();
            \Session::flash('msg_success','Status Kegiatan Berhasil Diubah!');
            return Redirect::route('admin.kegiatan');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.kegiatan');
        }
    }
    public function deleteKegiatan($id)
    {
        DB::beginTransaction();
        try {
            $getKegiatan = Kegiatan::where('id',$id)->first();
            \File::delete(public_path('foto/'.$getKegiatan->foto1));
            \File::delete(public_path('foto/'.$getKegiatan->foto2));
            \File::delete(public_path('foto/'.$getKegiatan->foto3));
            $kegiatan = Kegiatan::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Kegiatan Berhasil Dihapus!');
            return Redirect::route('admin.kegiatan');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.kegiatan');
        }
    }
}
