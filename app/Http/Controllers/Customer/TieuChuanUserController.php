<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TieuChuan;

class TieuChuanUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieuchuans = TieuChuan::orderBy('id','DESC')->get();

        return view('customer.tieuchuan.list', compact('tieuchuans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tieuchuans = TieuChuan::all();

        return view('customer.tieuchuan.add', compact('tieuchuans'));
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
            $tieuchuan = TieuChuan::findOrFail($request->sltTenTc);
            $tieuchuan->mo_dau = $request->treaMoDau;
            $tieuchuan->ket_luan = $request->treaKetLuan;

            $tieuchuan->save();

            return redirect()->route('tieuchuan-user.index')->with(['flash_level'=>'success','flash_message'=>'Thêm thành công']);
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
        $tieuchuan = TieuChuan::findOrFail($id);
        $tieuchuans = TieuChuan::all();

        return view('customer.tieuchuan.edit', compact([
            'tieuchuan',
            'tieuchuans'
        ]));
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
            $tieuchuan->mo_dau = $request->treaMoDau;
            $tieuchuan->ket_luan = $request->treaKetLuan;

            $tieuchuan->save();

            return redirect()->route('tieuchuan-user.index')->with(['flash_level'=>'success','flash_message'=>'Cập nhật thành công']);
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
            $tieuchuan = TieuChuan::findOrFail($id);
            $tieuchuan->delete();

            return redirect()->route('tieuchuan-user.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }
}
