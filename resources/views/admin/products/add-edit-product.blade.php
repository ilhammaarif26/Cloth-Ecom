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
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger" style="margin-top: 10px;">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>      
                  @endforeach   
                </ul> 
            </div>
        @endif
        @if (Session::has('success_message'))
        <div class="alert alert-info alert-dismissable fade show" style="margin-top: 10px;">
          {{Session::get('success_message')}}
          <button type="buttob" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <form name="productForm" id="ProductForm" @if (empty($productData['id']))
            action="{{url('admin/add-edit-product')}}"
        @else
            action="{{url('admin/add-edit-product/' .$productData['id'])}}"
        @endif  method="POST"
        enctype="multipart/form-data">
        @csrf
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
                        <label for="category_id">Select Category</label>
                        <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                            <option value="">select</option>
                            @foreach ($categories as $section)
                                <optgroup label="{{$section['name']}}"></optgroup>
                                    @foreach ($section['categories'] as $category)
                                        <option value="{{$category['id']}}" 
                                            @if(!empty(old('category_id')) && $category['id'] == old('category_id'))
                                                selected=""
                                            @elseif(!empty($productData['category_id']) && $productData['category_id'] == $category['id'])
                                                selected=""
                                            @endif>
                                            &nbsp;&raquo;&nbsp;{{$category['category_name']}}
                                            </option>
                                            @foreach ($category['subcategories'] as $subcategory)
                                                <option value="{{$subcategory['id']}}"
                                                    @if(!empty(old('category_id')) && $subcategory['id'] == old('category_id'))
                                                        selected=""
                                                    @elseif(!empty($productData['category_id']) && $productData['category_id'] == $subcategory['id'])
                                                        selected="" 
                                                    @endif>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{$subcategory['category_name']}}
                                                </option>
                                            @endforeach
                                    @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="insert product name" 
                        @if (!empty($productData['product_name']))
                            value="{{$productData['product_name']}}"
                        @else
                            value="{{old('product_name')}}"
                        @endif>
                    </div>
                </div>  
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_code">Product Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control select2" style="width: 100%">
                            <option value="">select</option>   
                            @foreach ($brands as $brand)
                                <option value="{{$brand["id"]}}"
                                @if (!empty($productData['brand_id'])  && $productData['brand_id']== $brand["id"])
                                    selected=""
                                @endif>{{$brand["name"]}}
                                </option>
                        @endforeach     
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="product_code">Product Code</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" placeholder="insert product code" 
                        @if (!empty($productData['product_code']))
                            value="{{$productData['product_code']}}"
                        @else
                            value="{{old('product_code')}}"
                        @endif>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_color">Product Color</label>
                        <input type="text" class="form-control" id="product_color" name="product_color" placeholder="insert product color" 
                        @if (!empty($productData['product_color']))
                            value="{{$productData['product_color']}}"
                        @else
                            value="{{old('product_color')}}"
                        @endif>
                    </div>
                    <div class="form-group">
                        <label for="product_price">Product Price</label>
                        <input type="text" class="form-control" id="product_price" name="product_price" placeholder="insert product price" 
                        @if (!empty($productData['product_price']))
                            value="{{$productData['product_price']}}"
                        @else
                            value="{{old('product_price')}}"
                        @endif>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_weight">Product Weight</label>
                        <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="insert product wight" 
                        @if (!empty($productData['product_weight']))
                            value="{{$productData['product_weight']}}"
                        @else
                            value="{{old('product_weight')}}"
                        @endif>
                    </div>
                    <div class="form-group">
                        <label for="main_image">Main Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="main_image" name="main_image">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        <p>Recommended image size : 1000 x 1000 px</p>
                        @if (!empty($productData['main_image']))
                        <div class="row">
                            <div class="col-sm-4 text-center">
                            <img src="{{asset('images/product_images/small/' .$productData['main_image'])}}" class="mb-2"
                            style="width: 150px; height: 150px;"/> <br>
                            <a href="javascript:void(0)" record="product-image" recordid="{{$productData['id']}}"
                                class="btn btn-sm btn-danger rounded confirmDelete">delete image
                            </a>
                            </div>
                        </div>   
                        @endif
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="product_video">Product Video</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="product_video" name="product_video">
                            <label class="custom-file-label" for="product_video">Choose file</label>
                        </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                            </div>
                        </div>
                        @if (!empty($productData['product_video']))
                            <div class="mt-2">
                                <a href="{{url('videos/product_videos/' . $productData['product_video'])}}" 
                                class="btn btn-sm btn-primary" download="">Download</a>
                                <a href="javascript:void(0)" record="product-video" recordid="{{$productData['id']}}"
                                class="btn btn-sm btn-danger rounded confirmDelete">delete video
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="wash_care">Wash Care</label>
                        <textarea class="form-control" rows="3" id="wash_care" name="wash_care" placeholder="Enter ...">
                        @if (!empty($productData['wash_care']))
                            {{$productData['wash_care']}}
                        @else
                            {{ old('wash_care')}}
                        @endif
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter ...">
                        @if (!empty($productData['description']))
                            {{$productData['description']}}
                        @else
                            {{ old('description')}}
                        @endif
                        </textarea>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="product_discount">Product Discount(%)</label>
                        <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="insert product discount" 
                        @if (!empty($productData['product_discount']))
                            value="{{$productData['product_discount']}}"
                        @else
                            value="{{old('product_discount')}}"
                        @endif>
                    </div>
                    <div class="form-group">
                        <label for="fabric">Select Fabric</label>
                        <select name="fabric" id="fabric" class="form-control select2" style="width: 100%;">
                          <option value="">select</option>
                          @foreach ($fabricArray as $fabric)
                              <option value="{{$fabric}}"
                              @if (!empty($productData['fabric'])  && $productData['fabric']==$fabric)
                              selected=""
                              @endif>
                              {{$fabric}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sleeve">Select Sleeve</label>
                        <select name="sleeve" id="sleeve" class="form-control select2" style="width: 100%;">
                          <option value="">select</option>
                          @foreach ($sleeveArray as $sleeve)
                              <option value="{{$sleeve}}" 
                              @if (!empty($productData['sleeve'])  && $productData['sleeve']==$sleeve)
                              selected=""
                              @endif>{{$sleeve}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fit">Select Fit</label>
                        <select name="fit" id="fit" class="form-control select2" style="width: 100%;">
                          <option value="">select</option>
                          @foreach ($fitArray as $fit)
                              <option value="{{$fit}}" 
                              @if (!empty($productData['fit'])  && $productData['fit']==$fit)
                              selected=""
                              @endif>{{$fit}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <textarea class="form-control" id="meta_title" name="meta_title" rows="3" placeholder="Enter...">
                        @if (!empty($productData['meta_title']))
                            {{$productData['meta_title']}}
                        @else
                            {{ old('meta_title')}}
                        @endif
                        </textarea>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="pattren">Select Pattern</label>
                        <select name="pattren" id="pattren" class="form-control select2" style="width: 100%;">
                          <option value="">select</option>
                          @foreach ($patternArray as $pattren)
                              <option value="{{$pattren}}" 
                              @if (!empty($productData['pattren'])  && $productData['pattren']==$pattren)
                              selected=""
                              @endif>{{$pattren}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="occassion">Select Occasion</label>
                        <select name="occassion" id="occassion" class="form-control select2" style="width: 100%;">
                          <option value="">select</option>
                          @foreach ($occassionArray as $occassion)
                              <option value="{{$occassion}}" 
                              @if (!empty($productData['occassion'])  && $productData['occassion']==$occassion)
                              selected=""
                              @endif>{{$occassion}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter ...">
                        @if (!empty($productData['meta_description']))
                            {{$productData['meta_description']}}
                        @else
                            {{ old('meta_description')}}
                        @endif
                        </textarea>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keyword</label>
                        <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter ...">
                        @if (!empty($productData['meta_keywords']))
                            {{$productData['meta_keywords']}}
                        @else
                            {{ old('meta_keywords')}}
                        @endif  
                        </textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">  
                  <div class="form-group">
                    <input class="form-group" type="checkbox" value="yes" id="is_featured" name="is_featured"
                    @if (!empty($productData['is_featured'])  && $productData['is_featured']== "yes")
                        checked=""
                    @endif>
                    <label class="form-check-label" for="is_featured">
                        Featured
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">submit</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
@endsection