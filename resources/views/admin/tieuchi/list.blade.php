@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> TIÊU CHÍ</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('tieuchi.index')}}">Tiêu chí</a></li>
                    <li><i class="fa fa-files-o"></i>Danh Sách</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if(Session::has('flash_message'))
                    <div class="alert alert-{!!Session::get('flash_level')!!}">
                        {!!Session::get('flash_message')!!}
                    </div>
                @endif                
            </div>
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        DANH SÁCH TIÊU CHÍ
                    </header>
                    <div class="panel-body">
                        <table id="tieu-chuan-table" class="display">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên tiêu chí</th>
                                    <th>Tên tiêu chuẩn</th>
                                    <th>Xem</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($tieuchis))
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($tieuchis as $tieuchi)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td class="an-chu">{{$tieuchi->ten_tieu_chi}}</td>
                                            <td>{{$tieuchi->tieuchuan->ten_tieu_chuan}}</td>
                                            <td>
                                                <a href="{{route('tieuchi.show', $tieuchi->id)}}">Chi tiết</a>
                                            </td>
                                            <td>
                                                <div>
                                                    <a style="float: left; margin-right: 10px;" href="{{route('tieuchi.edit', $tieuchi->id)}}" class="btn btn-warning">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <form method="POST" action="{{route('tieuchi.destroy', $tieuchi->id)}}">
                                                        {{ method_field("DELETE")}}
                                                        {{ csrf_field() }}
                                                        <button onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#tieu-chuan-table').DataTable();
            $("div.alert").delay(3000).slideUp();
        });

        // $(function(){
        //     $.fn.limit = function($n){
        //         this.each(function(){
        //             var allText   = $(this).html();
        //             var tLength   = $(this).html().length;
        //             var startText = allText.slice(0,$n);
        //             if(tLength >= $n){
        //                 $(this).html(startText+'...');
        //             }else {
        //                 $(this).html(startText);
        //             };
        //         });
                
        //         return this;
        //     }
        //     $('.an-chu').limit(80);
        // });
    </script>
@endsection