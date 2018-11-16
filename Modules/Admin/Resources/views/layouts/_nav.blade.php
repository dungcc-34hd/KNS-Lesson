<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Multilevel</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Level One
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-circle-o"></i> Level Two
                                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                </ul>
            </li>
            <li class="header">Administrator</li>
            <li class="role"><a href="{{route('admin.role.index')}}"><i class="fa fa-gg-circle"></i> <span>Role</span></a></li>
            <li class="permission"><a href="{{route('admin.permission.index')}}"><i class="fa fa-lock"></i> <span>Permission</span></a></li>
            <li class="user"><a href="{{route('admin.user.index')}}"><i class="fa fa-users"></i> <span>User</span></a></li>
            <li class="area"><a href="{{route('admin.area.index')}}"><i class="fa fa-users"></i> <span>Area</span></a></li>
            <li class="provincial"><a href="{{route('admin.provincial.index')}}"><i class="fa fa-users"></i> <span>Provincial</span></a></li>
            <li class="district"><a href="{{route('admin.district.index')}}"><i class="fa fa-users"></i> <span>District</span></a></li>
            <li class="school"><a href="{{route('admin.school.index')}}"><i class="fa fa-users"></i> <span>School</span></a></li>
            <li class="class"><a href="{{route('admin.class.index')}}"><i class="fa fa-users"></i> <span>Class</span></a></li>
            <li class="grade-level"><a href="{{route('admin.lesson.index')}}"><i class="fa fa-users"></i> <span>Glade Level</span></a></li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>