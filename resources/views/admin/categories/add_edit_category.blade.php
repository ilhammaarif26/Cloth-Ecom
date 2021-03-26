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
              <li class="breadcrumb-item active">Categories</li>
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
        <form name="categoryForm" id="CategoryForm" action="{{url('admin/add-edit-category')}}" method="POST"
        enctype="multipart/form-data">
        @csrf
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Add Category</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="category_name">Category Name</label>
                      <input type="text" class="form-control" id="category_name" name="category_name" placeholder="insert category name">
                  </div>
                  <div id="appendCategoriesLevel">
                    @include('admin.categories.append_categories_level')
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Select Section</label>
                    <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                      <option value="">select</option>
                      @foreach ($getSections as $section)
                          <option value="{{$section->id}}">{{$section->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="category_image">Category Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="category_image" name="category_image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="category_discount">Category Discount</label>
                    <input type="text" class="form-control" id="category_discount" placeholder="insert category discount" 
                    name="category_discount">
                  </div>
                  <div class="form-group">
                    <label for="category_url">Category Description</label>
                    <textarea class="form-control" rows="3" name="description" placeholder="Enter ..."></textarea>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="category_url">Category URL</label>
                    <input type="text" class="form-control" id="category_url" name="url" placeholder="insert category url">
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Meta Title</label>
                    <textarea class="form-control" id="meta_description" name="meta_title" rows="3" placeholder="Enter ..."></textarea>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="category_url">Meta Description</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter ..."></textarea>
                  </div>
                </div>
                <div class="col-12 col-sm-6">  
                  <div class="form-group">
                    <label for="meta_description">Meta Keywords</label>
                    <textarea class="form-control" id="meta_description" name="meta_keyword" rows="3" placeholder="Enter ..."></textarea>
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