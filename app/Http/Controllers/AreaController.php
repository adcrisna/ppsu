<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use Redirect;
use Auth;
use DB;

class AreaController extends Controller
{
    public function index(){
        $data['title'] = "Data Area";
        $data['nama'] = Auth::user()->name;
        $data['area'] = Area::all();
        return view('Area/index',$data);
    }
    public function addArea(Request $request) {
        DB::beginTransaction();
        try {
            $area = new Area;
            $area->name = $request->name;
            $area->rw = $request->rw;
            $area->jumlah_rt = $request->jumlah_rt;
            $area->alamat = $request->alamat;
            $area->telepon = $request->phone;
            $area->admin_id = Auth::user()->id;
            $area->save();
            
            DB::commit();
            \Session::flash('msg_success','Data Area Berhasil Ditambah!');
            return Redirect::route('admin.area');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.area');
        }
    }
    public function updateArea(Request $request)
    {
        
        DB::beginTransaction();
        try {
            
                $area = Area::find($request->id);
                $area->name = $request->name;
                $area->rw = $request->rw;
                $area->jumlah_rt = $request->jumlah_rt;
                $area->alamat = $request->alamat;
                $area->telepon = $request->phone;
                $area->save();
            
            DB::commit();
            \Session::flash('msg_success','Data Area Berhasil Diubah!');
            return Redirect::route('admin.area');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.area');
        }
    }
    public function deleteArea($id)
    {
        DB::beginTransaction();
        try {
            Area::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Area Berhasil Dihapus!');
            return Redirect::route('admin.area');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.area');
        }
    }
}
