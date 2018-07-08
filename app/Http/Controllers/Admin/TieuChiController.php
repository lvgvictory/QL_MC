<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tieuchuan;
use App\Tieuchi;
use Auth;

class TieuChiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tieuchis = Tieuchi::with('tieuchuan')->orderBy('id','DESC')->get();
        
        return view('admin.tieuchi.list', compact('tieuchis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tieuchuans = Tieuchuan::all();

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
        $this->validate($request, 
            [
                'sltTenTc' => 'required',
                'txtTenTc' => 'required'
            ],
            [
                'sltTenTc.required' => 'Vui lòng chọn tiêu chuẩn',
                'txtTenTc.required' => 'Vui lòng nhập tên tiêu chí'                
            ]
        );
        try {

            $tieuchi = new Tieuchi();
            $tieuchi->ten_tieu_chi = $request->txtTenTc;
            $tieuchi->tieuchuan_id = $request->sltTenTc;
            $tieuchi->user_id = Auth::user()->id;
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
        try {
            $tieuchi = Tieuchi::findOrFail($id);

            return view('admin.tieuchi.detail', compact('tieuchi'));
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
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
        try {
            $tieuchi = Tieuchi::findOrFail($id);
            $tieuchuans = Tieuchuan::all();

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
        $this->validate($request, 
            [
                'sltTenTc' => 'required',
                'txtTenTc' => 'required'
            ],
            [
                'sltTenTc.required' => 'Vui lòng chọn tiêu chuẩn',
                'txtTenTc.required' => 'Vui lòng nhập tên tiêu chí'                
            ]
        );
        try {
            $tieuchi = Tieuchi::findOrFail($id);
            $tieuchi->ten_tieu_chi = $request->txtTenTc;
            $tieuchi->tieuchuan_id = $request->sltTenTc;
            $tieuchi->user_id = Auth::user()->id;
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
            $tieuchi = Tieuchi::findOrFail($id);
            $tieuchi->delete();

            return redirect()->route('tieuchi.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }
}
