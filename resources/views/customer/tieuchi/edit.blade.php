@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> TIÊU CHÍ</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="index.html">Thống kê</a></li>
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
                        CẬP NHẬT TIÊU CHÍ
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="form-horizontal" method="POST" action="{{route('tieuchi-user.update', $tieuchi->id)}}" enctype='multipart/form-data'>
                                {{ csrf_field() }}
                                {{ method_field("PUT")}}

                                <div class="form-group ">
                                    <label for="sltTenTc" class="control-label col-lg-2">
                                        Tên tiêu chuẩn 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15" name="sltTenTc" id="sltTenTc" disabled="">
                                            <option value=""> ---Chọn tiêu chuẩn--- </option>
                                            @if(isset($tieuchuans))
                                            @foreach($tieuchuans as $tieuchuan)
                                                <option 
                                                    value="{{$tieuchuan->id}}" 
                                                    {{$tieuchuan->id == $tieuchi->tieuchuan_id ? 'selected' : ''}}
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
                                        <select class="form-control m-bot15" name="sltTenTieuChi" id="sltTenTieuChi" disabled="">
                                            <option value=""> ---Chọn tiêu chí--- </option>
                                            @if(isset($tieuchis))
                                            @foreach($tieuchis as $item)
                                                <option value="{{$item->id}}">
                                                    {{$item->ten_tieu_chi}}
                                                </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="sltMinhChung" class="control-label col-lg-2">
                                        Minh chứng 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15" name="sltMinhChung">
                                            <option value=""> ---Chọn minh chứng--- </option>
                                            @if(isset($minhchungs))
                                            @foreach($minhchungs as $minhchung)
                                                <option value="{{$minhchung->id}}">
                                                    {{$minhchung->ten_minh_chung}}
                                                </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2">
                                        Mô tả 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea 
                                            id="textarea-1" 
                                            class="form-control ckeditor" 
                                            name="treaMoTa" 
                                            rows="6">
                                            {{old('treaMoTa', isset($tieuchi) ? $tieuchi->mo_ta : '')}}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2">
                                        Điểm mạnh 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea id="textarea-2" class="form-control ckeditor" name="treaDiemManh" rows="6">
                                            {{old('treaDiemManh', isset($tieuchi) ? $tieuchi->diem_manh : '')}}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2">
                                        Những tồn tại 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea id="textarea-3" class="form-control ckeditor" name="treaTonTai" rows="6">
                                            {{old('treaTonTai', isset($tieuchi) ? $tieuchi->nhung_ton_tai : '')}}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2">
                                        Kế hoạch cải tiến 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea id="textarea-4" class="form-control ckeditor" name="treaCaiTien" rows="6">{{old('treaCaiTien', isset($tieuchi) ? $tieuchi->ke_hoach_cai_tien : '')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2" for="inputSuccess">Tự đánh giá</label>
                                    <div class="col-lg-10">
                                      <div class="radio">
                                        <label>
                                            <input 
                                                type="radio" 
                                                name="rdDG" 
                                                value="1" 
                                                {{$tieuchi->tu_danh_gia == 1 ? 'checked' : ''}} />
                                            Đạt
                                        </label>
                                      </div>
                                      <div class="radio">
                                        <label>
                                            <input 
                                                type="radio" 
                                                name="rdDG" 
                                                value="0" 
                                                {{$tieuchi->tu_danh_gia == 0 ? 'checked' : ''}} />
                                            Không đạt
                                        </label>
                                      </div>

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
            $("div.alert").delay(3000).slideUp();

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

            getTieuChi();

            $('#sltTenTc').change(function() {
                getTieuChi();
            });
        });
    </script>
@endsection