<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function getProfile()
    {
        return view('customer.user.profile');
    }

    public function postProfile(Request $request)
    {
        try {
            $user = User::findOrFail(Auth::user()->id);

            $user->name = $request->txtName;
            $user->address = $request->txtAddress;
            $user->phone = $request->txtPhone;

            $user->save();

            return redirect()->route('user.index')->with(['flash_level'=>'success','flash_message'=>'Cập nhật thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }

    public function getIndex()
    {
        $users = User::all();

        return view('customer.user.list', compact('users'));
    }

    public function getDelete(User $user)
    {
        try {
            $user->delete();

            return redirect()->route('user.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
        }
    }

    public function getShow(User $user)
    {   
        try {
            return view('customer.user.detail', compact('user'));
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
        }
    }

    public function getRole(User $user)
    {
        return view('customer.user.role', compact('user'));
    }

    public function postRole(Request $request, User $user)
    {
        try {
            $role = $request->sltQuyen;
            $user->role = $role;
            $user->save();

            return redirect()->route('user.index')->with(['flash_level'=>'success','flash_message'=>'Cập nhật thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
        }
    }
}
