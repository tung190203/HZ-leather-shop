@extends('admin')
@section('content')
<div class="body-wrapper">
  @include('admin.layouts.topbar')
  <div class="container-fluid">
      <div class="row mt-3">
          <div class="col-lg-12 ">
            
              <div class="card">
                <div class="px-4 py-3 border-bottom">
                  <h5 class="card-title fw-semibold mb-0">
                    <div class="d-flex align-items-center">
                      <div>
                        <h6 class="fs-5 mb-0">Add Category</h6>
                      </div>
                    </div>
                  </h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Success! Add category successfully</strong> {{ session('success') }}
                    </div>
                    @endif                
                    <form action="{{route('admin.category.create')}}" method="POST">
                      @csrf
                      @method('POST')                      
                            <div class="mb-4">
                              <label  class="form-label fw-semibold">Category Name</label>
                              <input type="text" class="form-control" name="name" placeholder="category.etc" value="">
                            </div>
                            <div class="mb-4">
                              <label class="form-label fw-semibold">Description</label>
                              <textarea class="form-control p-7" name="description" id="" cols="20" rows="5"></textarea>
                            </div>                                          
                          <div class="d-md-flex align-items-center">
                            <div class="mt-3 mt-md-0 ms-auto">
                              <button type="submit" class="btn btn-primary font-medium rounded-pill px-4">
                                <div class="d-flex align-items-center">
                                <i class="ti ti-plus me-2 fs-4"></i>Add
                                </div>
                              </button>
                            </div>
                          </div>
                    </form>
                  </div>
                </div>
          </div>
      </div>
    </div>
</div>

  @endsection