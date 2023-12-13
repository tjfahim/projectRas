<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @if(auth()->user()->role === 'user')
        <li class="nav-item">
            <a class="nav-link " href="{{ route('profile.edit') }}">
                <i class="bi bi-grid"></i>
                <span>User Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('post.index') }}">
                <i class="bi bi-grid"></i>
                <span>Post Manage</span>
            </a>
        </li>
        @elseif(auth()->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link " href="">
                    <i class="bi bi-grid"></i>
                    <span>Admin Dashboard</span>
                </a>
            </li>
        @endif
    </ul>

</aside>
