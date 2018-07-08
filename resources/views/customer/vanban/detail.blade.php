@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> VĂN BẢN</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('vanban.index')}}">Văn bản</a></li>
                    <li><i class="fa fa-files-o"></i>Chi tiết</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Chi tiết văn bản
                    </header>
                    <div class="panel-body">

                        <h4><strong style="font-style: italic; color: black;">Tên minh chứng</strong></h4>
                            <p>{!!$vanban->minhchung->ten_minh_chung!!}</p>
                        @if(isset($vanban->ten_van_ban))
                            <h5><strong style="font-style: italic; color: black;">Tên văn bản</strong></h5>
                            <p>{!!$vanban->ten_van_ban!!}</p>
                        @endif
                        @if(isset($vanban->so_van_ban))
                            <h5><strong style="font-style: italic; color: black;">Số văn bản</strong></h5>
                            <p>{!!$vanban->so_van_ban!!}</p>
                        @endif
                        @if(isset($vanban->noi_ban_hanh))
                            <h5><strong style="font-style: italic; color: black;">Nơi ban hành</strong></h5>
                            <p>{!!$vanban->noi_ban_hanh!!}</p>
                        @endif
                        @if(isset($vanban->ngay_thang_nam))
                            <h5><strong style="font-style: italic; color: black;">Ngày ban hành</strong></h5>
                            <p>{!!$vanban->ngay_thang_nam!!}</p>
                        @endif
                    </div>
                </section>
                <a href="{{route('vanban.index')}}" class="btn btn-default"><i class="fa fa-angle-left"> Quay lại</i></a>
            </div>
        </div>
    </section>
@endsection
