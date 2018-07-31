@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> MINH CHỨNG</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('minhchung.index')}}">Minh chứng</a></li>
                    <li><i class="fa fa-files-o"></i>Cập Nhât</li>
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
                        CẬP NHẬT MINH CHỨNG
                    </header>
                    <div class="panel-body">
                        <div class="form my-ajax">
                            <form 
                                class="form-horizontal" 
                                method="POST" 
                                action="{{route('minhchung.update', $minhchung->id)}}" 
                                enctype='multipart/form-data'
                            >
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group ">
                                    <label for="sltTenTc" class="control-label col-lg-2">
                                        Tên tiêu chuẩn 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15" name="sltTenTc" id="sltTenTc" required>
                                            <option value=""> ---Chọn tiêu chuẩn--- </option>
                                            @if(isset($tieuchuans))
                                                @foreach($tieuchuans as $tieuchuan)
                                                    <option 
                                                        value="{{$tieuchuan->id}}" 
                                                        {{$tieuchuan->id == $minhchung->tieuchi->tieuchuan_id ? 'selected' : ''}}
                                                    >
                                                        {{$tieuchuan->ten_tieu_chuan}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="sltTenTieuChi" class="control-label col-lg-2">
                                        Tên tiêu chí 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15" name="sltTenTieuChi" id="sltTenTieuChi" required>
                                            <option value=""> ---Chọn tiêu chí--- </option>
                                            @if(isset($tieuchis))
                                                @foreach($tieuchis as $tieuchi)
                                                    <option 
                                                        value="{{$tieuchi->id}}"
                                                        {{$tieuchi->id == $minhchung->tieuchi_id ? 'selected' : ''}}
                                                    >
                                                        {{$tieuchi->ten_tieu_chi}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="txtTenMC" class="control-label col-lg-2">
                                        Tên minh chứng 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input 
                                            class="form-control" 
                                            id="txtTenMC" 
                                            name="txtTenMC" 
                                            minlength="5" 
                                            type="text" 
                                            value="{{old('txtTenMC', isset($minhchung) ? $minhchung->ten_minh_chung : '')}}" 
                                            required="" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="txtMaMC" class="control-label col-lg-2">
                                        Mã minh chứng 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="cname" name="txtMaMC" minlength="5" type="text" value="{{$minhchung->ma_mc}}" readonly="" />
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
            $("div.alert").delay(5000).slideUp();

            function getTieuChi() {
                var id = $('#sltTenTc').val();
                $.ajax({
                    url: '/ajax-tieuchi',
                    type: 'GET',
                    data: {id: id},
                    success: function (res) {
                        $('#sltTenTieuChi').html(res);
                    }
                });
            }

            // getTieuChi();

            $('#sltTenTc').change(function() {
                getTieuChi();
            });
        });
    </script>
@endsection