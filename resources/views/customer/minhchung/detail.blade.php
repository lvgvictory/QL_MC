@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> MINH CHỨNG</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('minhchung.index')}}">Minh chứng</a></li>
                    <li><i class="fa fa-files-o"></i>Chi tiết</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Chi tiết minh chứng
                    </header>
                    <div class="panel-body">

                        <h3 style="color: black;"><strong>{!!$minhchung->tieuchi->tieuchuan->ten_tieu_chuan!!}</strong></h3>
                        <h4 style="color: black;"><strong>{!!$minhchung->tieuchi->ten_tieu_chi!!}</strong></h4>
                        @if(isset($minhchung->ma_mc))
                            <h5><strong style="font-style: italic; color: black;">Mã minh chứng</strong></h5>
                            <p>{!!$minhchung->ma_mc!!}</p>
                        @endif
                        @if(isset($minhchung->ten_minh_chung))
                            <h5><strong style="font-style: italic; color: black;">Tên minh chứng</strong></h5>
                            <p>{!!$minhchung->ten_minh_chung!!}</p>
                        @endif
                    </div>
                </section>
                <a href="{{route('minhchung.index')}}" class="btn btn-default"><i class="fa fa-angle-left"> Quay lại</i></a>
            </div>
        </div>
    </section>
@endsection
