<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tieuchuan;
use App\Tieuchi;
use App\Minhchung;
use App\Vanban;
use App\User;

class AdminController extends Controller
{
    public function getIndex()
    {
    	$countTieuChuan = Tieuchuan::all();
    	$countTieuChi = Tieuchi::all();
    	$countMinhChung = Minhchung::all();
    	$countVanBan = Vanban::all();
    	$countUser = User::all();

    	return view('admin.thongke', compact([
    		'countTieuChuan',
    		'countTieuChi',
    		'countMinhChung',
    		'countVanBan',
    		'countUser'
    	]));
    }

    public function downloadTieuChuan($id)
    {
        $tieuchuan = Tieuchuan::findOrFail($id);
        $tieuchuan->load('tieuchis');

        return view('admin.download', compact('tieuchuan'));
    }
}
