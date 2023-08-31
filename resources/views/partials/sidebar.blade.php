<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo mb-4">
        <a href="/admin/dashboard" class="app-brand-link display-3">
            YTMP3
            {{-- <span class="app-brand-logo demo">
                <img src="{{ asset('logo.png') }}" class="img-fluid" width="140" alt="Logo here">
            </span> --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ url('admin/dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('admin/languages') ? 'active' : '' }}">
            <a href="{{ route('languages') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-shape-square"></i>
                <div>Manage Languages</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('admin/pages') ? 'active' : '' }}">
            <a href="{{ route('pages') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-minus-back"></i>
                <div>Manage Pages</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0)" onclick="changePassword()" class="menu-link">
                <i class="menu-icon tf-icons bx bx-key"></i>
                <div>Change Password</div>
            </a>
        </li>
    </ul>
</aside>

<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="savePassword()">Update</button>
            </div>
        </div>
    </div>
</div>
