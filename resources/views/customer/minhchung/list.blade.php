@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> MINH CHỨNG</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('minhchung.index')}}">Minh chứng</a></li>
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
            <div class="col-lg-12 float-right mb-2" style="margin-bottom: 5px;">
                <a href="{{route('download-minhchung')}}" class="btn btn-info"><i class="fa fa-download"></i></a>
            </div>
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        DANH SÁCH MINH CHỨNG
                    </header>
                    <div class="panel-body">
                        <table id="minh-chung-table" class="display">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã minh chứng</th>
                                    <th>Tên minh chứng</th>
                                    <th>Tên tiêu chuẩn</th>
                                    <th>Tên tiêu chí</th>
                                    <th>Xem</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($minhchungs))
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach($minhchungs as $minhchung)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$minhchung->ma_mc}}</td>
                                            <td>{{$minhchung->ten_minh_chung}}</td>
                                            <td>{{$minhchung->tieuchi->tieuchuan->ten_tieu_chuan}}</td>
                                            <td>{{$minhchung->tieuchi->ten_tieu_chi}}</td>
                                            <td>
                                                <a href="{{route('minhchung.show', $minhchung->id)}}">Chi tiết</a>
                                            </td>
                                            <td>
                                                <div>
                                                    <a style="float: left; margin-right: 3px;" href="{{route('minhchung.edit', $minhchung->id)}}" class="btn btn-warning">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <form method="POST" action="{{route('minhchung.destroy', $minhchung->id)}}">
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
            $('#minh-chung-table').DataTable();
            $("div.alert").delay(3000).slideUp();
        });
    </script>
@endsection
