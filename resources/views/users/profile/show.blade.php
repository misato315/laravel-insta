@extends('layouts.app')

@section('title',$user->name )

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

@include('users.profile.header')


<div class="row mt-5">
  <hr>
  <div class="col ">
    <nav class="nav nav-underline justify-content-center mb-5" style="gap: 30px;">
      <a href="{{ route('profile.show', ['id' => $user->id, 'tab' => 'posts']) }}" class="nav-link {{ $tab === 'posts' ? 'active' : '' }} text-dark">
        <i class="fa fa-table-cells"></i> Posts
      </a>
      <a href="{{ route('profile.show', ['id' => $user->id, 'tab' => 'likes']) }}" class="nav-link {{ $tab === 'likes' ? 'active' : '' }} text-dark">
        <i class="fa-regular fa-heart"></i> Liked Posts
      </a>
      <a href="{{ route('profile.show', ['id' => $user->id, 'tab' => 'bookmarks']) }}" class="nav-link {{ $tab === 'bookmarks' ? 'active' : '' }} text-dark">
        <i class="fa-regular fa-bookmark"></i> Bookmarked Posts
      </a>
    </nav>


    <div>
      {{-- 投稿の表示 --}}
      @if ($tab === 'posts')
        <div class="row">
          @foreach ($posts as $post)
            <div class="col-lg-4 col-md-6 mb-4">
              <a href="{{ route('post.show', $post->id) }}">
                <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="grid-img">
              </a>
            </div>
          @endforeach
        </div>
        @if ($posts->isEmpty())
          <h3 class="text-muted text-center">No Posts yet</h3>
        @endif

      {{-- いいねした投稿の表示 --}}
      @elseif ($tab === 'likes')
        <div class="row">
          @foreach ($likedPosts as $post)
            <div class="col-lg-4 col-md-6 mb-4">
              <a href="{{ route('post.show', $post->id) }}">
                <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="grid-img">
              </a>
            </div>
          @endforeach
        </div>
          @if ($likedPosts->isEmpty())
            <h3 class="text-muted text-center">No Bookmarked Posts yet</h3>
          @endif

      {{-- ブックマークした投稿の表示 --}}
      @elseif ($tab === 'bookmarks')
        <div class="row">
          @foreach ($bookmarkedPosts as $post)
            <div class="col-lg-4 col-md-6 mb-4">
              <a href="{{ route('post.show', $post->id) }}">
                <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="grid-img">
              </a>
            </div>
          @endforeach
        </div>
          @if ($bookmarkedPosts->isEmpty())
            <h3 class="text-muted text-center">No Bookmarked Posts yet</h3>
          @endif
      @endif
    </div>
  </div>
</div>

@endsection