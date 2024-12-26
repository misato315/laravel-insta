@extends('layouts.app')

@section('title', 'Admin: Posts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

@section('content')



    <table class="table table-hover align-middle bg-white border text-primary text-center">
      <thead class="small table-primary text-secondary">
        <tr class="">
          <th></th>
          <th></th>
          <th>CATEGORY</th>
          <th>OWNER</th>
          <th>CREATED AT</th>
          <th>STATUS</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($all_posts as $post)
          <tr>
            <td>{{$post->id}}</td>
            <td><img src="{{$post->image}}" alt="post id {{$post->id}}" class="image-sm"></td>
            <td>
              @forelse ($post->categoryPost as $category_post)
                <div class="badge bg-secondary bg-opacity-50">
                  {{$category_post->category->name}}
                </div> 
              @empty
                <div class="badge bg-dark bg-opacity-50">
                  Uncategorized
                </div>
              @endforelse
              
              {{-- @if($post->categoryPost->isEmpty())
                <div class="badge bg-dark bg-opacity-50">
                  Uncategorized
                </div>   
              @else
                @foreach ($post->categoryPost as $category_post)
                  <div class="badge bg-secondary bg-opacity-50">
                    {{$category_post->category->name}}
                  </div>   
                @endforeach
              @endif --}}
              
            </td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->created_at}}</td>
            <td>
              @if ($post->trashed())
                <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Unvisible
              @else
                <i class="fa-solid fa-circle text-primary"></i>&nbsp; Visible
              @endif
            </td>
            <td>
                <div class="dropdown">
                  <button class="btn btn-sm" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                  </button>
                  <div class="dropdown-menu">
                    @if ($post->trashed())
                      <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#visible-post-{{$post->id}}">
                        <i class="fa-solid fa-eye"></i> Hidden Post
                      </button>
                    @else
                      <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#unvisible-post-{{$post->id}}">
                        <i class="fa-solid fa-eye-slash"></i> Hide Post
                      </button>
                    @endif
                  </div>
                </div>
                {{-- Include the modal here --}}
                @include('admin.posts.modal.status')
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  {{-- 下記linksを追加！！ --}}
  {{$all_posts->links()}}
@endsection