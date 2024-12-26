@extends('layouts.app')

@section('title', 'Suggested Users')

@section('content')
    
<div class="row justify-content-center">
  <div class="col-5">
    <p class="h5 text-muted mb-4">Suggested</span></p>
    @foreach ($suggested_users as $user)
        <div class="row align-items-center mb-3">
            <div class="col-auto d-flex  align-items-center">
                <a href="{{route('profile.show',$user->id)}}">
                    @if ($user->avatar)
                        <img src="{{$user->avatar}}" alt="{{$user->name}}" class="rounded-circle avatar-sm">         
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                    @endif
                </a>
            </div>
            <div class="col ps-0 text-truncate">
                <a href="{{route('profile.show',$user->id)}}" class="text-decoration-none text-dark fw-bold">{{$user->name}}</a>
                <p class="text-muted">{{$user->email}}</p>
                <p class="text-muted"> 
                    {{-- Suggested user がログインユーザーをフォローしているかどうかを確認 --}}
                    @if ($user->isFollowing()) 
                        Follows You
                    @elseif ($user->followers->count() > 0)
                        <strong>{{ $user->followers->count() }}</strong> 
                        {{ $user->followers->count() == 1 ? "follower" : "followers" }}
                    @else
                        No Followers
                    @endif      
                </p>
            </div>
            <div class="col-auto">
                <form action="#" method="post">
                    @csrf
                    <button type="submit" class="border-0 bg-transparent text-primary p-0 btn-sm">Follow</button>
                </form>
            </div>
        </div>
        
    @endforeach
  </div>
</div>
@endsection