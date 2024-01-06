    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
          <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/dashboard" class="text-nowrap logo-img">
              <img src="{{asset('admin/assets/images/logo.png')}}" width="190"  alt="logo" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-8"></i>
            </div>
          </div>
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav scroll-sidebar simplebar-scrollable-y" data-simplebar="">
            <ul id="sidebarnav">
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Home</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
                  <span>
                    <i class="ti ti-dashboard"></i>
                  </span>
                  <span class="hide-menu">Dashboard</span>
                </a>
              </li>
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">MANAGE</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.product')}}" aria-expanded="false">
                  <span>
                    <i class="ti ti-box"></i>
                  </span>
                  <span class="hide-menu">Product Management</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.category')}}" aria-expanded="false">
                  <span>
                    <i class="ti ti-category"></i>
                  </span>
                  <span class="hide-menu">Category Management</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.user')}}" aria-expanded="false">
                  <span>
                    <i class="ti ti-user"></i>
                  </span>
                  <span class="hide-menu">User Management</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="#" aria-expanded="false">
                  <span>
                    <i class="ti ti-article"></i>
                  </span>
                  <span class="hide-menu">Statistical</span>
                </a>
              </li>
              
             
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">OTHER</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="#" aria-expanded="false">
                  <span>
                    <i class="ti ti-transform"></i>
                  </span>
                  <span class="hide-menu">Payment and Transaction</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="#" aria-expanded="false">
                  <span>
                    <i class="ti ti-archive"></i>
                  </span>
                  <span class="hide-menu">Inventory</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href=#" aria-expanded="false">
                  <span>
                    <i class="ti ti-bookmark"></i>
                  </span>
                  <span class="hide-menu">Order Management</span>
                </a>
              </li>
            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!--  Sidebar End -->