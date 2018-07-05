<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TieuChuan;

class TieuChuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieuchuans = TieuChuan::orderBy('id','DESC')->get();

        return view('admin.tieuchuan.list', compact('tieuchuans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tieuchuan.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $tieuchuan = new TieuChuan();
            $tieuchuan->ten_tieu_chuan = $request->txtTenTc;
            $tieuchuan->save();

            return redirect()->route('tieuchuan.index')->with(['flash_level'=>'success','flash_message'=>'Thêm thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $tieuchuan = TieuChuan::findOrFail($id);

            return view('admin.tieuchuan.edit', compact('tieuchuan'));
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $tieuchuan = TieuChuan::findOrFail($id);
            $tieuchuan->ten_tieu_chuan = $request->txtTenTc;
            $tieuchuan->save();

            return redirect()->route('tieuchuan.index')->with(['flash_level'=>'success','flash_message'=>'Sửa thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $id = $id;
            $tieuchuan = TieuChuan::findOrFail($id);
            $tieuchuan->delete();

            return redirect()->route('tieuchuan.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }
}
