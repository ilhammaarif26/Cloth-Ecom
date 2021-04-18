@extends('layouts.admin_layout.admin_layout')
  
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Attributes</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        {{-- validation alert --}}
        @if ($errors->any())
            <div class="alert alert-danger" style="margin-top: 10px;">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>      
                  @endforeach   
                </ul> 
            </div>
        @endif
        {{-- validation alert --}}
        @if (Session::has('success_message'))
        <div class="alert alert-info alert-dismissable fade show" style="margin-top: 10px;">
          {{Session::get('success_message')}}
          <button type="buttob" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        {{-- validation alert --}}
        @if (Session::has('error_message'))
        <div class="alert alert-danger alert-dismissable fade show" style="margin-top: 10px;">
          {{Session::get('error_message')}}
          <button type="buttob" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <form name="addAttributeForm" id="addAttributeForm"  method="POST" action="{{url('admin/add-attributes/' . $productData['id'])}}">
        @csrf
          {{-- <input type="hidden" name="product_id" value="{{$productData['id']}}"> --}}
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">{{$title}}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_name">Product Name : &nbsp;</label>
                        {{ $productData['product_name']}}
                    </div>
                    <div class="form-group">
                        <label for="product_code">Product Code : &nbsp;</label>
                        {{$productData['product_code']}}
                    </div>
                    <div class="form-group">
                        <label for="product_color">Product Color : &nbsp;</label>
                        {{$productData['product_color']}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group " >
                        @if (!empty($productData['main_image']))
                        <img src="{{asset('images/product_images/small/' .$productData['main_image'])}}" 
                        style="width: 120px;" class="shadow-sm bg-body rounded"/> 
                        @else
                        <img src="{{asset('images/product_images/no-image.png')}}" 
                        style="width: 120px;" class="shadow-sm bg-body rounded"/> 
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group " >
                        <div class="field_wrapper">
                          <label for="size">Add Attributes</label>
                            <div>
                                <input id="size" name="size[]" type="text" name="size[]" value="" 
                                placeholder="size" style="width: 120px;" required/>
                                <input id="sku" name="sku[]" type="text" name="sku[]" value="" 
                                placeholder="sku" style="width: 120px;"  required/>
                                <input id="price" name="price[]" type="number" name="price[]" value="" 
                                placeholder="price" style="width: 120px;" required/>
                                <input id="stock" name="stock[]" type="number" name="stock[]" value="" 
                                placeholder="stock" style="width: 120px;" required/>
                                <a href="javascript:void(0);" class="add_button" title="Add field">&nbsp;Add</a>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">submit</button>
            </div>
          </div>
        </form>
        @if (Session::has('update_message'))
        <div class="alert alert-info alert-dismissable fade show" style="margin-top: 10px;">
          {{Session::get('update_message')}}
          <button type="buttob" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        {{-- Attribute --}}
        <form name="editeAttributeForm" id="editeAttributeForm" method="POST" action="{{url('admin/edit-attributes/' .$productData['id'])}}">
        @csrf
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-12">
                <h3 class="card-title" >Product Attributes</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table id="products" class="table table-bordered table-striped" >
              <thead>
              <tr class="text-center">
                <th>ID</th>
                <th>Size</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($productData['attributes'] as $productAttr)
              <input style="display: none" type="text" name="attrId[]" value="{{$productAttr['id']}}">
                <tr class="text-center">
                    <td>{{$productAttr['id']}}</td>
                    <td>{{$productAttr['size']}}</td>
                    <td>{{$productAttr['sku']}}</td>
                    <td>
                      <input type="number" name="price[]" value="{{$productAttr['price']}}" required>
                    </td>
                    <td>
                      <input type="number" name="stock[]" value="{{$productAttr['stock']}}" required>
                    </td>
                    <td>
                      @if ($productAttr['status'] == 1)
                      <a class="updateAttributeStatus" id="atrribute-{{ $productAttr['id'] }}" attribute_id="{{ $productAttr['id'] }}" 
                        href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true"  status="Active"></i></a>
                      @else
                          <a class="updateAttributeStatus" id="attribute-{{ $productAttr['id'] }}" attribute_id="{{ $productAttr['id'] }}" 
                            href="javascript:void(0)" ><i class="fas fa-toggle-off" aria-hidden="true"  status="Inactive"></i></a>
                      @endif 
                      &nbsp; &nbsp;
                      <a title="Delete Attribute" href="javascript:void(0)" class="confirmDelete" 
                      record="attribute" recordid="{{$productAttr['id']}}" style="color: black;">
                      <i class="far fa-trash-alt"></i>
                      </a>
                    </td>
                </tr>
              @endforeach
            </table>
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Update Attributes</button>
            </div>
          </div>
        </div>
        </form>
       
      </div>
    </section>
  </div>
@endsection