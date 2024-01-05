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
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        
                      </li>

                    </ol>
                  </h5>
                </div>
                <div class="card-body">
                  @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show">
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      <strong>{{ session('success') }}</strong> 
                  </div>
                  @else
                  <div class="alert alert-danger alert-dismissible fade show">
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      <strong> {{ session('error') }}</strong> 
                  @endif  
                    <form action="{{route('admin.product.create')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('POST')                      
                            <div class="mb-4">
                              <label  class="form-label fw-semibold">Product Name</label>
                              <input type="text" class="form-control" name="name" placeholder="product.etc" value="">
                            </div>
                            <div class="mb-4">
                              <label  class="form-label fw-semibold">Image</label> <br>                               
                                <img id="imagePreview"  src="" alt="" class="mb-3" >                               
                              <input id="imageInput" type="file" name="images" class="form-control" accept=".jpg, .jpeg, .png"  onchange="uploadImage()">
                            </div>
                            <div class="mb-4">
                              <label class="form-label fw-semibold">Price</label>
                              <input type="text" min="1" name="price" class="form-control" id="numbInput" oninput="formatNumb('#numbInput')" value="">
                            </div>
                            <div class="mb-4">
                              <label class="form-label fw-semibold">Quantity</label>
                              <input type="text" min="1" name="quantity" class="form-control" id="numb1Input" oninput="formatNumb('#numb1Input')" value="">
                            </div>
                            <div class="mb-4">
                              <label class="form-label fw-semibold">Description</label>
                              <textarea class="form-control p-7" name="description" id="" cols="20" rows="5"></textarea>
                            </div>   
                            <div class="mb-4">
                              <label class="form-label fw-semibold">Category</label>
                              <select name="category_id" class="form-control">
                                <option value="">Choise categories</option>
                                @foreach ($categories as $category)                                
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                              </select>
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