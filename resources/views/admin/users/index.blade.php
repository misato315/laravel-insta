@extends('layouts.app')

@section('title', 'Admin: Users')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

@section('content')

<div class="mb-3">
  <form action="#" style="width:300px;" class="ms-auto">
    <input type="search" name="search" class="form-control form-control-sm " placeholder="Search...">
  </form>

</div>

    <table class="table table-hover align-middle bg-white border text-secondary text-center">
      <thead class="small table-success text-secondary fw-bold">
        <tr>
          <th></th>
          <th>NAME</th>
          <th>EMAIL</th>
          <th>CREATED AT</th>
          <th>STATUS</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($all_users as $user)
          <tr>
            <td>
              @if ($user->avatar)
                <img src="{{$user->avatar}}" alt="{{$user->name}}" class="rounded-circle d-block mx-auto avatar-md">                
              @else
                <i class="fa-solid fa-circle-user d-block text-center icon-md"></i>
              @endif
            </td>
            <td>
              <a href="{{route('profile.show',$user->id)}}" class="text-decoration-none text-dark fw-bold">{{$user->name}}</a>
            </td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
            <td>
              @if ($user->trashed())
                <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Inactive
              @else
                <i class="fa-solid fa-circle text-success"></i>&nbsp; Active
              @endif
            </td>
            <td>
              @if (Auth::user()->id !== $user->id)
                <div class="dropdown">
                  <button class="btn btn-sm" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                  </button>

                  <div class="dropdown-menu">
                    @if ($user->trashed())
                      <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#activate-user-{{$user->id}}">
                        <i class="fa-solid fa-user-check"></i> Activate {{$user->name}}
                      </button>
                    @else
                      <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{$user->id}}">
                        <i class="fa-solid fa-user-slash"></i> Deactivate {{$user->name}}
                      </button>
                    @endif
                    
                  </div>
                </div>
                {{-- Include the modal here --}}
                @include('admin.users.modal.status')
              @endif
            </td>
          </tr>
          
        @endforeach
      </tbody>
    </table>
    {{-- 下記linksを追加！！ --}}
    {{$all_users->links()}}
@endsection