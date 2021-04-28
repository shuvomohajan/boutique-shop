<!-- begin:: Aside -->
<button class="kt-aside-close" id="kt_aside_close_btn"><i class="la la-close"></i></button>

<div class="kt-aside kt-aside--fixed kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
  <!-- begin:: Aside -->
  <div class="kt-aside__brand kt-grid__item" id="kt_aside_brand">
    <div class="kt-aside__brand-logo">
      <a href="{{ asset('dashboard') }}">
        <img alt="{{ $companyInfo->name }}" src="{{ asset('storage/' . $companyInfo->logo) }}" style="width: 150px !important; width: auto"/>
      </a>
    </div>

    <div class="kt-aside__brand-tools">
      <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
        <span></span>
      </button>
    </div>
  </div>
  <!-- end:: Aside -->
  <!-- begin:: Aside Menu -->
  <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="kt-aside-menu" data-ktmenu-vertical="1" data-ktmenu-scroll="1"
         data-ktmenu-dropdown-timeout="500">
      <ul class="kt-menu__nav">
        @if (Auth::user()->type != 'user')

          <li class="kt-menu__item" id="db" aria-haspopup="true">
            <a href="{{ route('dashboard') }}" class="kt-menu__link"><i
                class="kt-menu__link-icon flaticon2-architecture-and-city"></i>
              <span
                class="kt-menu__link-text">Dashboard</span>
            </a>
          </li>
        @endif
        @canany([
        'superadmin','user.all','user.add','user.edit','user.view','user.delete','publisher.all','publisher.add','publisher.edit','publisher.view','publisher.delete',
        'author.all','author.add','author.edit','author.view','author.delete'

        ])
          <li
            class="kt-menu__item kt-menu__item--submenu {{ request()->is('dashboard/user*') ? 'kt-menu__item--open kt-menu__item--active' : null }}"
            aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
            <a href="javascript:" class="kt-menu__link kt-menu__toggle"><i
                class="kt-menu__link-icon fa fa-users"></i>
              <span class="kt-menu__link-text">User
                            Management</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
            <div class="kt-menu__submenu">
              <span class="kt-menu__arrow"></span>
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
                                <span class="kt-menu__link"><span class="kt-menu__link-text">User
                                        Management</span></span>
                </li>
                @canany(['superadmin','user.all','user.view','user.edit','user.delete','publisher.all','publisher.add','author.add','publisher.edit','publisher.view','publisher.delete','author.all','author.edit','author.delete','author.view'])
                  <li class="kt-menu__item kt-menu__item" aria-haspopup="true">
                    <a href="{{ route('user.index') }}" class="kt-menu__link">
                      <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                        <span></span>
                      </i>
                      <span
                        class="kt-menu__link-text">All Users</span>
                    </a>
                  </li>
                @endcanany
                @canany(['superadmin','publisher.all','publisher.create'])

                  <li class="kt-menu__item kt-menu__item" aria-haspopup="true">
                    <a href="{{ route('user.create', ['type' => 'publisher']) }}" class="kt-menu__link">
                      <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                        <span></span>
                      </i>
                      <span
                        class="kt-menu__link-text">Create Publisher</span>
                    </a>
                  </li>
                @endcanany
                @canany(['superadmin','author.all','author.create'])

                  <li class="kt-menu__item kt-menu__item" aria-haspopup="true">
                    <a href="{{ route('user.create', ['type' => 'author']) }}" class="kt-menu__link">
                      <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                        <span></span>
                      </i>
                      <span
                        class="kt-menu__link-text">Create Author</span>
                    </a>
                  </li>
                @endcanany

                @canany(['superadmin'])

                  <li class="kt-menu__item kt-menu__item" aria-haspopup="true">
                    <a href="{{ route('role.assign') }}" class="kt-menu__link">
                      <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                        <span></span>
                      </i>
                      <span
                        class="kt-menu__link-text">Assign Role</span>
                    </a>
                  </li>
                @endcanany

              </ul>
            </div>
          </li>
        @endcanany
        @canany(['superadmin','product.all','product.add','product.edit','product.delete','product.view',
        'category.all','category.add','category.edit','category.delete','category.view',
        'subject.all','subject.add','subject.edit','subject.delete','subject.view',
        'feature.all','feature.add','feature.edit','feature.delete','feature.view',
        'feature-category.all','feature-category.add','feature-category.edit','feature-category.delete','feature-category.view',
        'language.all','language.add','language.edit','language.delete','language.view',
        'tag.all','tag.add','tag.edit','tag.delete','tag.view',
        'format.all','format.add','format.edit','format.delete','format.view',
        ])
          <li
            class="kt-menu__item kt-menu__item--submenu {{ request()->is(['dashboard/product*', 'dashboard/tag*', 'dashboard/format*', 'dashboard/language*', 'dashboard/subject*', 'dashboard/category*', 'dashboard/subcategory*', 'dashboard/feature*', 'dashboard/coupon*', 'dashboard/stock*']) ? 'kt-menu__item--open kt-menu__item--active' : null }}"
            aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
            <a href="javascript:" class="kt-menu__link kt-menu__toggle"><i
                class="kt-menu__link-icon fas fa-sliders-h"></i>
              <span
                class="kt-menu__link-text">Product</span>
              <i
                class="kt-menu__ver-arrow la la-angle-right"></i></a>
            <div class="kt-menu__submenu">
              <span class="kt-menu__arrow"></span>
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
                  <span class="kt-menu__link"><span class="kt-menu__link-text">Product</span></span>
                </li>
                @canany(['superadmin','product.all','product.add','product.view','product.edit','product.delete',])
                  <li
                    class="kt-menu__item kt-menu__item {{ request()->is('dashboard/product*') ? 'kt-menu__item--active' : null }}"
                    aria-haspopup="true">
                    <a href="{{ route('product.index') }}" class="kt-menu__link"><i
                        class="kt-menu__link-icon fab fa-product-hunt"></i>
                      <span
                        class="kt-menu__link-text">All Products</span>
                    </a>
                  </li>
                @endcanany

                @canany(['superadmin','feature-category.all','feature-category.add','feature-category.view','feature-category.edit','feature-category.delete'])
                  <li
                    class="kt-menu__item kt-menu__item {{ request()->is('dashboard/feature-category*') ? 'kt-menu__item--active' : null }}"
                    aria-haspopup="true">
                    <a href="{{ route('feature-category.index') }}" class="kt-menu__link"><i
                        class="kt-menu__link-icon fa fa-layer-group"></i>
                      <span
                        class="kt-menu__link-text">Features Category</span>
                    </a>
                  </li>
                @endcanany
                @canany(['superadmin','feature.all','feature.add','feature.view','feature.edit','feature.delete'])
                  <li
                    class="kt-menu__item kt-menu__item {{ request()->is(['dashboard/feature', 'dashboard/feature/*']) ? 'kt-menu__item--active' : null }}"
                    aria-haspopup="true">
                    <a href="{{ route('feature.index') }}" class="kt-menu__link"><i
                        class="kt-menu__link-icon fa fa-layer-group"></i>
                      <span
                        class="kt-menu__link-text">Features</span>
                    </a>
                  </li>
                @endcanany
                @canany(['superadmin','category.all','category.add','category.view','category.edit','category.delete'])

                  <li
                    class="kt-menu__item kt-menu__item {{ request()->is('dashboard/category*') ? 'kt-menu__item--active' : null }}"
                    aria-haspopup="true">
                    <a href="{{ route('category.index') }}" class="kt-menu__link"><i
                        class="kt-menu__link-icon fa fa-layer-group"></i>
                      <span
                        class="kt-menu__link-text">Category</span>
                    </a>
                  </li>
                @endcanany
                @canany(['superadmin','category.all','category.add','category.view','category.edit','category.delete'])

                  <li
                    class="kt-menu__item kt-menu__item {{ request()->is('dashboard/subcategory*') ? 'kt-menu__item--active' : null }}"
                    aria-haspopup="true">
                    <a href="{{ route('subcategory.index') }}" class="kt-menu__link"><i
                        class="kt-menu__link-icon fa fa-layer-group"></i>
                      <span
                        class="kt-menu__link-text">Sub Category</span>
                    </a>
                  </li>
                @endcanany
                @canany(['superadmin','subject.all','subject.add','subject.view','subject.edit','subject.delete'])
                  <li
                    class="kt-menu__item kt-menu__item {{ request()->is('dashboard/subject*') ? 'kt-menu__item--active' : null }}"
                    aria-haspopup="true">
                    <a href="{{ route('subject.index') }}" class="kt-menu__link"><i
                        class="kt-menu__link-icon flaticon2-copy"></i>
                      <span
                        class="kt-menu__link-text">Subjects</span>
                    </a>
                  </li>
                @endcanany
                @canany(['superadmin','format.all','format.add','format.view','format.edit','format.delete'])
                  <li
                    class="kt-menu__item kt-menu__item {{ request()->is('dashboard/format*') ? 'kt-menu__item--active' : null }}"
                    aria-haspopup="true">
                    <a href="{{ route('format.index') }}" class="kt-menu__link"><i
                        class="kt-menu__link-icon flaticon2-copy"></i>
                      <span
                        class="kt-menu__link-text">Formats</span>
                    </a>
                  </li>
                @endcanany
                @canany(['superadmin','language.all','language.add','language.view','language.edit','language.delete'])
                  <li
                    class="kt-menu__item kt-menu__item {{ request()->is('dashboard/language*') ? 'kt-menu__item--active' : null }}"
                    aria-haspopup="true">
                    <a href="{{ route('language.index') }}" class="kt-menu__link"><i
                        class="kt-menu__link-icon flaticon2-copy"></i>
                      <span
                        class="kt-menu__link-text">Languages</span>
                    </a>
                  </li>
                @endcanany
                @canany(['superadmin','tag.all','tag.add','tag.view','tag.edit','tag.delete'])
                  <li
                    class="kt-menu__item kt-menu__item {{ request()->is('dashboard/tag*') ? 'kt-menu__item--active' : null }}"
                    aria-haspopup="true">
                    <a href="{{ route('tag.index') }}" class="kt-menu__link"><i
                        class="kt-menu__link-icon flaticon2-copy"></i>
                      <span
                        class="kt-menu__link-text">Tags</span>
                    </a>
                  </li>
                @endcanany
                <li
                  class="kt-menu__item kt-menu__item {{ request()->is('dashboard/coupon*') ? 'kt-menu__item--active' : null }}"
                  aria-haspopup="true">
                  <a href="{{ route('coupon.index') }}" class="kt-menu__link"><i
                      class="kt-menu__link-icon fas fa-ticket-alt"></i>
                    <span
                      class="kt-menu__link-text">Coupons</span>
                  </a>
                </li>
                <li
                  class="kt-menu__item kt-menu__item {{ request()->is('dashboard/stock*') ? 'kt-menu__item--active' : null }}"
                  aria-haspopup="true">
                  <a href="{{ route('stock.index') }}" class="kt-menu__link"><i
                      class="kt-menu__link-icon fas fa-ticket-alt"></i>
                    <span
                      class="kt-menu__link-text">Stock</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endcanany
        @canany(['superadmin','blog.all', 'post.create','post.edit','post.view','post.delete'])
          <li
            class="kt-menu__item kt-menu__item--submenu {{ request()->is(['dashboard/post*', 'dashboard/post_tag*', 'dashboard/post_category*']) ? 'kt-menu__item--open kt-menu__item--active' : null }}"
            aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
            <a href="javascript:" class="kt-menu__link kt-menu__toggle">
              <i class="kt-menu__link-icon fas fa-sliders-h"></i>
              <span class="kt-menu__link-text">Blog</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu">
              <span class="kt-menu__arrow"></span>
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
                  <span class="kt-menu__link"><span class="kt-menu__link-text">Blog</span></span>
                </li>
                <li
                  class="kt-menu__item kt-menu__item {{ (request()->is('dashboard/post') || request()->is('dashboard/post/*')) ? 'kt-menu__item--active' : null }}"
                  aria-haspopup="true">
                  <a href="{{ route('post.index') }}" class="kt-menu__link">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                    <span class="kt-menu__link-text">Post</span>
                  </a>
                </li>
                <li class="kt-menu__item kt-menu__item {{ request()->is('dashboard/post_category*') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                  <a href="{{ route('post_category.index') }}" class="kt-menu__link">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                    <span class="kt-menu__link-text">Post Category</span>
                  </a>
                </li>
                <li class="kt-menu__item kt-menu__item {{ request()->is('dashboard/post_tag*') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
                  <a href="{{ route('post_tag.index') }}" class="kt-menu__link">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                    <span class="kt-menu__link-text">Post Tag</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endcanany
        @canany(['superadmin','customer_support.all','customer_support.delete','customer_support.view'])
          <li class="kt-menu__item" aria-haspopup="true">
            <a href="{{ route('customer_support.index') }}" class="kt-menu__link"><i
                class="kt-menu__link-icon fas fa-truck"></i>
              <span
                class="kt-menu__link-text">Customer Support</span>
            </a>
          </li>
        @endcanany
        @canany(['superadmin','order.all'])
          <li class="kt-menu__item" aria-haspopup="true">
            <a href="{{ route('order.index') }}" class="kt-menu__link"><i
                class="kt-menu__link-icon fas fa-truck"></i>
              <span
                class="kt-menu__link-text">Orders</span>
            </a>
          </li>
        @endcanany
        @canany(['superadmin','settings.all'])
          <li
            class="kt-menu__item kt-menu__item--submenu {{ request()->is(['dashboard/company_settings*', 'dashboard/ecommerce_setting*', 'dashboard/slider*', 'dashboard/banner*', 'dashboard/categorysection*']) ? 'kt-menu__item--open kt-menu__item--active' : null }}"
            aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
            <a href="javascript:" class="kt-menu__link kt-menu__toggle"><i
                class="kt-menu__link-icon fas fa-sliders-h"></i>
              <span
                class="kt-menu__link-text">Settings</span>
              <i
                class="kt-menu__ver-arrow la la-angle-right"></i></a>
            <div class="kt-menu__submenu">
              <span class="kt-menu__arrow"></span>
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
                  <span class="kt-menu__link"><span class="kt-menu__link-text">Settings</span></span>
                </li>
                <li
                  class="kt-menu__item kt-menu__item {{ request()->is('dashboard/company_settings*') ? 'kt-menu__item--active' : null }}"
                  aria-haspopup="true">
                  <a href="{{ route('company.edit') }}" class="kt-menu__link">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span
                      class="kt-menu__link-text">Company Settings</span>
                  </a>
                </li>
                <li
                  class="kt-menu__item kt-menu__item {{ request()->is('dashboard/ecommerce_setting*') ? 'kt-menu__item--active' : null }}"
                  aria-haspopup="true">
                  <a href="{{ route('ecommerce.edit') }}" class="kt-menu__link">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span
                      class="kt-menu__link-text">E-commerce Settings</span>
                  </a>
                </li>
                <li
                  class="kt-menu__item kt-menu__item {{ request()->is('dashboard/slider*') ? 'kt-menu__item--active' : null }}"
                  aria-haspopup="true">
                  <a href="{{ route('slider.index') }}" class="kt-menu__link">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span
                      class="kt-menu__link-text">Slider Settings</span>
                  </a>
                </li>
                <li
                  class="kt-menu__item kt-menu__item {{ request()->is('dashboard/banner*') ? 'kt-menu__item--active' : null }}"
                  aria-haspopup="true">
                  <a href="{{ route('ads.banner') }}" class="kt-menu__link">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span
                      class="kt-menu__link-text">Ads Banner Settings</span>
                  </a>
                </li>
                <li
                  class="kt-menu__item kt-menu__item {{ request()->is('dashboard/categorysection*') ? 'kt-menu__item--active' : null }}"
                  aria-haspopup="true">
                  <a href="{{ route('categorysection.index') }}" class="kt-menu__link">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span
                      class="kt-menu__link-text">Manage Category Section</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endcanany
        @canany(['superadmin', 'report.all'])
          <li
            class="kt-menu__item kt-menu__item--submenu {{ request()->is(['dashboard/report*']) ? 'kt-menu__item--open kt-menu__item--active' : null }}"
            aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
            <a href="javascript:" class="kt-menu__link kt-menu__toggle">
              <i class="kt-menu__link-icon fas fa-sliders-h"></i>
              <span class="kt-menu__link-text">Report</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu">
              <span class="kt-menu__arrow"></span>
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
                  <span class="kt-menu__link"><span class="kt-menu__link-text">Report</span></span>
                </li>
                <li
                  class="kt-menu__item kt-menu__item {{ request()->is('dashboard/income') ? 'kt-menu__item--active' : null }}"
                  aria-haspopup="true">
                  <a href="{{ route('post.index') }}" class="kt-menu__link">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                    <span class="kt-menu__link-text">Income</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endcanany
        <li
          class="kt-menu__item kt-menu__item--submenu {{ request()->is(['updatePassword*']) ? 'kt-menu__item--open kt-menu__item--active' : null }}"
          aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
          <a href="javascript:" class="kt-menu__link kt-menu__toggle">
            <i class="kt-menu__link-icon fas fa-sliders-h"></i>
            <span class="kt-menu__link-text">Profile</span>
            <i class="kt-menu__ver-arrow la la-angle-right"></i>
          </a>
          <div class="kt-menu__submenu">
            <span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
              <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
                <span class="kt-menu__link"><span class="kt-menu__link-text">Profile</span></span>
              </li>
              <li
                class="kt-menu__item kt-menu__item {{ request()->is('updatePassword') ? 'kt-menu__item--active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('updatePassword.edit') }}" class="kt-menu__link">
                  <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                  <span class="kt-menu__link-text">Change Password</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        @php
          $auth = Auth::user()->type;
        @endphp

        @if ( $auth == 'user'||$auth == 'author'||$auth == 'publisher')
          <li class="kt-menu__item {{ request()->is('dashboard/order*') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
            <a href="{{ route('user.orders',Auth::id()) }}" class="kt-menu__link"><i
                class="kt-menu__link-icon fas fa-truck"></i>
              <span
                class="kt-menu__link-text">User Orders</span>
            </a>
          </li>
          <li class="kt-menu__item {{ request()->is('dashboard/profile*') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
            <a href="#" class="kt-menu__link"><i class="kt-menu__link-icon fas fa-user"></i>
              <span
                class="kt-menu__link-text">User account</span>
            </a>
          </li>
          <li class="kt-menu__item {{ request()->is('dashboard/address*') ? 'kt-menu__item--active' : null }}" aria-haspopup="true">
            <a href="{{ route('address.index') }}" class="kt-menu__link"><i class="kt-menu__link-icon fas fa-user"></i>
              <span
                class="kt-menu__link-text">Shipping Addresses</span>
            </a>
          </li>
        @endif
      </ul>
    </div>
  </div>
  <!-- end:: Aside Menu -->
</div>
<!-- end:: Aside -->
