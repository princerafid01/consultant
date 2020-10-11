<!-----------Menus Sidebar---------->
<aside class="main-sidebar">
  <section class="sidebar" style="height: auto;">
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <ul class="sidebar-menu tree" data-widget="tree">
      <li class="{{ Route::currentRouteName() === 'dashboard' ? 'active':'' }}">
        <a href="{{ route('dashboard') }}">
          <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="{{ Route::currentRouteName() === 'experts.index' ? 'active':'' }}">
        <a href="{{ route('experts.index') }}">
          <i class="fa fa-user"></i> <span>Geeks</span>
        </a>
      </li>

      <li class="{{ Route::currentRouteName() === 'categories.index' ? 'active':'' }}">
        <a href="{{ route('categories.index') }}">
          <i class="fa fa-list-alt"></i> <span>Categories</span>
        </a>
      </li>
      <li class="{{ Route::currentRouteName() === 'users.index' ? 'active':'' }}">
        <a href="{{ route('users.index') }}">
          <i class="fa fa-users"></i> <span>Users</span>
        </a>
      </li>
      <li class="{{ Route::currentRouteName() === 'bookings.index' ? 'active':'' }}">
        <a href="{{ route('bookings.index') }}">
          <i class="fa fa-book"></i> <span>Booking List</span>
        </a>
      </li>
      <li class="{{ Route::currentRouteName() === 'earnings.index' ? 'active':'' }}">
        <a href="{{ route('earnings.index') }}">
          <i class="fa fa-money"></i> <span>Withdrawal List</span>
        </a>
      </li>

      <li class="{{ Route::currentRouteName() === 'homepage.content.index' ? 'active':'' }}">
        <a href="{{ route('homepage.content.index') }}">
          <i class="fa fa-clock-o"></i> <span>Homepage Contents</span>
        </a>
      </li>

      <li class="{{ Route::currentRouteName() === 'tags.index' ? 'active':'' }}">
        <a href="{{ route('tags.index') }}">
          <i class="fa fa-tags"></i> <span>Tags</span>
        </a>
      </li>
{{--
      <li>
        <a href="settings.php">
          <i class="fa fa-cogs"></i> <span>Settings</span>
        </a>
      </li>
      <li>
        <a href="banking.php">
          <i class="fa fa-user"></i> <span>Banking Info</span>
        </a>
      </li>
      <li>
        <a href="booking.php">
          <i class="fa fa-file-text"></i> <span>Booking List</span>
        </a>
      </li>
      <li>
        <a href="chat.php">
          <i class="fa fa-comment"></i> <span>Chat Dashboard</span>
        </a>
      </li>
      <li>
        <a href="calendar.php">
          <i class="fa fa-calendar"></i> <span>Calendar</span>
        </a>
      </li> --}}
    </ul>
  </section>
</aside>