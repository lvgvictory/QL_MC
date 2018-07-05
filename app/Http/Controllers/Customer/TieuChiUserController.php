<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tieuchuan;
use App\Tieuchi;
use App\Minhchung;

class TieuChiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieuchis = Tieuchi::orderBy('id', 'DESC')->get();

        return view('customer.tieuchi.list', compact('tieuchis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $tieuchuans = Tieuchuan::all();
            $tieuchis = Tieuchi::all();
            $minhchungs = Minhchung::all();

            return view('customer.tieuchi.add', compact([
                'tieuchuans',
                'tieuchis',
                'minhchungs'
            ]));
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $id = $request->sltTenTieuChi;
            $tieuchi = Tieuchi::findOrFail($id);
            $tieuchi->mo_ta = $request->treaMoTa;
            $tieuchi->diem_manh = $request->treaDiemManh;
            $tieuchi->nhung_ton_tai = $request->treaTonTai;
            $tieuchi->ke_hoach_cai_tien = $request->treaCaiTien;
            $tieuchi->tu_danh_gia = $request->rdDG;
            $tieuchi->save();

            return redirect()->route('tieuchi-user.index')->with(['flash_level'=>'success','flash_message'=>'Thêm thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
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
            $tieuchuans = Tieuchuan::all();
            $tieuchis = Tieuchi::all();
            $minhchungs = Minhchung::all();
            $tieuchi = Tieuchi::findOrFail($id);

            return view('customer.tieuchi.edit', compact([
                'tieuchi',
                'tieuchuans',
                'tieuchis',
                'minhchungs'
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
        try{
            $tieuchi = Tieuchi::findOrFail($id);
            $tieuchi->mo_ta = $request->treaMoTa;
            $tieuchi->diem_manh = $request->treaDiemManh;
            $tieuchi->nhung_ton_tai = $request->treaTonTai;
            $tieuchi->ke_hoach_cai_tien = $request->treaCaiTien;
            $tieuchi->tu_danh_gia = $request->rdDG;
            $tieuchi->save();

            return redirect()->route('tieuchi-user.index')->with(['flash_level'=>'success','flash_message'=>'Cập nhật thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
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
            $tieuchi = Tieuchi::findOrFail($id);
            $tieuchi->delete();

            return redirect()->route('tieuchi-user.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }
}
