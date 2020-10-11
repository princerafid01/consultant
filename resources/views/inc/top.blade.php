
<!-----------Top-Bar---------->
<header class="main-header">
  <a href="/admin" class="logo">
    <span class="logo-mini">
      <img src="/public/dist/img/logo-3.png" alt="Logo Image">
    </span>
    <span class="logo-lg">
      <img src="/public/dist/img/logo-2.png" alt="Logo Image">
    </span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        {{-- <li class="dropdown messages-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">4</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 4 messages</li>
            <li>
              <ul class="menu">
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <img src="/public/dist/img/user5-128x128.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                    Support Team
                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <img src="/public/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                    AdminLTE Design Team
                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <img src="/public/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                    Developers
                    <small><i class="fa fa-clock-o"></i> Today</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <img src="/public/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                    Sales Department
                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <img src="/public/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                    Reviewers
                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="message.php">See All Messages</a></li>
          </ul>
        </li>
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">10</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li>
              <ul class="menu">
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                    page and may cause design problems
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-users text-red"></i> 5 new members joined
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-user text-red"></i> You changed your username
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li> --}}
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="/public/dist/img/user8-128x128.jpg" class="user-image" alt="User Image">
            <span class="hidden-xs">Expense Geeks</span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="/public/dist/img/user8-128x128.jpg" class="img-circle" alt="User Image">
              <p>
                Expense Geeks
                <small>Member since May. 2020</small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-right">
                <a class="dropdown-item btn btn-default btn-flat" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>