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
        @if (Session::has('success_message'))
        <div class="alert alert-info alert-dismissable fade show" style="margin-top: 10px;">
          {{Session::get('success_message')}}
          <button type="buttob" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <form name="brandForm" id="brandForm" @if (empty($brandData['id']))
            action="{{url('admin/add-edit-brand')}}"
        @else
            action="{{url('admin/add-edit-brand/' .$brandData['id'])}}"
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
                      <label for="name">Brand Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="insert category name" 
                      @if (!empty($brandData['name']))
                          value="{{$brandData['name']}}"
                      @else
                          value="{{old('category_name')}}"
                      @endif>
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