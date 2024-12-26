<nav id="sidebar" class="navbar-nav">
  <div class="sidebar-header">
    <a class="navbar-brand text-white" href="{{ url('/dashboard') }}">
        <h3> {{ config('app.name', 'Laravel') }}</h3>
    </a>
  </div>
  <ul class="list-unstyled components">
      <div class="d-flex justify-content-center align-items-center my-3">
          <img src="{{ isset(auth()->user()->employee->employeeDetail->photo) ? asset('/storage/'. auth()->user()->employee->employeeDetail->photo ) : asset('/images/profile.png') }}" alt="profile-picture" class="rounded-circle w-50">
      </div>
      <div class="d-flex justify-content-center align-items-center ">
          <h3>Hello, <b>{{ auth()->user()->name }}</b>!</h3>
      </div>

      @foreach ($accesses as $access) 
        @if ($access->status > 0)
          <li class="nav-item {{ ($active == $access->menu->name) ? 'nav-active' : '' }}">
            @include('components.nav.' . $access->menu->name)
          </li>
        @endif
      @endforeach
      <li class="nav-item">
            <a href="#organizationTreeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                Organization Tree
            </a>
            <ul class="collapse list-unstyled" id="organizationTreeSubmenu">
                <li class="nav-item">
                    <a href="{{ route('organization.index') }}" class="nav-link">View Tree</a>
                </li>
                <!-- You can add more links related to the organization tree if needed -->
            </ul>
        </li>

      <li class="nav-item">
    <a href="#financialRequestsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
        Financial Requests
    </a>
    <ul class="collapse list-unstyled" id="financialRequestsSubmenu">
        <li class="nav-item">
            <a href="{{ route('financial-requests.index') }}" class="nav-link">All Financial Requests</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('financial-requests.create') }}" class="nav-link">Create Request</a>
        </li>
    </ul>
</li>
</ul>

</nav>