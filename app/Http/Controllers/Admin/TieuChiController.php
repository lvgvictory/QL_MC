<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TieuChuan;
use App\TieuChi;

class TieuChiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieuchis = TieuChi::with('tieuchuan')->get();
        
        return view('admin.tieuchi.list', compact('tieuchis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tieuchuans = TieuChuan::all();

        return view('admin.tieuchi.add', compact('tieuchuans'));
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

            $tieuchi = new TieuChi();
            $tieuchi->ten_tieu_chi = $request->txtTenTc;
            $tieuchi->tieuchuan_id = $request->sltTenTc;
            $tieuchi->user_id = 1;
            $tieuchi->save();

            return redirect()->route('tieuchi.index')->with(['flash_level'=>'success','flash_message'=>'Thêm thành công']);
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
            $tieuchi = TieuChi::findOrFail($id);
            $tieuchuans = TieuChuan::all();

            return view('admin.tieuchi.edit', compact([
                'tieuchi',
                'tieuchuans'
            ]));
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
            $tieuchi = TieuChi::findOrFail($id);
            $tieuchi->ten_tieu_chi = $request->txtTenTc;
            $tieuchi->tieuchuan_id = $request->sltTenTc;
            $tieuchi->save();

            return redirect()->route('tieuchi.index')->with(['flash_level'=>'success','flash_message'=>'Sửa thành công']);
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
            $tieuchi = TieuChi::findOrFail($id);
            $tieuchi->delete();

            return redirect()->route('tieuchi.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }
}
