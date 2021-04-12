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
              <li class="breadcrumb-item active">DataTables</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sections</h3>
                <a href="{{ url('admin/add-edit-section')}}" style="max-width: 150px; display: inline-block; float: right;" 
                class="btn btn-primary">Add Section</a>
              </div>
              @if (Session::has('success_message'))
              <div class="alert alert-info alert-dismissable fade show" style="margin-top: 10px;">
                {{Session::get('success_message')}}
                <button type="buttob" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
               @endif
              <div class="col-md-12">
                
              </div>
              <div class="card-body">
                <table id="sections" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($sections as $section)
                    <tr>
                        <td>{{$section->id}}</td>
                        <td>{{$section->name}}</td>
                        <td>
                            @if ($section->status == 1)
                                <a class="updateSectionStatus" id="section-{{ $section->id }}" section_id="{{ $section->id }}" 
                                  href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true"  status="Active"></i></a>
                            @else
                                <a class="updateSectionStatus" id="section-{{ $section->id }}" section_id="{{ $section->id }}" 
                                  href="javascript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true"  status="Inactive"></i></a>
                            @endif 
                        </td>
                        <td>
                          <a title="Edit Product" href="{{url('admin/add-edit-section/' .$section->id)}}" style="color: black;">
                            <i class="far fa-edit"></i>
                          </a>
                          &nbsp;&nbsp;
                          <a title="Delete Product" href="javascript:void(0)" class="confirmDelete" 
                            record="section" recordid="{{$section->id}}" style="color: black;">
                            <i class="far fa-trash-alt"></i>
                          </a>
                        </td>
                    </tr>
                  @endforeach
                  </tfoot>
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