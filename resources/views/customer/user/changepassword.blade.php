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
                @endif
                @if(Session::has('flash_message'))
                    <div class="alert alert-{!!Session::get('flash_level')!!}">
                        {!!Session::get('flash_message')!!}
                    </div>
                @endif
            </div>

            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        THAY ĐỔI MẬT KHẨU
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="form-horizontal" method="POST" action="{{route('change-password')}}" enctype='multipart/form-data'>
                                {{ csrf_field() }}

                                <div class="form-group ">
                                    <label for="password_old" class="control-label col-lg-3">
                                        Mật khẩu
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input class="form-control" id="password_old" name="password_old" minlength="5" type="password" required/>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="password" class="control-label col-lg-3">
                                        Mật khẩu mới
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input class="form-control" id="password" name="password" minlength="5" type="password" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation" class="control-label col-lg-3">
                                        Xác nhận mật khẩu mới
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input class="form-control" id="repassword" name="password_confirmation" minlength="5" type="password" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-10">
                                        <input type="submit" value="Cập nhật" class=" btn btn-primary">
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
            $("div.alert").delay(10000).slideUp();
        });
    </script>
@endsection