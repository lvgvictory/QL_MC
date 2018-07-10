<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

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

            return redirect()->route('admin')->with(['flash_level'=>'success','flash_message'=>'Cập nhật tài khoản thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
            // return redirect()->back()->with('message', trans('admin.product.error_delete'));
        }
    }

    public function getIndex()
    {
        $users = User::orderBy('id','DESC')->get();

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


    public function getDangKy()
    {
        return view('customer.user.dangky');
    }

    public function postDangKy(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|string|min:2|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required'
            ],
            [
                'name.required' => 'Vui lòng nhập họ và tên',
                'name.string' => 'Trường họ và tên nhập phải là chữ',
                'name.min' => 'Họ và tên phải có độ dài ít nhất là 2 ký tự',
                'name.max' => 'Họ và tên không được vượt quá 255 ký tự',
                'email.required' => 'Vui lòng nhập Email-Address',
                'email.string' => 'Trường Email-Address nhập phải là chữ',
                'email.email' => 'Email-Address không đúng định dạng',
                'email.max' => 'Trường Email-Address không được vượt quá 255 ký tự',
                'email.unique' => 'Email-Address đã tồn tại',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Họ tên phải có độ dài ít nhất là 6 ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp',
                'password_confirmation.required' => 'Vui lòng nhập xác nhận mật khẩu'
            ]
        );

        try {
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);

            $user->save();

            return redirect()->route('user.index')->with(['flash_level'=>'success','flash_message'=>'Tạo tài khoản thành công']);
        } catch (Exception $ex) {
            Log::useDailyFiles(config('app.file_log'));
            Log::error($ex->getMessage());
        }
    }

    public function getChangePassword()
    {
        return view('customer.user.changepassword');
    }

    public function postChangePassword(Request $request)
    {
        $this->validate($request,
            [
                'password_old' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required'
            ],
            [
                'password_old.required' => 'Vui lòng nhập họ và tên',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Họ tên phải có độ dài ít nhất là 6 ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp',
                'password_confirmation.required' => 'Vui lòng nhập xác nhận mật khẩu'
            ]
        );

        $user = Auth::user();

        if (Hash::check($request->input('password_old'), $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->route('admin')->with(['flash_level'=>'success','flash_message'=>'Cập nhật mật khẩu thành công']);
        }
        else {
            return redirect()->route('change-password')->with(['flash_level'=>'danger','flash_message'=>'Bạn cần phải nhập đúng mật khẩu']);
        }
    }
}
