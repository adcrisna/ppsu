<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Tim;
use Redirect;
use Auth;
use DB;

class TimController extends Controller
{
    public function index(){
        $data['title'] = "Data Tim";
        $data['nama'] = Auth::user()->name;
        $data['area'] = Area::all();
        $data['koordinator'] = User::where('role','2')->get();
        $data['tim'] = Tim::all();
        return view('Tim/index',$data);
    }
    public function addTim(Request $request) {
        DB::beginTransaction();
        try {
            $tim = new Tim;
            $tim->name = $request->name;
            $tim->jumlah_personel = $request->jumlahPersonel;
            $tim->koordinator_id = $request->koordinator;
            $tim->area_id = $request->area;
            $tim->save();
            
            DB::commit();
            \Session::flash('msg_success','Data Tim Berhasil Ditambah!');
            return Redirect::route('admin.tim');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.tim');
        }
    }
    public function updateTim(Request $request)
    {
        
        DB::beginTransaction();
        try {
            
                $tim = Tim::find($request->id);
                $tim->name = $request->name;
                $tim->jumlah_personel = $request->jumlahPersonel;
                $tim->koordinator_id = $request->koordinator;
                $tim->area_id = $request->area;
                $tim->save();
            
            DB::commit();
            \Session::flash('msg_success','Data Tim Berhasil Diubah!');
            return Redirect::route('admin.tim');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.tim');
        }
    }
    public function deleteTim($id)
    {
        DB::beginTransaction();
        try {
            Tim::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Tim Berhasil Dihapus!');
            return Redirect::route('admin.tim');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.tim');
        }
    }
}
