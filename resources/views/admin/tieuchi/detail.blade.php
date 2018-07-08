@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> TIÊU CHÍ</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('tieuchi.index')}}">Tiêu chí</a></li>
                    <li><i class="fa fa-files-o"></i>Chi tiết</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Chi tiết tiêu chí
                    </header>
                    <div class="panel-body">

                        <h3 style="color: black;"><strong>{!!$tieuchi->tieuchuan->ten_tieu_chuan!!}</strong></h3>
                        <h4 style="color: black;"><strong>{!!$tieuchi->ten_tieu_chi!!}</strong></h4>
                        @if(isset($tieuchi->mo_ta))
                            <h5><strong style="font-style: italic; color: black;">Mô tả</strong></h5>
                            <p>{!!$tieuchi->mo_ta!!}</p>
                        @endif
                        @if(isset($tieuchi->diem_manh))
                            <h5><strong style="font-style: italic; color: black;">Điểm mạnh</strong></h5>
                            <p>{!!$tieuchi->diem_manh!!}</p>
                        @endif
                        @if(isset($tieuchi->nhung_ton_tai))
                            <h5><strong style="font-style: italic; color: black;">Những tồn tại</strong></h5>
                            <p>{!!$tieuchi->nhung_ton_tai!!}</p>
                        @endif
                        @if(isset($tieuchi->ke_hoach_cai_tien))
                            <h5><strong style="font-style: italic; color: black;">Kế hoạch cải tiến</strong></h5>
                            <p>{!!$tieuchi->ke_hoach_cai_tien!!}</p>
                        @endif
                        <h5>
                            <strong style="font-style: italic; color: black;">Tự đánh giá : </strong> 
                            {!!$tieuchi->tu_danh_gia == 1 ? '<i>Đạt</i>' : '<i>Không đạt</i>'!!}
                        </h5>
                    </div>
                </section>
                <a href="{{route('tieuchi.index')}}" class="btn btn-default"><i class="fa fa-angle-left"> Quay lại</i></a>
            </div>
        </div>
    </section>
@endsection
