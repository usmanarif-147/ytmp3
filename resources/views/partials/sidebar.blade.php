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
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div>Footer Section</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item {{ request()->is('admin/terms-of-use/pages') ? 'active' : '' }}">
                    <a href="{{ route('termofusepages') }}" class="menu-link">
                        <div>Manage Terms of Use</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('admin/privacy-policy/pages') ? 'active' : '' }}">
                    <a href="{{ route('privacypolicypages') }}" class="menu-link">
                        <div>Manage Privacy Policy</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('admin/legal-disclaimer/pages') ? 'active' : '' }}">
                    <a href="{{ route('legaldisclaimerpages') }}" class="menu-link">
                        <div>Manage Leagle Disclaimer</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('admin/copy-right/pages') ? 'active' : '' }}">
                    <a href="{{ route('copyrightpages') }}" class="menu-link">
                        <div>Manage DMCA</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('admin/cookie-policy/pages') ? 'active' : '' }}">
                    <a href="{{ route('cookiepolicypages') }}" class="menu-link">
                        <div>Manage Cookie Policy</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0)" onclick="setYtmpLink()" class="menu-link">
                        <div>YouTubeToMP3</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0)" onclick="setYadLink()" class="menu-link">
                        <div>YouTube Audio Downloader</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0)" onclick="changePassword()" class="menu-link">
                <i class="menu-icon tf-icons bx bx-key"></i>
                <div>Change Password</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0)" onclick="changeEmail()" class="menu-link">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div>Change Email</div>
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

<div class="modal fade" id="changeEmail" tabindex="-1" aria-labelledby="changeEmailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeEmailLabel">Change Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter Email Address">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveEmail()">Update</button>
            </div>
        </div>
    </div>
</div>

{{-- Footer section url links --}}
<div class="modal fade" id="ytmp3" tabindex="-1" aria-labelledby="ytmp3Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ytmp3Label">YouTubeToMP3 Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="url" class="form-control" id="ytm" placeholder="Enter Url"
                        pattern="https://.*" size="30" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveYtmpLink()">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="yad" tabindex="-1" aria-labelledby="yadLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="yadLabel">YouTube Audio Downloader</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="url" class="form-control" id="yadLink" placeholder="Enter Url"
                        pattern="https://.*" size="30" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveYadLink()">Update</button>
            </div>
        </div>
    </div>
</div>
