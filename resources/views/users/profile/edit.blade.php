@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="row justify-content-center">
      {{-- プロフィール編集 --}}
      <div class="col-8 mb-4">
        <form action="{{route('profile.update',['id' => $user->id])}}" method="post" class="bg-white shadow rounded-3 p-5" enctype="multipart/form-data">
          @csrf
          @method('PATCH')

          <h2 class="mb-3 fw-light text-muted">Update Profile</h2>

          <div class="row mb-3">
            <div class="col-4">
              @if ($user->avatar)
                <img src="{{$user->avatar}}" alt="{{$user->name}}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
              @else
                <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
              @endif
            </div>
            <div class="col-auto align-self-end">
              <input type="file" name="avatar" id="avatar" class="form-control form-control-sm mt-1" aria-describedby="avatar-info">
              <div id="avatar" class="form-text">
                Acceptable formats:jpeg, jpg, png, gif only <br>
                Max file size is 1048kB
              </div>
              {{-- Error --}}
              @error('avatar')
              <div class="text-danger small">{{ $message }}</div> 
              @enderror
            </div>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label fw-bold">Name</label>
            <input type="text" name="name" id="name" value="{{old('name',$user->name)}}" class="form-control">
            {{-- Error --}}
            @error('name')
              <div class="text-danger small">{{ $message }}</div> 
              @enderror
          </div>
          <div class="mb-3">
            <label for="email" class="form-label fw-bold">E-mail Address</label>
            <input type="email" name="email" id="email" class="form-control" value="{{old('email',$user->email)}}">
            {{-- Error --}}
            @error('email')
              <div class="text-danger small">{{ $message }}</div> 
              @enderror
          </div>
          <div class="mb-3">
            <label for="introduction" class="form-label fw-bold">Introduction</label>
            <textarea name="introduction" id="introduction" rows="5" placeholder="Describe yourself" class="form-control">{{old('introduction',$user->introduction)}}</textarea>
          </div>

          <button type="submit" class="btn btn-warning px-5">Save</button>
        </form>
      </div>

      {{-- パスワード変更 --}}
      <div class="col-8">
        <form action="{{route('password.update',['id' => $user->id])}}" method="post" class="pg-white shadow rounded-3 p-5">
          @csrf
          @method('PATCH')

          <h2 class="mb-3 fw-light text-muted">Update Password</h2>

          <div class="mb-3">
            <label for="password" class="form-label fw-bold">Current Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password"">
            {{-- Error --}}
            @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password_new" class="form-label fw-bold">New Password</label>
            <input type="password" name="password_new" id="password_new" class="form-control @error('password_new') is-invalid @enderror" required autocomplete="new-password">
            <div id="password_new" class="form-text">
              Your password must be at least 8 characters long, and containletters and numbers.
            </div>
            {{-- Error --}}
            @error('password_new')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password_new_confirmation" class="form-label fw-bold">Confirm Password</label>
            <input type="password" name="password_new_confirmation" id="password_new_confirmation" class="form-control" required autocomplete="new-password">
        
          </div>

          <button type="submit" class="btn btn-warning px-5">Update Password</button>
        </form>
      </div>
    </div>
@endsection