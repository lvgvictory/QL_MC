<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tieuchi;

class AjaxController extends Controller
{
    public function getTieuChi(Request $request)
    {
        try{
            $id = $request->id;
            
            $tieuchis = Tieuchi::where('tieuchuan_id', $id)->get();

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

    public function getTieuChiNotNull(Request $request)
    {
        try{
            $id = $request->id;
            
            $tieuchis = Tieuchi::where('tieuchuan_id', $id)
                                ->whereNull('mo_ta')
                                ->get();

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
