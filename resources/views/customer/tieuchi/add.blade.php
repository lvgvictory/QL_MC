@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> TIÊU CHÍ</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('tieuchi-user.index')}}">Tiêu chí</a></li>
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
                        VIẾT BÀI TIÊU CHÍ
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="form-horizontal" method="POST" action="{{route('tieuchi-user.store')}}" enctype='multipart/form-data'>
                                {{ csrf_field() }}

                                <div class="form-group ">
                                    <label for="sltTenTc" class="control-label col-lg-2">
                                        Tên tiêu chuẩn 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15" name="sltTenTc" id="sltTenTc">
                                            <option value=""> ---Chọn tiêu chuẩn--- </option>
                                            @if(isset($tieuchuans))
                                            @foreach($tieuchuans as $tieuchuan)
                                                <option value="{{$tieuchuan->id}}">
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
                                        <select class="form-control m-bot15" name="sltTenTieuChi" id="sltTenTieuChi">
                                            <option value=""> ---Chọn tiêu chí--- </option>
                                            @if(isset($tieuchis))
                                            @foreach($tieuchis as $tieuchi)
                                                <option value="{{$tieuchi->id}}">
                                                    {{$tieuchi->ten_tieu_chi}}
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
                                        <select class="form-control m-bot15" name="sltMinhChung" id="sltMinhChung">
                                            <option value=""> ---Chọn minh chứng--- </option>
                                            @if(isset($minhchungs))
                                            @foreach($minhchungs as $minhchung)
                                                <option value="{{$minhchung->ma_mc}}">
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
                                        <textarea id="textarea-1" class="form-control ckeditor" name="treaMoTa" rows="6">{{old('treaMoTa')}}</textarea>
                                        {{-- <script type="text/javascript">ckeditor("textarea-1")</script> --}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2">
                                        Điểm mạnh 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea id="textarea-2" class="form-control ckeditor" name="treaDiemManh" rows="6">{{old('treaDiemManh')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2">
                                        Những tồn tại 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea id="textarea-3" class="form-control ckeditor" name="treaTonTai" rows="6">{{old('treaTonTai')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2">
                                        Kế hoạch cải tiến 
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea id="textarea-4" class="form-control ckeditor" name="treaCaiTien" rows="6">{{old('treaCaiTien')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2" for="inputSuccess">Tự đánh giá</label>
                                    <div class="col-lg-10">
                                      <div class="radio">
                                        <label>
                                            <input type="radio" name="rdDG" value="1">
                                            Đạt
                                        </label>
                                      </div>
                                      <div class="radio">
                                        <label>
                                            <input type="radio" name="rdDG" value="0" checked>
                                            Không đạt
                                        </label>
                                      </div>

                                    </div>
                                </div>
                                
                                <div>
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

            $('#sltTenTc').change(function() {
                var id = $(this).val();
                
                $.ajax({
                    url: '/get-data',
                    type: 'GET',
                    data: {id: id},
                    success: function (res) {
                        // var result = "";
                        // for (var i = 0; i < res.length; i++) {
                        //     result += "<li><a href='/single/" + res[i].id + "'>" + res[i].name + "</a></li>";
                        // }
                        $('#sltTenTieuChi').html(res);
                    }
                });
            });

            $('#sltMinhChung').on('change', function(event) {
                CKEDITOR.instances['textarea-1'].insertHtml(event.target.value);
            });
        });
        
    </script>
@endsection