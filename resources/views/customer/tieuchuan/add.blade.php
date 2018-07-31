@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> TIÊU CHUẨN</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('tieuchuan-user.index')}}">Tiêu chuẩn</a></li>
                    <li><i class="fa fa-files-o"></i>Viết Bài</li>
                </ol>
            </div>
        </div>
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
            </div>
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        VIẾT BÀI TIÊU CHUẨN
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="form-horizontal" method="POST" action="{{route('tieuchuan-user.store')}}" enctype='multipart/form-data'>
                                {{ csrf_field() }}

                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">
                                        Tên tiêu chuẩn 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15" name="sltTenTc">
                                            <option value=""> ---Chọn tiêu chuẩn--- </option>
                                            @foreach($tieuchuans as $tieuchuan)
                                                <option value="{{$tieuchuan->id}}">
                                                    {{$tieuchuan->ten_tieu_chuan}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2">
                                        Mở đầu 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea id="textarea-1" class="form-control ckeditor" name="treaMoDau" rows="6">{{old('treaMoDau')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2">
                                        Kết luận 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea id="textarea-2" class="form-control ckeditor" name="treaKetLuan" rows="6">{{old('treaKetLuan')}}</textarea>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="submit" value="Lưu" class=" btn btn-primary">
                                        <button class="btn btn-default" type="button">Cancel</button>
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
    <script>
        $(document).ready(function() {
            $("div.alert").delay(10000).slideUp();
        });
    </script>
@endsection