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
              <li class="breadcrumb-item active">Brands</li>
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
                    <a href="{{ url('admin/add-edit-brand')}}" style="max-width: 150px; display: inline-block; float: right;" 
                    class="btn btn-primary">Add Brand</a>
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
                    <th>Brand</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <?php $number = 1; ?>
                  @foreach ($brands as $brand)
                    <tr>
                        <td>{{$number++}}</td>
                        <td>{{$brand->id}}</td>
                        <td>{{$brand->name}}</td>
                        <td>
                            @if ($brand->status == 1)
                                <a class="updateBrandStatus" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" 
                                  href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true"  status="Active"></i></a>
                            @else
                                <a class="updateBrandStatus" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" 
                                  href="javascript:void(0)" ><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                            @endif 
                        </td>
                        <td>
                          <a title="edit brand" href="{{url('admin/add-edit-brand/' .$brand->id)}}" style="color: black"><i class="far fa-edit"></i></a>
                          &nbsp;&nbsp;
                          <a title="delete brand" href="javascript:void(0)" class="confirmDelete" 
                            record="brand" recordid="{{$brand->id}}" style="color: black"><i class="far fa-trash-alt" ></i></a>
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