@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> TIÊU CHUẨN</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('tieuchuan.index')}}">Tiêu chuẩn</a></li>
                    <li><i class="fa fa-files-o"></i>Chi tiết</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Chi tiết tiêu chuẩn
                    </header>
                    <div class="panel-body">
                        <h4 style="color: black;"><strong>{!!$tieuchuan->ten_tieu_chuan!!}</strong></h4>
                        @if(isset($tieuchuan->mo_dau))
                            <h5><strong style="font-style: italic; color: black;">Mở đầu</strong></h5>
                            <p>{!!$tieuchuan->mo_dau!!}</p>
                        @endif
                        @if(isset($tieuchuan->ket_luan))
                            <h5><strong style="font-style: italic; color: black;">Kết luận</strong></h5>
                            <p>{!!$tieuchuan->ket_luan!!}</p>
                        @endif
                    </div>
                </section>
                <a href="{{route('tieuchuan.index')}}" class="btn btn-default"><i class="fa fa-angle-left"> Quay lại</i></a>
            </div>
        </div>
    </section>
@endsection
