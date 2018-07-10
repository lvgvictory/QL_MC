@extends('layouts.master')
@section('content')
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-files-o"></i> TÀI KHOẢN</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{route('user.index')}}">Tài khoản</a></li>
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
                        DANH SÁCH TÀI KHOẢN
                    </header>
                    <div class="panel-body">
                        <table id="minh-chung-table" class="display">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    {{-- <th>Trạng thái</th> --}}
                                    <th>Quyền</th>
                                    <th>Xem</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($users))
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->address}}</td>
                                            <td>{{$user->phone}}</td>
                                           {{--  <td>
                                                {!!$user->status === 1 
                                                    ? '<span class="label label-success">Kích hoạt</span>' 
                                                    : '<span class="label label-danger">Ẩn</span>'!!}
                                            </td> --}}
                                            <td>
                                                @if (Auth::user()->email == 'lvgvictory@gmail.com')
                                                    <a href="{{route('user-role', $user->id)}}">
                                                        {{$user->role === 1 ? 'Quản lý' : 'Người dùng'}}
                                                    </a>
                                                @else
                                                    @if($user->role === 1)
                                                        Quản lý
                                                    @else
                                                        @if(Auth::user()->role === 1)
                                                            <a href="{{route('user-role', $user->id)}}">
                                                                Người dùng
                                                            </a>
                                                        @else
                                                            Người dùng
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('user.show', $user->id)}}">Chi tiết</a>
                                            </td>
                                             <td>
                                                <div>
                                                    @if (Auth::user()->id != $user->id && $user->role != 1)
                                                    <form method="POST" action="{{route('user.delete', $user->id)}}">
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