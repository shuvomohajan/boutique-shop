<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
  <!-- begin: Header Menu -->
  <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
  <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">

    <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
      <ul class="kt-menu__nav ">
        <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="{{ url('/') }}" target="_blank" class="kt-menu__link "><span class="kt-menu__link-text">Application</span></a></li>
      </ul>
    </div>
  </div>
  <!-- end: Header Menu -->
  <!-- begin:: Header Topbar -->
  <div class="kt-header__topbar">
    <!--begin: Search -->
    <!--begin: Search -->
    <div class="kt-header__topbar-item kt-header__topbar-item--search dropdown" id="kt_quick_search_toggle">
      <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
        <span class="kt-header__topbar-icon">
          <i class="flaticon2-search-1"></i>
        </span>
      </div>
      <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
        <div class="kt-quick-search kt-quick-search--dropdown kt-quick-search--result-compact" id="kt_quick_search_dropdown">
          <form method="get" class="kt-quick-search__form">
            <div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
              <input type="text" class="form-control kt-quick-search__input" placeholder="Search...">
              <div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close"></i></span></div>
            </div>
          </form>
          <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="325" data-mobile-height="200">

          </div>
        </div>
      </div>
    </div>
    <!--end: Search -->
    <!--begin: User Bar -->
    <div class="kt-header__topbar-item kt-header__topbar-item--user">
      <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
        <div class="kt-header__topbar-user">
          <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
          <span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->name }}</span>
          <img class="kt-radius-100" style="width: 30px; height: 30px; object-fit: cover; object-position: center" alt="Pic"
            src="{{ asset('storage/' . (Auth::user()->image ? Auth::user()->image : 'images/default_user.png')) }}" />
        </div>
      </div>

      <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
        <!--begin: Head -->
        <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x">
          <div class="kt-user-card__avatar">
            <img class="kt-radius-100" style="width: 40px; height: 40px; object-fit: cover; object-position: center" alt="Pic" src="{{ asset('storage/' . (Auth::user()->image ? Auth::user()->image : 'images/default_user.png')) }}" />
          </div>
          <div class="kt-user-card__name" style="color: #666">
            {{ Auth::user()->name }}
          </div>
          {{-- <div class="kt-user-card__badge">
            <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
          </div> --}}
        </div>
        <!--end: Head -->

        <!--begin: Navigation -->
        <div class="kt-notification">
          {{-- <a href="custom/apps/user/profile-1/personal-information.html" class="kt-notification__item">
            <div class="kt-notification__item-icon">
              <i class="flaticon2-calendar-3 kt-font-success"></i>
            </div>
            <div class="kt-notification__item-details">
              <div class="kt-notification__item-title kt-font-bold">
                My Profile
              </div>
              <div class="kt-notification__item-time">
                Account settings and more
              </div>
            </div>
          </a>
          <a href="custom/apps/user/profile-3.html" class="kt-notification__item">
            <div class="kt-notification__item-icon">
              <i class="flaticon2-mail kt-font-warning"></i>
            </div>
            <div class="kt-notification__item-details">
              <div class="kt-notification__item-title kt-font-bold">
                My Messages
              </div>
              <div class="kt-notification__item-time">
                Inbox and tasks
              </div>
            </div>
          </a>
          <a href="custom/apps/user/profile-2.html" class="kt-notification__item">
            <div class="kt-notification__item-icon">
              <i class="flaticon2-rocket-1 kt-font-danger"></i>
            </div>
            <div class="kt-notification__item-details">
              <div class="kt-notification__item-title kt-font-bold">
                My Activities
              </div>
              <div class="kt-notification__item-time">
                Logs and notifications
              </div>
            </div>
          </a>
          <a href="custom/apps/user/profile-3.html" class="kt-notification__item">
            <div class="kt-notification__item-icon">
              <i class="flaticon2-hourglass kt-font-brand"></i>
            </div>
            <div class="kt-notification__item-details">
              <div class="kt-notification__item-title kt-font-bold">
                My Tasks
              </div>
              <div class="kt-notification__item-time">
                latest tasks and projects
              </div>
            </div>
          </a>

          <a href="custom/apps/user/profile-1/overview.html" class="kt-notification__item">
            <div class="kt-notification__item-icon">
              <i class="flaticon2-cardiogram kt-font-warning"></i>
            </div>
            <div class="kt-notification__item-details">
              <div class="kt-notification__item-title kt-font-bold">
                Billing
              </div>
              <div class="kt-notification__item-time">
                billing & statements <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">2
                  pending</span>
              </div>
            </div>
          </a> --}}

          <div class="kt-notification__custom kt-space-between">
            <a class="btn btn-label btn-label-brand btn-sm btn-bold" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('Sign Out') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>

            {{-- <a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a> --}}
          </div>
        </div>
        <!--end: Navigation -->
      </div>
    </div>
    <!--end: User Bar -->

  </div>
  <!-- end:: Header Topbar -->
</div>
<!-- end:: Header -->
