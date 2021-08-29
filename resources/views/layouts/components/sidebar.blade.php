<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar__menu">

        <div class="sidebar__header">
            <img style="width: 70%" src="{{ asset('img/KMTI.png') }}" alt="">
        </div>

        <ul>

            <li>
                <a href="#">
                    <i class="icons__ fas fa-tachometer-alt"></i>
                  <span>Dashboard</span>
                </a>
            </li>
          <li>
            <a href="{{ route('manage-users.create')}}" class="{{ Request::routeIs('manage-users.create') ? 'active' : '' }}">
              <i class="icons__ fa fa-book"></i>
              <span>Manage User</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="icons__ fa fa-calendar"></i>
              <span>Divisi</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="icons__ fa fa-folder"></i>
              <span>Broadcast</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="icons__ fa fa-folder"></i>
              <span>Event</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
