<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vanban;
use App\Minhchung;
use Carbon\Carbon;

class VanBanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vanbans = Vanban::orderBy('id', 'DESC')->get();
        
        return view('customer.vanban.list', compact('vanbans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $minhchungs = Minhchung::all();

        return view('customer.vanban.add', compact('minhchungs'));
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
                'sltTenMC' => 'required',
                'txtNgayBH' => 'required|date|date_format:"Y/m/d"',
                'flDK' => 'required'
            ],
            [
                'sltTenMC.required' => 'Vui lòng chọn minh chứng',
                'txtNgayBH.required' => 'Vui lòng chọn ngày ban hành',
                'txtNgayBH.date' => 'Ngày ban hành nhập không đúng',
                'txtNgayBH.date_format'=>'Ngày ban hành nhập không đúng định dạng',
                'flDK.required'=>'File không được để trống',
            ]
        );
        try {
            $file = $request->file('flDK');
            $file_Name = $file->getClientOriginalName();
            $vanban = new Vanban();

            $vanban->so_van_ban = $request->txtSoVB;
            $vanban->ten_van_ban = $request->txtTenVB;
            $vanban->noi_ban_hanh = $request->txtNoiBH;
            $vanban->ngay_thang_nam = $request->txtNgayBH;
            $vanban->file = $file_Name;
            $vanban->minhchung_id = $request->sltTenMC;
            $file->move('uploads', $file_Name);

            $vanban->save();

            return redirect()->route('vanban.index')
                            ->with(['flash_level'=>'success','flash_message'=>'Thêm thành công']);
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
            $vanban = Vanban::findOrFail($id);

            return view('customer.vanban.detail', compact('vanban'));
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
        $minhchungs = Minhchung::all();
        $vanban = Vanban::findOrFail($id);

        return view('customer.vanban.edit', compact([
            'minhchungs',
            'vanban'
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
                'sltTenMC' => 'required',
                'txtNgayBH' => 'required|date|date_format:"Y/m/d"',
            ],
            [
                'sltTenMC.required' => 'Vui lòng chọn minh chứng',
                'txtNgayBH.required' => 'Vui lòng chọn ngày ban hành',
                'txtNgayBH.date' => 'Ngày ban hành nhập không đúng',
                'txtNgayBH.date_format'=>'Ngày ban hành nhập không đúng định dạng',
            ]
        );
        try {
            $vanban = Vanban::findOrFail($id);
            $file = $request->file('flDKnew');
            $file_name = '';

            if ($file == null) {
                $file_name = $vanban->file;
            } else {
                $file_name = $file->getClientOriginalName();
                $file->move('uploads', $file_name);
            }

            $vanban->so_van_ban = $request->txtSoVB;
            $vanban->ten_van_ban = $request->txtTenVB;
            $vanban->noi_ban_hanh = $request->txtNoiBH;
            $vanban->ngay_thang_nam = $request->txtNgayBH;
            $vanban->file = $file_name;
            $vanban->minhchung_id = $request->sltTenMC;

            $vanban->save();

            return redirect()->route('vanban.index')
                            ->with(['flash_level'=>'success','flash_message'=>'Cập nhật thành công']);
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
            $vanban = Vanban::findOrFail($id);
            $vanban->delete();

            return redirect()->route('vanban.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }

    public function getDownload($fileName)
    {
        $url = 'uploads/' . $fileName;

        return response()->download($url);
    }
}
