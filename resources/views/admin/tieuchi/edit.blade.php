@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> TIÊU CHÍ</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('tieuchi.index')}}">Tiêu chí</a></li>
                    <li><i class="fa fa-files-o"></i>Thêm Mới</li>
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
                        THÊM TIÊU CHÍ
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="form-horizontal" method="POST" action="{{route('tieuchi.update', $tieuchi->id)}}" enctype='multipart/form-data'>
                                {{ method_field('PUT') }}
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
                                                <option 
                                                    value="{{$tieuchuan->id}}" 
                                                    {{$tieuchi->tieuchuan_id == $tieuchuan->id ? 'selected' : ''}}
                                                >
                                                    {{$tieuchuan->ten_tieu_chuan}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">
                                        Tên tiêu chí 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="cname" name="txtTenTc" minlength="5" type="text" value="{{old('txtTenTc', $tieuchi->ten_tieu_chi ? $tieuchi->ten_tieu_chi : '')}}" required="" />
                                    </div>
                                </div>
                                <div class="form-group ">
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
    <script>
        $(document).ready(function() {
            $("div.alert").delay(10000).slideUp();
        });
    </script>
@endsection