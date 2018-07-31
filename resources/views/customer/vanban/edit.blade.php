@php
use Carbon\Carbon;
    $date = '';
    if (isset($vanban)) {
         $date = Carbon::parse($vanban->ngay_thang_nam)->format('Y/m/d');
    } 
@endphp
@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> VĂN BẢN</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('vanban.index')}}">Văn bản</a></li>
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
                        CẬP NHẬT VĂN BẢN
                    </header>
                    <div class="panel-body">
                        <div class="form my-ajax">
                            <form class="form-horizontal" method="POST" action="{{route('vanban.update', $vanban->id)}}" enctype='multipart/form-data'>
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group ">
                                    <label for="sltTenMC" class="control-label col-lg-2">
                                        Tên minh chứng 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15" name="sltTenMC" id="sltTenMC" required>
                                            <option value=""> ---Chọn minh chứng--- </option>
                                            @if(isset($minhchungs))
                                                @foreach($minhchungs as $minhchung)
                                                    <option 
                                                        value="{{$minhchung->id}}" 
                                                        {{$minhchung->id == $vanban->minhchung_id ? 'selected' : ''}}
                                                    >
                                                        {{$minhchung->ten_minh_chung}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="txtSoVB" class="control-label col-lg-2">
                                        Số văn bản
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input 
                                            class="form-control" 
                                            id="txtSoVB" 
                                            name="txtSoVB" 
                                            minlength="5" 
                                            type="text" 
                                            value="{{old('txtSoVB', isset($vanban) ? $vanban->so_van_ban : '')}}" 
                                            required />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="txtTenVB" class="control-label col-lg-2">
                                        Tên văn bản 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input 
                                            class="form-control" 
                                            id="txtTenVB" 
                                            name="txtTenVB" 
                                            minlength="5" 
                                            type="text" 
                                            value="{{old('txtTenVB', isset($vanban) ? $vanban->ten_van_ban : '')}}" 
                                            required />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="txtNoiBH" class="control-label col-lg-2">
                                        Nơi ban hành  
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input 
                                            class="form-control" 
                                            id="txtNoiBH" 
                                            name="txtNoiBH" 
                                            minlength="5" 
                                            type="text" 
                                            value="{{old('txtNoiBH', isset($vanban) ? $vanban->noi_ban_hanh : '')}}" 
                                            required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtNgayBH" class="control-label col-lg-2">Ngày ban hành</label>
                                    <div class="col-sm-2">
                                        <input 
                                            id="txtNgayBH" 
                                            type="text" 
                                            placeholder="yyyy/mm/dd" 
                                            size="16" name="txtNgayBH" 
                                            class="form-control datepicker" 
                                            value="{{old('txtNgayBH', isset($vanban) ? $date : '')}}" autocomplete="off"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile" class="control-label col-lg-2">
                                        File đính kèm
                                    </label>
                                    <div class="col-sm-10">
                                        <input 
                                            type="file" 
                                            id="exampleInputFile" 
                                            name="flDKnew" 
                                            value="{{old('flDKnew')}}">
                                    </div>
                                    <div class="col-sm-10">
                                        <input 
                                            type="hidden" 
                                            id="exampleInputFile" 
                                            name="flDKold" 
                                            value="{{$vanban->file}}">
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
    <script type="text/javascript">
        $(document).ready(function () {
            $(function(){
               $('.datepicker').datepicker({
                    format: 'yyyy/mm/dd'
                });
            });
            $("div.alert").delay(5000).slideUp();
        });        
    </script>
@endsection
