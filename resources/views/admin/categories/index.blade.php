@extends('layouts.app')

@section('title', 'Admin: Categories')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
@section('content')

<div class="container">
  <div class="row">
    <div class="col-9 text-center">
      <!-- Form -->
      <div class="mb-3">
        <form action="{{route('admin.categories.store')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col">
              <input type="text" name="name" class="form-control" placeholder="Add a category..." max="50" required autofocus>
            </div>
            <div class="col-auto">
              <button type="submit" name="btn_add" class="btn btn-primary w-100 fw-bold">
                  <i class="fa-solid fa-plus"></i> Add
              </button>
            </div>
          </div>
        </form>
      </div>
        <!-- Table -->
        <table class="table table-hover align-middle bg-white border">
          <thead class="small table-warning text-secondary">
            <tr>
              <th>#</th>
              <th>NAME</th>
              <th>COUNT</th>
              <th>LAST UPDATE</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($all_categories as $category)
            <tr>
              <td>{{$category->id}}</td>
              <td>{{$category->name}}</td>
              <td>{{$categoryCounts[$category->id]}}</td>
              <td>{{$category->updated_at}}</td>
              <td>
                <div>
                  <!-- Edit Button -->
                  <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-category-{{$category->id}}">
                    <i class="fa-solid fa-pen"></i>
                  </button>
                  <!-- Delete Button -->
                  <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-category-{{$category->id}}">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                  @include('admin.categories.modal.status')
                </div>
              </td>
            </tr>
          @endforeach
            <tr>
              <td></td>
              <td>Uncategorized <p class="text-secondary small">Hidden posts are not included.</p></td>
              <td>{{$uncategorizedCount}}</td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
    </div>
  </div>
</div>
  

@endsection