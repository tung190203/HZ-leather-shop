<!--  Header Start -->
<header class="app-header">
  <div class="with-vertical">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="navbar-collapse justify-content-end px-0" id="">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="ti ti-bell-ringing"></i>
                        <div class="notification bg-primary rounded-circle"></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <div class="d-flex justify-content-center">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('admin/assets/images/profile/user-1.jpg')}}" alt="" width="35" height="35"
                                class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                          <div class="d-flex align-items-center py-9 mx-7 border-bottom">   
                            <img
                            src="{{asset('admin/assets/images/profile/user-1.jpg')}}" class="rounded-circle" width="80" height="80" alt=""/>
                          <div class="ms-3">
                            <h5 class="mb-1 fs-3">{{Auth::user()->first_name}}{{Auth::user()->last_name}}</h5>
                            <p class="mb-0 d-flex align-items-center gap-2">
                              <i class="ti ti-mail fs-4"></i> {{Auth::user()->email}}
                            </p>
                          </div>                         
                          </div>
                            <div class="message-body">
                                <a href="{{route('client.home')}}" class="py-8 px-7 mt-8 d-flex align-items-center">
                                <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                                 <i class="ti ti-user fs-4"></i>
                                </span>
                                <div class="w-75 d-inline-block v-middle ps-3">
                                  <h6 class="mb-1 fs-3 fw-semibold lh-base">Back Client</h6>
                                  <span class="fs-2 d-block text-body-secondary">Client Side</span>
                                </div>
                              </a>
                              <a href="#" class="py-8 px-7 mt-8 d-flex align-items-center">
                                <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                                 <i class="ti ti-user fs-4"></i>
                                </span>
                                <div class="w-75 d-inline-block v-middle ps-3">
                                  <h6 class="mb-1 fs-3 fw-semibold lh-base">My Profile</h6>
                                  <span class="fs-2 d-block text-body-secondary">Account Settings</span>
                                </div>
                              </a>
                                <a href="{{route('admin.logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block"><i
                                        class="ti ti-logout"></i> Logout</a>
                            </div>
                        </div>
                </li>
            </ul>

        </div>
    </nav>
  </div>
</header>
<!--  Header End -->
