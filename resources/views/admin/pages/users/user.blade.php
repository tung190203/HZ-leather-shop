@extends('admin')
@section('content')
    <div class="body-wrapper">
        @include('admin.layouts.topbar')
        <style>
            .truncate-text {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 200px;
            }

            .truncate-name {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 130px;
            }
        </style>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6 mb-3 text-end">
                    <button type="button" style="background-color:#5d86fc;box-shadow:0 0 2px black" class="btn m-1"><a
                            href="{{ route('admin.export.user') }}" style="color: white "> <i
                                class="ti ti-download fs-5"></i> Export</a></button>
                    <button type="button" style="background-color:#5d86fc;box-shadow:0 0 2px black" class="btn m-1" id="btnadd"><a
                            href="{{ route('admin.user.create') }}" style="color: white ">Add User</a></button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Users Management</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">#</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Information</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Gender</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Role</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Date Created</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0">{{ $user->id }}</h6>
                                                </td>
                                                <td class="border-bottom-0 truncate-text">
                                                    <h6 class="fw-semibold mb-1 ">{{ $user->first_name }}{{$user->last_name}}</h6>
                                                    <span class="fw-normal">
                                                        {{ $user->username }}
                                                    </span>
                                                </td>
                                                <td class="border-bottom-0 truncate-text">
                                                   <span class="fw-semibold">Email:</span>{{ $user->email ?? 'No' }} <br>
                                                   <span class="fw-semibold">Phone:</span>{{ $user->phone ?? 'No ' }} <br>
                                                   <span class="fw-semibold">Address:</span>{{ $user->address ?? 'No' }}
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal ">{{ $user->gender ?? 'No' }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    @if($user->role == 'admin')
                                                    <span class="mb-0 bagde p-1 rounded-3 bg-danger fw-semibold">{{ $user->role }}</span>
                                                    @else
                                                    <span class="mb-0 bagde p-1 rounded-3 bg-success fw-semibold">{{ $user->role }}</span>
                                                    @endif
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $user->created_at }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="action-btn">
                                                        <a href="{{ route('admin.user.detail', ['user' => $user->id]) }}"
                                                            class="text-info ">
                                                            <i class="ti ti-eye fs-5"></i>
                                                        </a>
                                                        <a href="" class="text-danger ms-2"
                                                            onclick="deleteItem('user',{{ $user->id }})">
                                                            <i class="ti ti-trash fs-5"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                        <div class="card-body">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item ">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                                        <li class="page-item {{ $i == $users->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
