<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tieuchuan;

class TieuChuanUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieuchuans = Tieuchuan::orderBy('id','DESC')->get();

        return view('customer.tieuchuan.list', compact('tieuchuans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tieuchuans = Tieuchuan::all();

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
        $this->validate($request, 
            [
                'sltTenTc' => 'required',
                'treaMoDau' => 'required',
                'treaKetLuan' => 'required'
            ],
            [
                'sltTenTc.required' => 'Vui lòng chọn tiêu chuẩn',
                'treaMoDau.required' => 'Vui lòng nhập mở đầu',
                'treaKetLuan.required' => 'Vui lòng nhập kết luận'
                
            ]
        );
        try {
            $tieuchuan = Tieuchuan::findOrFail($request->sltTenTc);
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
        try {
            $tieuchuan = Tieuchuan::findOrFail($id);

            return view('customer.tieuchuan.detail', compact('tieuchuan'));
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tieuchuan = Tieuchuan::findOrFail($id);
        $tieuchuans = Tieuchuan::all();

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
        $this->validate($request, 
            [
                'sltTenTc' => 'required',
                'treaMoDau' => 'required',
                'treaKetLuan' => 'required'
            ],
            [
                'sltTenTc.required' => 'Vui lòng chọn tiêu chuẩn',
                'treaMoDau.required' => 'Vui lòng nhập mở đầu',
                'treaKetLuan.required' => 'Vui lòng nhập kết luận'
                
            ]
        );
        try {
            $tieuchuan = Tieuchuan::findOrFail($id);
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
            $tieuchuan = Tieuchuan::findOrFail($id);
            $tieuchuan->delete();

            return redirect()->route('tieuchuan-user.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }
}
