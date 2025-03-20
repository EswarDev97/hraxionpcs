<nav id="sidebar" class="navbar-nav">
  <!-- Sidebar Header -->
  <div class="sidebar-header">
    <a class="navbar-brand text-white" href="{{ url('/dashboard') }}">
        <h3>{{ config('app.name', 'Laravel') }}</h3>
    </a>
  </div>

  <ul class="list-unstyled components">
      <!-- Profile Section -->
      <div class="d-flex justify-content-center align-items-center my-3">
          <img src="{{ optional(auth()->user()->employee->employeeDetail)->photo 
              ? asset('/storage/' . auth()->user()->employee->employeeDetail->photo) 
              : asset('/images/profile.png') }}" 
              alt="profile-picture" class="rounded-circle w-50">
      </div>
      <div class="d-flex justify-content-center align-items-center">
          <h3>Hello, <b>{{ auth()->user()->name }}</b>!</h3>
      </div>

      <!-- Dynamic Menu Items -->
      @foreach ($accesses as $access) 
        @if ($access->status > 0)
          <li class="nav-item {{ request()->is($access->menu->route . '*') ? 'nav-active' : '' }}">
            @include('components.nav.' . $access->menu->name)
          </li>
        @endif
      @endforeach

      <!-- Organization Tree Menu -->
      <li class="nav-item">
          <a href="#organizationTreeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fas fa-sitemap"></i> Organization Tree
          </a>
          <ul class="collapse list-unstyled" id="organizationTreeSubmenu">
              <li class="nav-item">
                  <a href="{{ route('organization.index') }}" class="nav-link">
                      <i class="fas fa-tree"></i> View Tree
                  </a>
              </li>
          </ul>
      </li>

      <!-- Financial Requests Menu -->
      <li class="nav-item">
          <a href="#financialRequestsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fas fa-money-check-alt"></i> Financial Requests
          </a>
          <ul class="collapse list-unstyled" id="financialRequestsSubmenu">
              <li class="nav-item">
                  <a href="{{ route('financial-requests.index') }}" class="nav-link">
                      <i class="fas fa-list"></i> All Financial Requests
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('financial-requests.create') }}" class="nav-link">
                      <i class="fas fa-plus-circle"></i> Create Request
                  </a>
              </li>
          </ul>
      </li>
  </ul>
</nav>

<!-- Ensure Bootstrap & jQuery are loaded
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
