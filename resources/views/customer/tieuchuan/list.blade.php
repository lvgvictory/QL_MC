@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> TIÊU CHUẨN</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('tieuchuan-user.index')}}">Tiêu Chuẩn</a></li>
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
                        DANH SÁCH TIÊU CHUẨN
                    </header>
                    <div class="panel-body">
                        <table id="tieu-chuan-table" class="display">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên tiêu chuẩn</th>
                                    <th>Mở đầu</th>
                                    <th>Kết luận</th>
                                    <th>Xem</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($tieuchuans))
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($tieuchuans as $tieuchuan)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$tieuchuan->ten_tieu_chuan}}</td>
                                            <td>{!!$tieuchuan->mo_dau!!}</td>
                                            <td>{!!$tieuchuan->ket_luan!!}</td>
                                            <td>
                                                <a href="{{route('tieuchuan-user.show', $tieuchuan->id)}}">Chi tiết</a>
                                            </td>
                                            <td>
                                                
                                                <div>
                                                    <a style="float: left; margin-right: 10px;" href="{{route('tieuchuan-user.edit', $tieuchuan->id)}}" class="btn btn-warning">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    @if(Auth::user()->role == 1)
                                                        <form method="POST" action="{{route('tieuchuan-user.destroy', $tieuchuan->id)}}">
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
            $('#tieu-chuan-table').DataTable();
            $("div.alert").delay(3000).slideUp();
        });
    </script>
@endsection