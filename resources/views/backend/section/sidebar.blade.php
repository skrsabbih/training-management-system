<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">RHD(TMS)</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="">
                <div class="parent-icon">
                    <i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>


        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">User Management</div>
            </a>
            <ul>
                <li class="{{ request()->routeIs('admin.permissions.*') ? 'mm-active' : '' }}"> <a
                        href="{{ route('admin.permissions.index') }}"><i class='bx bx-shield-quarter'
                            style="color:#FF6B6B;"></i>Permissions</a>
                </li>
                <li> <a href="app-chat-box.html"><i class='bx bx-id-card' style="color:#4ECDC4;"></i>Roles</a>
                </li>
                <li> <a href="app-file-manager.html"><i class='bx bx-user' style="color:#FF9F43;"></i>Users</a>
                </li>

            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>
