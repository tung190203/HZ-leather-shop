@extends('index')
@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{route('client.profile')}}" method="Post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mt-4 justify-content-center">
                    {{-- Start upload profile --}}
                    <div class="col-lg-6 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold">Change Profile</h5>
                                <p class="card-subtitle mb-4">Change your profile picture from here</p>
                                <div class="text-center">
                                    
                                    @if ($user->avatar == null)
                                        <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt=""
                                            class="img-fluid rounded-circle" width="120" height="120" id="imagePre">
                                    @else
                                        <img src="{{ Storage::disk('minio')->url($user->avatar) }}" alt=""
                                            class="img-fluid rounded-circle" width="120" height="120">
                                    @endif
                                    <p id="uploadContent">Here is your avatar</p>
                                    <div class="d-flex align-items-center justify-content-center my-4 gap-3">
                                        {{-- <button class="btn btn-primary" id="btnupload">Upload</button> --}}
                                        <div class="col-6">
                                            <input type="file" name="avatar" id="imageChange" class="form-control"
                                                onchange="ChangeImage()">
                                        </div>
                                    </div>
                                    <p class="mb-0">Allowed JPG, JPEG or PNG</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End upload profile --}}
                    {{-- Change Password --}}
                    <div class="col-lg-6 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold">Change Password</h5>
                                <p class="card-subtitle mb-4">To change your password please confirm here</p>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label fw-semibold">Current
                                        Password</label>
                                    <input type="password" name="current_password" class="form-control">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword2" class="form-label fw-semibold">New
                                        Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="">
                                    <label for="exampleInputPassword3" class="form-label fw-semibold">Confirm
                                        Password</label>
                                    <input type="password" name="password_comfirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End change password --}}
                    {{-- Start change profile --}}
                    <div class="col-12 mb-4">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold">Update Information</h5>
                                <p class="card-subtitle mb-4">To Update your information please confirm here</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="" class="form-label fw-semibold">UserName</label>
                                            <input type="text" value="{{ $user->username }}" class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-4">
                                            <label for="exampleInputName1" class="form-label fw-semibold">First Name</label>
                                            <input type="text" name="first_name" class="form-control"
                                                value="{{ $user->first_name }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-4">
                                            <label for="exampleInputName2" class="form-label fw-semibold">Last Name</label>
                                            <input type="text" name="last_name" class="form-control"
                                                value="{{ $user->last_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col-lg-6 col-xl-6 col-sm-12">
                                        <div class="mb-4">
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" class="form-control"
                                                value="{{ $user->email }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 col-sm-12 ">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-4">
                                                    <label for="" class="form-label">Phone</label>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="{{ $user->phone }}">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-4">
                                                    <label for="" class="form-label">Gender</label>
                                                    <select name="gender" class="form-control">
                                                        @foreach (config('default.user.gender') as $key => $value)
                                                            <option value="{{ $key }}"
                                                                {{ $user->gender ? 'selected' : '' }}>{{ $value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <label for="" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control"
                                        value="{{ $user->address }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End change profile --}}
                    {{-- Start submit profile --}}
                    <div class="col-12 mb-4">
                        <div class="d-flex align-items-center justify-content-end mt-1 gap-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn bg-danger-subtle text-danger">Cancel</button>
                        </div>
                    </div>
                    {{-- End submit profile --}}
                </div>
            </form>

        </div>
    </div>
    </div>
@endsection
