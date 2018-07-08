@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> TIÊU CHÍ</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('tieuchuan.index')}}">Thống Kê</a></li>
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
                        <table id="tieu-chius-table" class="display">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên tiêu chí</th>
                                    <th>Tên tiêu chuẩn</th>
                                    <th>Tự đánh giá</th>
                                    {{-- <th>Trạng thái</th> --}}
                                    <th>Xem</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($tieuchis))
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach($tieuchis as $tieuchi)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$tieuchi->ten_tieu_chi}}</td>
                                            <td>{{$tieuchi->tieuchuan->ten_tieu_chuan}}</td>
                                            <td>
                                                {!!
                                                    $tieuchi->tu_danh_gia == 1 
                                                    ? 'Đạt' 
                                                    : 'Không đạt'
                                                !!}
                                                </td>
                                            {{-- <td>
                                                {!!
                                                    $tieuchi->status == 1 
                                                    ? '<span class="label label-success">Hiện</span>' 
                                                    : '<span class="label label-warning">Ẩn</span>'
                                                !!}
                                            </td> --}}
                                            <td>
                                                <a href="{{route('tieuchi-user.show', $tieuchi->id)}}">Chi tiết</a>
                                            </td>
                                            <td>
                                                <div>
                                                    <a style="float: left; margin-right: 3px;" href="{{route('tieuchi-user.edit', $tieuchi->id)}}" class="btn btn-warning">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    @if(Auth::user()->role == 1)
                                                        <form method="POST" action="{{route('tieuchi-user.destroy', $tieuchi->id)}}">
                                                            {{ method_field("DELETE")}}
                                                            {{ csrf_field() }}
                                                            <button onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                        </form>
                                                    @endif
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
            $('#tieu-chius-table').DataTable();
            $("div.alert").delay(3000).slideUp();
        });
    </script>
@endsection
