<!-- Main navbar -->
<div class="navbar navbar-expand-xl navbar-static shadow">
    <div class="container-fluid">
        <div class="flex-1">
            <a href="{{ route('siteurl') }}" class="d-inline-flex align-items-center">
                <img src="{{ asset('app_local/img/logo.png') }}" class="img-fluid" style="max-height: 30px;" alt="">
            </a>
        </div>

        <div
            class="d-flex w-100 w-xl-auto overflow-auto overflow-xl-visible scrollbar-hidden border-top border-top-xl-0 order-1 order-xl-0 pt-2 pt-xl-0 mt-2 mt-xl-0">
            <ul class="nav gap-1 justify-content-center flex-nowrap flex-xl-wrap mx-auto">
                <li class="nav-item">
                    <a href="{{ route('siteurl') }}"
                        class="navbar-nav-link rounded {{ $title == 'Dashboard' ? 'active' : '' }}">
                        <i class="ph-house me-2"></i>
                        Dashboard
                    </a>
                </li>

                @can('trans_view')
                    <li class="nav-item">
                        <a href="{{ route('trans.index') }}"
                            class="navbar-nav-link rounded {{ $title == 'Trans' ? 'active' : '' }}">
                            <i class="ph-notepad me-2"></i>
                            Transaksi
                        </a>
                    </li>
                @endcan

                @canany(['report_transaksi'])
                    <li class="nav-item nav-item-dropdown-xl dropdown">
                        <a href="#"
                            class="navbar-nav-link dropdown-toggle rounded {{ in_array($title, ['Transaksi']) ? 'active' : '' }}"
                            data-bs-toggle="dropdown">
                            <i class="ph-files me-2"></i>
                            Report
                        </a>

                        <div class="dropdown-menu">
                            <div class="dropdown-header">Report</div>
                            @can('report_transaksi')
                                <a href="{{ route('report.transaksi.index') }}"
                                    class="dropdown-item {{ $title == 'Transaksi' ? 'active' : '' }}">
                                    <i class="ph-files me-2"></i>
                                    Transaksi
                                </a>
                            @endcan

                            @can('report_stok_merch')
                                <a href="{{ route('report.stok-merch.index') }}"
                                    class="dropdown-item {{ $title == 'Stok Merch' ? 'active' : '' }}">
                                    <i class="ph-files me-2"></i>
                                    Stok Merch
                                </a>
                            @endcan
                        </div>
                    </li>
                @endcanany

                @canany(['master_merch', 'master_jenis_pengiriman'])
                    <li class="nav-item nav-item-dropdown-xl dropdown">
                        <a href="#"
                            class="navbar-nav-link dropdown-toggle rounded {{ in_array($title, ['Merch', 'Payment', 'Jenis Pengiriman']) ? 'active' : '' }}"
                            data-bs-toggle="dropdown">
                            <i class="ph-stack me-2"></i>
                            Master
                        </a>

                        <div class="dropdown-menu">
                            <div class="dropdown-header">General</div>
                            @can('master_merch')
                                <a href="{{ route('master.merch.index') }}"
                                    class="dropdown-item {{ $title == 'Merch' ? 'active' : '' }}">
                                    <i class="ph-stack me-2"></i>
                                    Merch
                                </a>
                                <a href="{{ route('master.merch-foto.index') }}"
                                    class="dropdown-item {{ $title == 'Merch Foto' ? 'active' : '' }}">
                                    <i class="ph-stack me-2"></i>
                                    Merch Foto
                                </a>
                            @endcan
                            @can('master_jenis_pengiriman')
                                <a href="{{ route('master.jenis-pengiriman.index') }}"
                                    class="dropdown-item {{ $title == 'Jenis Pengiriman' ? 'active' : '' }}">
                                    <i class="ph-stack me-2"></i>
                                    Jenis Pengiriman
                                </a>
                            @endcan
                        </div>
                    </li>
                @endcanany

                @canany(['view_permimssions', 'view_roles', 'view_users'])
                    <li class="nav-item nav-item-dropdown-xl dropdown">
                        <a href="#"
                            class="navbar-nav-link dropdown-toggle rounded {{ in_array($title, ['Permissions', 'Roles', 'User']) ? 'active' : '' }}"
                            data-bs-toggle="dropdown">
                            <i class="ph-gear me-2"></i>
                            Setup
                        </a>

                        <div class="dropdown-menu">
                            <div class="dropdown-header">Access Control</div>
                            @can('view_permimssions')
                                <a href="{{ route('permission') }}"
                                    class="dropdown-item {{ $title == 'Permissions' ? 'active' : '' }}">
                                    <i class="ph-gear-six me-2"></i>
                                    Permissions
                                </a>
                            @endcan
                            @can('view_roles')
                                <a href="{{ route('role') }}" class="dropdown-item {{ $title == 'Roles' ? 'active' : '' }}">
                                    <i class="ph-user-gear me-2"></i>
                                    Roles
                                </a>
                            @endcan
                            @can('view_users')
                                <a href="{{ route('user-setup.user.index') }}"
                                    class="dropdown-item {{ $title == 'User' ? 'active' : '' }}">
                                    <i class="ph-users me-2"></i>
                                    Users
                                </a>
                            @endcan
                        </div>
                    </li>
                @endcanany
            </ul>
        </div>

        <ul class="nav gap-1 flex-xl-1 justify-content-end order-0 order-xl-1">
            <li class="nav-item nav-item-dropdown-xl dropdown">
                <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1 avatar-custom"
                    data-bs-toggle="dropdown">
                    <div class="status-indicator-container status-indicator-container-custom">
                        <img src="{{ asset('assets/images/placeholder.jpg') }}" class="w-32px h-32px rounded-pill"
                            alt="">
                        <span class="status-indicator status-indicator-custom bg-success"></span>
                    </div>
                    <span class="d-none d-md-inline-block mx-md-2">{{ auth()->user()->name ?? '' }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <label href="#" class="dropdown-item cursor-pointer" for="sc_ls_c">
                        <i class="ph-moon me-2"></i>
                        Dark Theme
                        <div class="form-check form-switch form-check-reverse ms-auto">
                            <input type="checkbox" class="form-check-input" id="sc_ls_c" onchange="setTheme(this)">
                        </div>
                    </label>


                    <div class="dropdown-divider"></div>
                    <a href="{{ route('permission.list') }}" class="dropdown-item"><i class="ph-user-list me-2"></i>
                        Permissions List</a>
                    <a href="#!" onclick="changepassword('{{ route('changepassword') }}')"
                        class="dropdown-item"><i class="ph-lock-key me-2"></i> Change Password</a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                        class="dropdown-item"> <i class="ph-sign-out me-2"></i>
                        Logout</a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <form id="frm-toggle-theme" action="{{ route('toggle.theme') }}" method="GET"
                        style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->
