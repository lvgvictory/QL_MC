@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
             @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{!!$error!!}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        CẬP NHẬT HỒ SƠ
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="form-horizontal" method="POST" action="{{route('profile.store')}}" enctype='multipart/form-data'>
                                {{ csrf_field() }}
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">
                                        Họ và tên 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="cname" name="txtName" minlength="5" type="text" value="{{Auth::user()->name}}" required />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="Email-Address" class="control-label col-lg-2">
                                        Email-Address
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="Email-Address" name="txtEmail" minlength="5" type="email" value="{{Auth::user()->email}}" required readonly="" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="address" class="control-label col-lg-2">
                                        Địa chỉ 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="address" name="txtAddress" minlength="5" type="text" value="{{Auth::user()->address}}" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="control-label col-lg-2">
                                        Số điện thoại  
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="phone" name="txtPhone" minlength="5" type="number" value="{{Auth::user()->phone}}" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="submit" value="Lưu" class=" btn btn-primary">
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
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("div.alert").delay(5000).slideUp();
        });        
    </script>
@endsection