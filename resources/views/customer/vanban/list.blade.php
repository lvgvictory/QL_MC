@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> VĂN BẢN</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('vanban.index')}}">Văn bản</a></li>
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
                        DANH SÁCH VĂN BẢN
                    </header>
                    <div class="panel-body">
                        <table id="minh-chung-table" class="display">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên văn bản</th>
                                    <th>Số văn bản</th>
                                    {{-- <th>Nơi ban hành</th> --}}
                                    {{-- <th>Ngày ban hành</th> --}}
                                    <th>Tên minh chứng</th>
                                    <th>File đính kèm</th>
                                    <th>Xem</th>
                                    @if(Auth::user()->role === 1)
                                    <th>Hành động</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($vanbans))
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach($vanbans as $vanban)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$vanban->ten_van_ban}}</td>
                                            <td>{{$vanban->so_van_ban}}</td>
                                            {{-- <td>{{$vanban->noi_ban_hanh}}</td> --}}
                                            {{-- <td>{{$vanban->ngay_thang_nam}}</td> --}}
                                            <td>{{$vanban->minhchung->ten_minh_chung}}</td>
                                            <td>
                                                <a href="{{route('download', $vanban->file)}}">
                                                    {{$vanban->file}}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('vanban.show', $vanban->id)}}">Chi tiết</a>
                                            </td>
                                             <td>
                                                <div>
                                                    @if(Auth::user()->role === 1)
                                                    <a style="float: left; margin-right: 3px;" href="{{route('vanban.edit', $vanban->id)}}" class="btn btn-warning">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <form method="POST" action="{{route('vanban.destroy', $vanban->id)}}">
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
            $('#minh-chung-table').DataTable();
            $("div.alert").delay(3000).slideUp();
        });
    </script>
@endsection