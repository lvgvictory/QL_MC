<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            <li class="active">
                <a class="" href="{{route('admin')}}">
                <i class="icon_house_alt"></i>
                <span>Thống Kê</span>
                </a>
            </li>
            @if(Auth::check() && Auth::user()->role == 1)
                <li class="sub-menu active">
                    <a href="javascript:;" class="">
                    <i class="fa fa-ban"></i>
                    <span> QUẢN LÝ </span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="">
                    <i class="icon_document_alt"></i>
                    <span>Tiêu Chuẩn</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{route('tieuchuan.index')}}">Danh Sách</a></li>
                        <li><a class="" href="{{route('tieuchuan.create')}}">Thêm Mới</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="">
                    <i class="icon_genius"></i>
                    <span>Tiêu Chí</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{ route('tieuchi.index') }}">Danh Sách</a></li>
                        <li><a class="" href="{{ route('tieuchi.create') }}">Thêm Mới</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="">
                    <i class="fa fa-user"></i>
                    <span>Tài Khoản</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{route('user.index')}}"> Danh Sách</a></li>
                        <li><a class="" href="{{route('dangky')}}"> Tạo Tài Khoản</a></li>
                    </ul>
                </li>
                
                <li class="sub-menu active">
                    <a href="javascript:;" class="">
                    <i class="fa fa-ban"></i>
                    <span> NGƯỜI DÙNG </span>
                    </a>
                </li>
            @endif

            <li class="sub-menu">
                <a href="javascript:;" class="">
                <i class="icon_document_alt"></i>
                <span>Viết Tiêu Chuẩn</span>
                <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{route('tieuchuan-user.index')}}">Danh Sách</a></li>
                    <li><a class="" href="{{route('tieuchuan-user.create')}}">Viết Bài</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                <i class="icon_genius"></i>
                <span>Viết Tiêu Chí</span>
                <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{ route('tieuchi-user.index') }}">Danh Sách</a></li>
                    <li><a class="" href="{{ route('tieuchi-user.create') }}">Viết Bài</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                <i class="icon_desktop"></i>
                <span>Minh Chứng</span>
                <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{route('minhchung.index')}}">Danh Sách</a></li>
                    <li><a class="" href="{{route('minhchung.create')}}">Thêm Mới</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                <i class="fa fa-book"></i>
                <span>Văn Bản</span>
                <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{route('vanban.index')}}">Danh Sách</a></li>
                    <li><a class="" href="{{route('vanban.create')}}">Thêm Mới</a></li>
                </ul>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>