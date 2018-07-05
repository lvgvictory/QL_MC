<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TieuChi;

class AjaxController extends Controller
{
    public function getTieuChi(Request $resquest)
    {
        try{
            $id = $resquest->id;
            
            $tieuchis = TieuChi::where('tieuchuan_id', $id)->get();

            $result = '';

            foreach ($tieuchis as $tieuchi) {
                $result .= '<option value="'.$tieuchi->id.'">
                                '.$tieuchi->ten_tieu_chi.'
                            </option>';
            }

            return $result;
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
        }
    }
}
