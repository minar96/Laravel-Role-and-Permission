 @php  
    $usr = Auth::guard('admin')->user();
 @endphp

 <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="{{ route('admin.index') }}">
                        <h2 class="text-white">ADMIN DASHBOARD</h2>
                    </a>
                    
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            @if($usr->can('dashboard.view'))
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span style="font-size: 25px;">Dashboard</span></a>
                                <ul class="collapse">
                                    <li class="{{ Route::is('admin.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.index') }}">Dashboard</a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            @if($usr->can('role.view')|| $usr->can('role.create')||$usr->can('role.edit')||$usr->can('role.delete'))
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>
                                        Roles & Permissions
                                    </span></a>
                                <ul class="collapse {{ Route::is('admin.roles.create') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : '' }}">

                                    @if($usr->can('role.view'))
                                    <li class="{{ Route::is('admin.roles.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.roles.index') }}">All Roles</a>
                                    </li>
                                    @endif

                                    @if($usr->can('role.create'))
                                    <li class="{{ Route::is('admin.roles.create') ? 'active' : '' }}">
                                        <a href="{{ route('admin.roles.create') }}">Create Roles</a>
                                    </li>
                                    @endif
                                    
                                </ul>
                            </li>
                            @endif 
                            {{-- users sidebar start --}}
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>
                                        Users
                                    </span></a>
                                <ul class="collapse {{ Route::is('admin.users.create') || Route::is('admin.users.edit') || Route::is('admin.users.show') ? 'in' : '' }}">

                                    <li class="{{ Route::is('admin.users.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.users.index') }}">All User</a>
                                    </li>

                                    <li class="{{ Route::is('admin.users.create') ? 'active' : '' }}">
                                        <a href="{{ route('admin.users.create') }}">Create New User</a>
                                    </li>
                                </ul>
                            </li>
                            {{-- users sidebar start --}}
                            {{-- admins side bar start --}}
                              @if($usr->can('admin.view')||$usr->can('admin.create')||$usr->can('admin.edit')||$usr->can('admin.delete'))
                             <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>
                                        Admins
                                    </span></a>
                                <ul class="collapse {{ Route::is('admin.admins.create') || Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'in' : '' }}">

                                    @if($usr->can('admin.view'))
                                    <li class="{{ Route::is('admin.admins.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.admins.index') }}">All Admins</a>
                                    </li>
                                    @endif

                                    @if($usr->can('admin.create'))
                                    <li class="{{ Route::is('admin.admins.create') ? 'active' : '' }}">
                                        <a href="{{ route('admin.admins.create') }}">Create New Admin</a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            {{-- admins side bar end --}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->