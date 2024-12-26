@extends('layouts.app')

@section('title','Home')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<div class="row gx-5">
    <div class="col-8">
        @forelse ($all_posts as $post)
        
        <div class="card mb-4">
        {{-- title --}}
        @include('users.posts.contents.title')
        {{-- body --}}
        @include('users.posts.contents.body')
        </div>
            
        @empty
        <div class="text-center">
            <h2>Shere Photos</h2>
            <p class="text-secondary">When you share photos, they'll appear on your profile</p>
            <a href="{{route('post.create')}}" class="text-decoration-none">Shere your first photo</a>
        </div>
        @endforelse
        
    </div>
    <div class="col-4">
        <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
            <div class="col-auto">
                <a href="{{route('profile.show',Auth::user()->id)}}">
                    @if (Auth::user()->avatar)
                        <img src="{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}" class="rounded-circle avatar-md">
                    @else
                        <i class="fa-solid fa-circle-user text-sedondary icon-md"></i>
                    @endif
                </a>
            </div>
            <div class="col ps-0">
                <a href="{{route('profile.show',Auth::user()->id)}}" class="text-decoration-none text-dark fw-bold">{{Auth::user()->name}}</a>
                <p class="text-muted mb-0">{{Auth::user()->email}}</p>
            </div>
        </div>
        {{-- Suggestions --}}
        @if($suggested_users)
            <div class="row">
                <div class="col-auto">
                    <p class="fw-bold text-secondary">Suggestions For You</p>
                </div>
                
                <div class="col text-end">
                    @if ($suggested_users->count() >= 5)
                        <a href="{{route('suggested.users')}}" class="fw-bold text-dark text-decoration-none">See all</a>
                    @endif
                </div>
                @foreach ($limited_suggested_users as $user)
                    <div class="row align-item-center mb-3">
                        <div class="col-auto">
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
                        </div>
                        <div class="col-auto">
                            <form action="{{route('follow.store',$user->id)}}" method="post">
                                @csrf
                                <button type="submit" class="border-0 bg-transparent text-primary p-0 btn-sm">Follow</button>
                            </form>
                        </div>
                    </div>
                    
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection