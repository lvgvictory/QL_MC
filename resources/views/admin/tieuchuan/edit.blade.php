@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> TIÊU CHUẨN</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="index.html">Tiêu chuẩn</a></li>
                    <li><i class="fa fa-files-o"></i>Cập Nhật</li>
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
                        SỬA TIÊU CHUẨN
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="form-horizontal" method="POST" action="{{route('tieuchuan.update', $tieuchuan->id)}}" enctype='multipart/form-data'>
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">
                                        Tên tiêu chuẩn 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input 
                                            class="form-control" 
                                            id="cname" 
                                            name="txtTenTc" 
                                            minlength="5" 
                                            type="text" 
                                            value="{{old('txtTenTc', isset($tieuchuan) ? $tieuchuan->ten_tieu_chuan : '')}}" 
                                            required />
                                    </div>
                                </div>
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