<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Admin<span>Panel</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Real Estate</li>
            @if (Auth::user()->can('type.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false"
                        aria-controls="emails">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Property Type</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="emails">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.type'))
                                <li class="nav-item">
                                    <a href="{{ route('all.type') }}" class="nav-link">All Type</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.type'))
                                <li class="nav-item">
                                    <a href="{{ route('add.type') }}" class="nav-link">Add Type</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('amenity.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#amenities" role="button" aria-expanded="false"
                        aria-controls="amenities">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Amenity Type</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="amenities">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.amenity'))
                                <li class="nav-item">
                                    <a href="{{ route('all.amenity') }}" class="nav-link">All Amenity</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.amenity'))
                                <li class="nav-item">
                                    <a href="{{ route('add.amenity') }}" class="nav-link">Add Amenity</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
                <li class="nav-item nav-category">Role and Permission</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#rolespermission" role="button"
                        aria-expanded="false" aria-controls="rolespermission">
                        <i class="link-icon" data-feather="anchor"></i>
                        <span class="link-title">Role and Permission</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="rolespermission">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('all.permission') }}" class="nav-link">All Permission</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('all.role') }}" class="nav-link">All Role</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('add.role.permission') }}" class="nav-link">Role in Permission</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('all.role.permission') }}" class="nav-link">All Role in Permission</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if (Auth::user()->can('admin.menu'))
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#admin" role="button"
                            aria-expanded="false" aria-controls="admin">
                            <i class="link-icon" data-feather="anchor"></i>
                            <span class="link-title">Manage Admin User</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="admin">
                            <ul class="nav sub-menu">
                                @if (Auth::user()->can('all.admin'))
                                    <li class="nav-item">
                                        <a href="{{ route('all.admin') }}" class="nav-link">All Admin</a>
                                    </li>
                                @endif
                                @if (Auth::user()->can('add.admin'))
                                    <li class="nav-item">
                                        <a href="{{ route('add.admin') }}" class="nav-link">Add Admin</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="nav-item nav-category">Docs</li>
                <li class="nav-item">
                    <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                        <i class="link-icon" data-feather="hash"></i>
                        <span class="link-title">Documentation</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
