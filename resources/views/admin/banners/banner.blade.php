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
              <li class="breadcrumb-item active">Banner</li>
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
                    <h3 class="card-title">{{$title}}</h3>
                  </div>
                  <div class="col-sm-6">
                    <a href="{{ url('admin/add-edit-banner')}}" style="max-width: 150px; display: inline-block; float: right;" 
                    class="btn btn-primary">Add Banner</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="categories" class="table table-bordered table-striped" >
                  <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Caption1</th>
                    <th>Caption2</th>
                    <th>Caption3</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <?php $number = 1; ?>
                  @foreach ($banners as $banner)
                    <tr>
                        <td>{{$number++}}</td>
                        <td>{{$banner['id']}}</td>
                        <td>
                            @if (!empty($banner['image']))
                              <img src="{{asset('images/banner_images/' .$banner['image'])}}" class="mt-2 mb-2"
                              style="width: 50px; height: 50px;"/>
                            @else
                              <img src="{{asset('images/category_images/no-image.png')}}" class="mt-2 mb-2"
                              style="width: 50px; height: 50px;"/>
                            @endif
                        </td>
                        <td>{{$banner['link']}}</td>
                        <td>{{$banner['title']}}</td>
                        <td>{{$banner['alt']}}</td>
                        <td>
                            @if ($banner['status'] == 1)
                                <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}" 
                                  href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true"  status="Active"></i></a>
                            @else
                                <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}" 
                                  href="javascript:void(0)" ><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                            @endif 
                        </td>
                        <td>
                          <a title="edit banner" href="{{url('admin/add-edit-banner/' .$banner['id'])}}" style="color: black"><i class="far fa-edit"></i></a>
                          &nbsp;&nbsp;
                          <a title="delete banner" href="javascript:void(0)" class="confirmDelete" 
                            record="banner" recordid="{{$banner['id']}}" style="color: black"><i class="far fa-trash-alt" ></i></a>
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