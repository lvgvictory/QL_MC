<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Minhchung;
use App\Tieuchuan;
use App\Tieuchi;
use Illuminate\Support\Collection;
use Exception;
use Excel;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;
use PHPExcel_Cell as ExcelCell;

class MinhChungController extends Controller
{
    protected $data;
    const SHEET_NAME = 'sheet';
    protected $exportData;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $minhchungs = Minhchung::orderBy('id', 'DESC')->get();
        
        return view('customer.minhchung.list', compact('minhchungs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tieuchuans = Tieuchuan::all();

        return view('customer.minhchung.add', compact('tieuchuans'));
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
                'sltTenTieuChi' => 'required',
                'txtTenMC' => 'required'
            ],
            [
                'sltTenTc.required' => 'Vui lòng chọn tiêu chuẩn',
                'sltTenTieuChi.required' => 'Vui lòng chọn tiêu chí',
                'txtTenMC.required' => 'Vui lòng nhập tên minh chứng'
            ]
        );
        try{
            $id = 0;
            $minhchungById = Minhchung::orderBy('id', 'DESC')->first();

            if($minhchungById == null)
            {
                $id += 1;
            }
            else {
                $id = $minhchungById->id + 1;
            }  

            $maMC = '[H1.'.$request->sltTenTc.'.'.$request->sltTenTieuChi.'.'.$id.']';
            $minhchung = new Minhchung();
            $minhchung->ten_minh_chung = $request->txtTenMC;
            $minhchung->ma_mc = $maMC;
            $minhchung->tieuchi_id = $request->sltTenTieuChi;
            $minhchung->save();

            return redirect()->route('minhchung.index')->with(['flash_level'=>'success','flash_message'=>'Thêm thành công']);
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
        try {
            $minhchung = Minhchung::findOrFail($id);

            return view('customer.minhchung.detail', compact('minhchung'));
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
        $tieuchuans = Tieuchuan::all();
        $minhchung = Minhchung::findOrFail($id);
        $tieuchuanId = $minhchung->tieuchi->tieuchuan_id;
        $tieuchis = Tieuchi::where('tieuchuan_id', $tieuchuanId)->get();

        return view('customer.minhchung.edit', compact([
            'minhchung',
            'tieuchuans',
            'tieuchis'
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
                'sltTenTieuChi' => 'required',
                'txtTenMC' => 'required'
            ],
            [
                'sltTenTc.required' => 'Vui lòng chọn tiêu chuẩn',
                'sltTenTieuChi.required' => 'Vui lòng chọn tiêu chí',
                'txtTenMC' => 'Vui lòng nhập tên minh chứng'
            ]
        );
        try{
            $minhchung = Minhchung::findOrFail($id);

            $maMC = '[H1.'.$request->sltTenTc.'.'.$request->sltTenTieuChi.'.'.$minhchung->id.']';
            $minhchung->ten_minh_chung = $request->txtTenMC;
            $minhchung->ma_mc = $maMC;
            $minhchung->tieuchi_id = $request->sltTenTieuChi;
            $minhchung->save();

            return redirect()->route('minhchung.index')->with(['flash_level'=>'success','flash_message'=>'Sửa thành công']);
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
            $minhchung = Minhchung::findOrFail($id);
            $minhchung->delete();

            return redirect()->route('minhchung.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }

    public function getDataMinhChung()
    {
        $minhchungs = Minhchung::with('vanbans')
                        ->get()
                        ->transform(function ($arrMinhChung) {
                            $arrMinhChung = $arrMinhChung->toArray();

                            return $this->transformExportMinhChung($arrMinhChung);
                        })->toArray();

        return $minhchungs;
    }

    protected function transformExportMinhChung($arrMinhChung)
    {
        // $tenVanBan = $this->getContentVanBan($arrMinhChung['vanbans'], 'ten_van_ban');
        // $soVanBan = $this->getContentVanBan($arrMinhChung['vanbans'], 'so_van_ban');
        // $noiBanHanh = $this->getContentVanBan($arrMinhChung['vanbans'], 'noi_ban_hanh');
        // $ngayThangNam = $this->getContentVanBan($arrMinhChung['vanbans'], 'ngay_thang_nam');

        // return [
        //     'ma_mc' => $arrMinhChung['ma_mc'],
        //     'ten_minh_chung' => $arrMinhChung['ten_minh_chung'],
        //     'ten_van_ban' => $tenVanBan,
        //     'so_van_ban' =>  $soVanBan,
        //     'noi_ban_hanh' =>  $noiBanHanh,
        //     'ngay_thang_nam' =>  $ngayThangNam,
        // ];

        $vanban = $arrMinhChung['vanbans'] == [] ? [] : $arrMinhChung['vanbans'][0];

        return [
            'ma_mc' => $arrMinhChung['ma_mc'],
            'ten_minh_chung' => $arrMinhChung['ten_minh_chung'],
            'ten_van_ban' => $vanban != [] ? $vanban['ten_van_ban'] : '',
            'so_van_ban' =>  $vanban != [] ? $vanban['so_van_ban'] : '',
            'noi_ban_hanh' =>  $vanban != [] ? $vanban['noi_ban_hanh'] : '',
            'ngay_thang_nam' =>  $vanban != [] ? $vanban['ngay_thang_nam'] : '',
        ];
    }

    // protected function getContentVanBan($arr, $str)
    // {
    //     $content = '';
    //     foreach ($arr as $item) {
    //         $content .= $item[$str] . "\n";
    //     }
    //     $content = trim($content, '"\n"');

    //     return $content;
    // }

   public function exportMinhChung()
    {
        $fileStoragePath = storage_path('app/' . config('export.path.minhchung'));
        // create_dir_if_not_exist(config('export.path.comment_matching'));
        // $file = $this->exportMatchingCommentService->export($jobFair)->store('xlsx', $fileStoragePath, true);
        // dd(2222);
        $file = $this->export('xlsx')->store('xlsx', $fileStoragePath, true);

        return response()->download($file['full']);
    }

    public function export()
    {
        $this->data = $this->getDataMinhChung();
        return Excel::create('DanhSachMinhChung', function (LaravelExcelWriter $excel) {
            if (count($this->data)) {
                $excel->sheet(self::SHEET_NAME, function (LaravelExcelWorksheet $sheet) {
                    $this->applyData($sheet);
                    // $this->applyStyle($sheet);
                });
            } else {
                $excel->sheet('NoData');
            }
        });
    }

    protected function applyData(LaravelExcelWorksheet $sheet)
    {
        $this->exportData = array_merge($this->getHeader(), $this->data);
        // dd($this->data);
        $sheet->rows($this->exportData);
        // dd(111);
    }

    protected function getHeader()
    {
        return [
            ['Mã minh chứng', 'Tên minh chứng', 'Tên văn bản', 'Số văn bản', 'Nơi ban hành', 'Ngày ban hành'],
        ];
    }

    // protected function applyStyle(LaravelExcelWorksheet $sheet)
    // {
    //     $this->applyBasicStyles($sheet);
    //     $this->applyHeaderStyles($sheet);
    //     $this->applyBodyStyles($sheet);
    //     $this->applyColWidth($sheet);
    // }

    // protected function applyBasicStyles(LaravelExcelWorksheet $sheet)
    // {
    //     $maxRow = $sheet->getHighestRow();

    //     for ($i = 1; $i <= $maxRow; $i++) {
    //         $sheet->getRowDimension($i)->setRowHeight(self::ROW_HEIGHT);
    //     }

    //     $sheet->getStyle('A1:I' . ($maxRow))->applyFromArray([
    //         'font' => self::FONT,
    //         'borders' => [
    //             'inside' => ['style' => 'thin'],
    //         ],
    //         'alignment' => ['vertical' => 'center', 'wrap' => true],
    //     ]);

    //     $sheet->getStyle('A1:E' . ($maxRow))->applyFromArray([
    //         'alignment' => ['horizontal' => 'center'],
    //     ]);
    // }

    // protected function applyHeaderStyles(LaravelExcelWorksheet $sheet)
    // {
    //     $sheet->mergeCells('A1:A2');
    //     $sheet->mergeCells('B1:B2');
    //     $sheet->mergeCells('C1:C2');
    //     $sheet->mergeCells('D1:D2');
    //     $sheet->mergeCells('E1:E2');
    //     $sheet->mergeCells('F1:G1');
    //     $sheet->mergeCells('H1:I1');
    //     $sheet->getStyle('A1:I2')->applyFromArray([
    //         'fill' => [
    //             'type' => 'solid',
    //             'color' => ['rgb' => self::TITLE_COLOR],
    //         ],
    //         'alignment' => ['horizontal' => 'center'],
    //     ]);
    // }

    // protected function applyBodyStyles(LaravelExcelWorksheet $sheet)
    // {
    //     $maxRow = $sheet->getHighestRow();
    //     $sheet->getStyle("F1:F{$maxRow}")->applyFromArray([
    //         'alignment' => ['horizontal' => 'center'],
    //     ]);
    //     $sheet->getStyle("H1:H{$maxRow}")->applyFromArray([
    //         'alignment' => ['horizontal' => 'center'],
    //     ]);
    //     $sheet->getStyle("D3:D{$maxRow}")->applyFromArray([
    //         'alignment' => ['horizontal' => 'left'],
    //     ]);
    // }

    // protected function applyColWidth(LaravelExcelWorksheet $sheet)
    // {
    //     $colWidth = [];
    //     foreach (self::COL_WIDTH as $colIndex => $width) {
    //         $colWidth[ExcelCell::stringFromColumnIndex($colIndex)] = $width;
    //     }
    //     $sheet->setWidth($colWidth);
    // }
}
