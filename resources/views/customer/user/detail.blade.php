@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        THÔNG TIN NGƯỜI DÙNG
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="form-horizontal">
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

                                {{-- <div class="form-group ">
                                    <label for="phone" class="control-label col-lg-2">
                                        Trạng Thái  
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input 
                                            class="form-control" 
                                            id="phone" 
                                            name="txtPhone" 
                                            minlength="5" 
                                            type="text" 
                                            value="{{$user->status === 1 ? 'Kích hoạt' : 'Ẩn'}}" required readonly="" />
                                    </div>
                                </div> --}}

                                <div class="form-group ">
                                    <label for="phone" class="control-label col-lg-2">
                                        Quyền  
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input 
                                            class="form-control" 
                                            id="phone" 
                                            name="txtPhone" 
                                            minlength="5" 
                                            type="text" 
                                            value="{{$user->role === 1 ? 'Quản lý' : 'Người dùng'}}" required readonly="" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection