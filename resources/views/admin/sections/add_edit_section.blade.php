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
              <li class="breadcrumb-item active">Section</li>
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
        <form name="sectionForm" id="sectionForm" @if (empty($sectionData['id']))
            action="{{url('admin/add-edit-section')}}"
        @else
            action="{{url('admin/add-edit-section/' .$sectionData['id'])}}"
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
                      <label for="section_name">Section Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="insert section name" 
                      @if (!empty($sectionData['name']))
                          value="{{$sectionData['name']}}"
                      @else
                          value="{{old('name')}}"
                      @endif>
                  </div>
                  <div class="form-group">
                    <label for="section_image">Section Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="section_image" name="section_image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                    @if (!empty($sectionData['section_image']))
                      <div class="row">
                        <div class="col-sm-4 text-center">
                          <img src="{{asset('images/section_images/' .$sectionData['section_image'])}}" class="mt-2 mb-2"
                          style="width: 150px; height: 150px;"/> <br>
                          <a href="javascript:void(0)" record="section-image" recordid="{{$sectionData['id']}}" 
                            <?php /*href="{{url('admin/delete-section-image/'.$sectionData['id'])}}" */ ?> 
                            class="btn btn-sm btn-danger rounded confirmDelete">delete image
                          </a>
                        </div>
                      </div>   
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">{{$button}}</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
@endsection