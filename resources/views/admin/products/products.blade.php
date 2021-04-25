@extends('layouts.admin_layout.admin_layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
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
              <div class="card-body">
                <table id="products" class="table table-bordered table-striped" >
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Section</th>
                    <th>Image</th>
                    <th>brand</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                          <?php $product_image_path = "images/product_images/small/" . $product->main_image; ?>
                          @if (!empty($product->main_image) && file_exists($product_image_path))
                              <img src="{{asset('images/product_images/small/' .$product->main_image)}}" class="mt-2 mb-2"
                          style="width: 50px; height: 50px;"/>
                          @else
                              <img src="{{asset('images/product_images/no-image.png')}}" class="mt-2 mb-2"
                              style="width: 50px; height: 50px;"/>
                          @endif
                        </td>
                        <td>{{$product->brand->name}}</td>
                        <td>{{$product->product_price}}</td>
                        <td>{{$product->product_discount}}</td>
                        <td>
                            @if ($product->status == 1)
                                <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}"
                                  href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true"  status="Active"></i></a>
                            @else
                                <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}"
                                  href="javascript:void(0)" ><i class="fas fa-toggle-off" aria-hidden="true"  status="Inactive"></i></a>
                            @endif
                        </td>
                        <td>
                          <a title="Add/Edit Attribute" href="{{url('admin/add-attributes/' .$product->id)}}" style="color: black;">
                            <i class="far fa-plus-square"></i>
                          </a>
                          &nbsp;&nbsp;
                          <a title="Add Image" href="{{url('admin/add-images/' .$product->id)}}" style="color: black;">
                            <i class="fas fa-plus-circle"></i>
                          </a>
                          &nbsp;&nbsp;
                          <a title="Edit Product" href="{{url('admin/add-edit-product/' .$product->id)}}" style="color: black;">
                            <i class="far fa-edit"></i>
                          </a>
                          &nbsp;&nbsp;
                          <a title="Delete Product" href="javascript:void(0)" class="confirmDelete"
                            record="product" recordid="{{$product->id}}" style="color: black;">
                            <i class="far fa-trash-alt"></i>
                          </a>
                        </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection
