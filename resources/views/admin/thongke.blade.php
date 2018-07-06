@extends('layouts.master')
@section('content')
    
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
                @if(Auth::user()->role == 1)
                    <h3 class="page-header"><i class="fa fa-laptop"></i> THỐNG KÊ</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="{{route('admin')}}">Thống kê</a></li>
                    </ol>
                @else
                    <h3 class="page-header" style="text-align: center; font-weight: bold;">CHÀO MỪNG BẠN ĐẾN HỆ THỐNG QUẢN LÝ MINH CHỨNG HỖ TRỢ CÔNG TÁC ĐÁNH GIÁ TRƯỜNG ĐẠI HỌC</h3>
                @endif
            </div>
        </div>

       @if(Auth::user()->role == 1)
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box blue-bg">
                        <i class="fa fa-user"></i>
                        <div class="count">{{$countUser->count()}}</div>
                        <div class="title">TÀI KHOẢN</div>
                    </div>
                <!--/.info-box-->
                </div>
                <!--/.col-->

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box brown-bg">
                        <i class="icon_document_alt"></i>
                        <div class="count">{{$countTieuChuan->count()}}</div>
                        <div class="title">TIÊU CHUẨN</div>
                    </div>
                <!--/.info-box-->
                </div>
                <!--/.col-->

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box dark-bg">
                        <i class="icon_genius"></i>
                        <div class="count">{{$countTieuChi->count()}}</div>
                        <div class="title">TIÊU CHÍ</div>
                    </div>
                <!--/.info-box-->
                </div>
                <!--/.col-->

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box green-bg">
                        <i class="icon_desktop"></i>
                        <div class="count">{{$countMinhChung->count()}}</div>
                        <div class="title">MINH CHỨNG</div>
                    </div>
                <!--/.info-box-->
                </div>
                <!--/.col-->

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box green-bg">
                        <i class="fa fa-book"></i>
                        <div class="count">{{$countVanBan->count()}}</div>
                        <div class="title">VĂN BẢN</div>
                    </div>
                <!--/.info-box-->
                </div>
                 <!--/.col-->

            </div>
       @endif
        <!--/.row-->

        <!-- project team & activity end -->

    </section>
        {{-- <div class="text-right">
            <div class="credits">
                <a href="https://bootstrapmade.com/">Free Bootstrap Templates</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div> --}}
    
@endsection
