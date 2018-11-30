<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Administrator</li>
            <li class="role"><a href="{{route('admin.role.index')}}"><i class="fa fa-gg-circle"></i> <span>Role</span></a></li>
            <li class="permission"><a href="{{route('admin.permission.index')}}"><i class="fa fa-lock"></i> <span>Permission</span></a></li>
            <li class="user"><a href="{{route('admin.user.index')}}"><i class="fa fa-users"></i> <span>User</span></a></li>
            <li class="area"><a href="{{route('admin.area.index')}}"><i class="fa fa-users"></i> <span>Khu vực</span></a></li>
            <li class="provincial"><a href="{{route('admin.province.index')}}"><i class="fa fa-users"></i> <span>Tỉnh</span></a></li>
            <li class="district"><a href="{{route('admin.district.index')}}"><i class="fa fa-users"></i> <span>Quận /Huyện</span></a></li>
            <li class="school"><a href="{{route('admin.school.index')}}"><i class="fa fa-users"></i> <span>Trường</span></a></li>
            <li class="class"><a href="{{route('admin.class.index')}}"><i class="fa fa-users"></i> <span>Lớp</span></a></li>
            <li class="class"><a href="{{route('admin.titleLesson.create')}}"><i class="fa fa-users"></i> <span>Tiêu đề bài học</span></a></li>
            {{--<li class="grade-level"><a href="{{route('admin.lesson.index')}}"><i class="fa fa-users"></i> <span>Khối</span></a></li>--}}


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>