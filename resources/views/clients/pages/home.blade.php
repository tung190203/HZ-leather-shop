@extends('index')
@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Revenue Updates</h5>
                                <p class="card-subtitle mb-0">Overview of Profit</p>
                            </div>
                            <select class="form-select w-auto">
                                <option value="1">March 2023</option>
                                <option value="2">April 2023</option>
                                <option value="3">May 2023</option>
                                <option value="4">June 2023</option>
                            </select>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div id="chart"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="hstack mb-4 pb-1">
                                    <div
                                        class="p-8 bg-primary-subtle rounded-1 me-3 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-grid-dots text-primary fs-6"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-0 fs-7 fw-semibold">$63,489.50</h4>
                                        <p class="fs-3 mb-0">Total Earnings</p>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex align-items-baseline mb-4">
                                        <span class="round-8 text-bg-primary rounded-circle me-6"></span>
                                        <div>
                                            <p class="fs-3 mb-1">Earnings this month</p>
                                            <h6 class="fs-5 fw-semibold mb-0">$48,820</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-baseline mb-4 pb-1">
                                        <span class="round-8 text-bg-secondary rounded-circle me-6"></span>
                                        <div>
                                            <p class="fs-3 mb-1">Expense this month</p>
                                            <h6 class="fs-5 fw-semibold mb-0">$26,498</h6>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary w-100">
                                            View Full Report
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Employee Salary -->
            <div class="col-lg-4 d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">
                                Employee Salary
                            </h5>
                            <p class="card-subtitle mb-0">Every month</p>
                            <div id="salary" class="mb-7 pb-8"></div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div
                                        class="bg-primary-subtle rounded me-8 p-8 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-grid-dots text-primary fs-6"></i>
                                    </div>
                                    <div>
                                        <p class="fs-3 mb-0 fw-normal">Salary</p>
                                        <h6 class="fw-semibold text-dark fs-4 mb-0">
                                            $36,358
                                        </h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="text-bg-light rounded me-8 p-8 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-grid-dots text-muted fs-6"></i>
                                    </div>
                                    <div>
                                        <p class="fs-3 mb-0 fw-normal">Profit</p>
                                        <h6 class="fw-semibold text-dark fs-4 mb-0">
                                            $5,296
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project -->
            <div class="col-lg-4">
                <div class="row">
                    <!-- Customers -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body pb-0 mb-xxl-4 pb-1">
                                <p class="mb-1 fs-3">Customers</p>
                                <h4 class="fw-semibold fs-7">36,358</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <span
                                        class="me-2 rounded-circle bg-danger-subtle round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-down-right text-danger"></i>
                                    </span>
                                    <p class="text-dark fs-3 mb-0">+9%</p>
                                </div>
                            </div>
                            <div id="customers"></div>
                        </div>
                    </div>
                    <!-- Projects -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-1 fs-3">Projects</p>
                                <h4 class="fw-semibold fs-7">78,298</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <span
                                        class="me-1 rounded-circle bg-success-subtle round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-up-left text-success"></i>
                                    </span>
                                    <p class="text-dark fs-3 mb-0">+9%</p>
                                </div>
                                <div id="projects"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Comming Soon -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-7 pb-2">
                            <div class="me-3 pe-1">
                                <img src="../assets/images/profile/user-1.jpg"
                                    class="shadow-warning rounded-2" alt="" width="72"
                                    height="72" />
                            </div>
                            <div>
                                <h5 class="fw-semibold fs-5 mb-2">
                                    Super awesome, Vue coming soon!
                                </h5>
                                <p class="fs-3 mb-0">22 March, 2023</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <ul class="hstack mb-0">
                                <li class="ms-n8">
                                    <a href="javascript:void(0)" class="me-1">
                                        <img src="../assets/images/profile/user-2.jpg"
                                            class="rounded-circle border border-2 border-white" width="44"
                                            height="44" alt="" />
                                    </a>
                                </li>
                                <li class="ms-n8">
                                    <a href="javascript:void(0)" class="me-1">
                                        <img src="../assets/images/profile/user-3.jpg"
                                            class="rounded-circle border border-2 border-white" width="44"
                                            height="44" alt="" />
                                    </a>
                                </li>
                                <li class="ms-n8">
                                    <a href="javascript:void(0)" class="me-1">
                                        <img src="../assets/images/profile/user-4.jpg"
                                            class="rounded-circle border border-2 border-white" width="44"
                                            height="44" alt="" />
                                    </a>
                                </li>
                                <li class="ms-n8">
                                    <a href="javascript:void(0)" class="me-1">
                                        <img src="../assets/images/profile/user-5.jpg"
                                            class="rounded-circle border border-2 border-white" width="44"
                                            height="44" alt="" />
                                    </a>
                                </li>
                            </ul>
                            <a href="#"
                                class="text-bg-light rounded py-1 px-8 d-flex align-items-center text-decoration-none">
                                <i class="ti ti-message-2 fs-6 text-primary"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Selling Products -->
            <div class="col-lg-4 d-flex align-items-strech">
                <div class="card text-bg-primary border-0 w-100">
                    <div class="card-body pb-0">
                        <h5 class="fw-semibold mb-1 text-white card-title">
                            Best Selling Products
                        </h5>
                        <p class="fs-3 mb-3 text-white">Overview 2023</p>
                        <div class="text-center mt-3">
                            <img src="../assets/images/backgrounds/piggy.png" class="img-fluid"
                                alt="" />
                        </div>
                    </div>
                    <div class="card mx-2 mb-2 mt-n2">
                        <div class="card-body">
                            <div class="mb-7 pb-1">
                                <div class="d-flex justify-content-between align-items-center mb-6">
                                    <div>
                                        <h6 class="mb-1 fs-4 fw-semibold">MaterialPro</h6>
                                        <p class="fs-3 mb-0">$23,568</p>
                                    </div>
                                    <div>
                                        <span
                                            class="badge bg-primary-subtle text-primary fw-semibold fs-3">55%</span>
                                    </div>
                                </div>
                                <div class="progress bg-primary-subtle" style="height: 4px">
                                    <div class="progress-bar w-50" role="progressbar" aria-valuenow="75"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-6">
                                    <div>
                                        <h6 class="mb-1 fs-4 fw-semibold">Flexy Admin</h6>
                                        <p class="fs-3 mb-0">$23,568</p>
                                    </div>
                                    <div>
                                        <span
                                            class="badge bg-secondary-subtle text-secondary fw-bold fs-3">20%</span>
                                    </div>
                                </div>
                                <div class="progress bg-secondary-subtle" style="height: 4px">
                                    <div class="progress-bar text-bg-secondary w-25" role="progressbar"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection