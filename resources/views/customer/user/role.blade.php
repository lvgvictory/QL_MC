@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        CẬP NHẬT QUYỀN NGƯỜI DÙNG
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="form-horizontal" method="POST" action="{{route('user-role', $user->id)}}" enctype='multipart/form-data'>
                                {{ csrf_field() }}
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">
                                        Họ và tên 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="cname" name="txtName" minlength="5" type="text" value="{{$user->name}}" required readonly="" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="Email-Address" class="control-label col-lg-2">
                                        Email-Address
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="Email-Address" name="txtEmail" minlength="5" type="email" value="{{$user->email}}" required readonly="" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="address" class="control-label col-lg-2">
                                        Địa chỉ 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="address" name="txtAddress" minlength="5" type="text" value="{{$user->address}}" required readonly=""/>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="phone" class="control-label col-lg-2">
                                        Số điện thoại  
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="phone" name="txtPhone" minlength="5" type="number" value="{{$user->phone}}" required readonly=""/>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="phone" class="control-label col-lg-2">
                                        Quyền  
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15" name="sltQuyen" {{Auth::user()->id === $user->id ? 'readonly' : ''}}>
                                            <option value="0" {{$user->role == 0 ? 'selected' : ''}}>
                                                Người dùng
                                            </option>
                                            <option value="1" {{$user->role == 1 ? 'selected' : ''}}>
                                                Quản lý
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @if(Auth::user()->id !== $user->id)
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <input type="submit" value="Lưu" class=" btn btn-primary">&nbsp;
                                            <a href="{{route('user.index')}}" class=" btn btn-default">
                                                <i class="fa fa-angle-left"></i> Quay lại
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <a href="{{route('user.index')}}" class=" btn btn-default">
                                                <i class="fa fa-angle-left"></i> Quay lại
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection