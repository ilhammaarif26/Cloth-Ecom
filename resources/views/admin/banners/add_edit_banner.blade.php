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
        <form name="categoryForm" id="CategoryForm" @if (empty($bannerData['id']))
            action="{{url('admin/add-edit-banner')}}"
        @else
            action="{{url('admin/add-edit-banner/' .$bannerData['id'])}}"
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
                    <label for="banner_image">Banner Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                    @if (!empty($bannerData['image']))
                      <div class="row">
                        <div class="col-sm-4 text-center">
                          <img src="{{asset('images/banner_images/' .$bannerData['image'])}}" class="mt-2 mb-2"
                          style="width: 250px;"/> <br>
                          <a href="javascript:void(0)" record="banner-image" recordid="{{$bannerData['id']}}"
                            class="btn btn-sm btn-danger rounded confirmDelete">delete image
                          </a>
                        </div>
                      </div>   
                    @endif
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="link">Caption1</label>
                      <input type="text" class="form-control" id="link" placeholder="insert category discount" name="link"
                      @if (!empty($bannerData['link']))
                          value="{{$bannerData['link']}}"
                      @else
                          value="{{ old('link')}}"
                      @endif>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="alt">Caption2</label>
                    <input type="text" class="form-control" id="alt" name="alt" placeholder="insert category url"
                    @if (!empty($bannerData['alt']))
                        value="{{$bannerData['alt']}}"
                    @else
                        value="{{ old('alt')}}"
                    @endif>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="title">Caption3</label>
                        <input type="text" class="form-control" id="title" placeholder="insert category discount" name="title"
                        @if (!empty($bannerData['title']))
                            value="{{$bannerData['title']}}"
                        @else
                            value="{{ old('title')}}"
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