@extends('layouts.admin_layout.admin_layout')
  
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            @if (Session::has('success_message'))
            <div class="alert alert-info alert-dismissable fade show" style="margin-top: 10px;">
              {{Session::get('success_message')}}
              <button type="buttob" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-6">
                    <h3 class="card-title">Products</h3>
                  </div>
                  <div class="col-sm-6">
                    <a href="{{ url('admin/add-edit-product')}}" style="max-width: 150px; display: inline-block; float: right;" 
                class="btn btn-primary">Add Product</a>
                  </div>
                </div>
                
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="products" class="table table-bordered table-striped" >
                  <thead>
                  <tr>
                    {{-- <th>No</th> --}}
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Section</th>
                    <th>Image</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Status</th>
                    <th>Actions</th>
                    {{-- <th>Product Video</th>  
                    <th>Main Image</th>
                    <th>Description</th>
                    <th>Wash Care</th>
                    <th>Fabric</th>
                    <th>Pattern</th>
                    <th>Seleeve</th>
                    <th>Fit</th>
                    <th>Ocassion</th>
                    <th>Meta Title</th>
                    <th>Meta </th> --}}
                  </tr>
                  </thead>
                  <tbody>
                  {{-- <?php $number = 1; ?> --}}
                  @foreach ($products as $product)
                    <tr>
                        {{-- <td>{{$number++}}</td> --}}
                        <td>{{$product->id}}</td>
                        <td>{{$product->product_code}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->category->category_name}}</td>
                        <td>{{$product->section->name}}</td>
                        <td>
                          <?php $product_image_path = "images/product_images/small/" . $product->main_image;

                          ?>
                          @if (!empty($product->main_image) && file_exists($product_image_path))
                              <img src="{{asset('images/product_images/small/' .$product->main_image)}}" class="mt-2 mb-2"
                          style="width: 50px; height: 50px;"/>
                          @else
                              <img src="{{asset('images/product_images/no-image.png')}}" class="mt-2 mb-2"
                              style="width: 50px; height: 50px;"/>
                          @endif
                        </td>
                        <td>{{$product->product_color}}</td> 
                        <td>{{$product->product_price}}</td>
                        <td>{{$product->product_discount}}</td>
                        <td>
                            @if ($product->status == 1)
                                <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" 
                                  href="javascript:void(0)">Active</a>
                            @else
                                <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" 
                                  href="javascript:void(0)" >Inactive</a>
                            @endif 
                        </td> 
                        {{-- <td>
                          @if (!empty($product->product_image))
                              <img src="{{asset('images/product_images/' .$product->product_image)}}" class="mt-2 mb-2"
                              style="width: 50px; height: 50px;"/>
                          @else
                              <img src="{{asset('images/product_images/no-image.png')}}" class="mt-2 mb-2"
                              style="width: 50px; height: 50px;"/>
                          @endif
                         
                        </td> --}}
                        <td>
                          <a href="{{url('admin/add-edit-product/' .$product->id)}}" class="btn btn-sm btn-info">Edit</a>
                          &nbsp;&nbsp;
                          <a <?php /* href="{{url('admin/delete-product/' .$product->id)}}" */ ?> href="javascript:void(0)" class="btn btn-sm btn-danger confirmDelete" 
                            record="product" recordid="{{$product->id}}" >Delete</a>
                        </td>
                    </tr>
                  @endforeach
                
                </table>
              </div>
             
              <!-- /.card-body -->
            </div>
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection