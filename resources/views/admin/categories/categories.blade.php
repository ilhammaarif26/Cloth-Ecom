@extends('layouts.admin_layout.admin_layout')
  
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sections</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cetegories</li>
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
                <h3 class="card-title">Categories</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="categories" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Parent Category</th>
                    <th>Section</th>
                    <th>URL</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($categories as $category)
                  @if (!isset($category->parentcategory->category_name))
                      <?php $parent_category = "parent"; ?>
                  @else
                      <?php $parent_category = $category->parentcategory->category_name; ?>
                  @endif
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->category_name}}</td>
                        <td>{{$parent_category}}</td>
                        <td>{{$category->section->name}}</td>
                        <td>{{$category->url}}</td>
                        <td>
                            @if ($category->status == 1)
                                <a class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}" 
                                   href="javascript:void(0)">Active</a>
                            @else
                            <a class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}" 
                                href="javascript:void(0)">Inactive</a>
                            @endif 
                        </td>
                    </tr>
                  @endforeach
                
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <a href="{{ url('admin/add-edit-category')}}" style="max-width: 150px; display: inline-block;  float:right;" class="btn btn-primary">add category</a>
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