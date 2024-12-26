<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

{{-- Clickable image --}}
<div class="container p-0">
  <a href="{{route('post.show',$post->id)}}">
    <img src="{{$post->image}}" alt="post id {{$post->id}}" class="w-100">
  </a>
</div>
<div class="card-body">
  {{-- いいねボタン + いいね数 + カテゴリー --}}
  <div class="row align-items-center">
    <div class="col-auto">
      @if ($post->isliked())
        <form action="{{route('like.destroy',$post->id)}}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn p-0">
            <i class="fa-solid fa-heart text-danger"></i>
          </button>
        </form>
      @else
        <form action="{{route('like.store',$post->id)}}" method="post">
          @csrf
          <button type="submit" class="btn shadow-none p-0">
            <i class="fa-regular fa-heart"></i>
          </button>
        </form>
      @endif
      
    </div>
    <div class="col-auto px-0">
      @if ($post->likes->count()>0)
        <span href="#" data-bs-toggle="modal" data-bs-target="#likeModal{{ $post->id }}" style="cursor: pointer;">{{$post->likes->count()}}</span>
      @endif
    </div>
    <div class="col-auto ">
      @forelse ($post->categoryPost as $category_post)
        <div class="badge bg-secondary bg-opacity-50">
          {{$category_post->category->name}}
        </div> 
      @empty
        <div class="badge bg-dark bg-opacity-50">
          Uncategorized
        </div>
      @endforelse
    </div>     
    {{-- BOOKMARK --}}
    <div class="col text-end">
      @if ($post->isBookmarked())
        <form action="{{route('bookmark.destroy',$post->id)}}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn p-0">
            <i class="fa-solid fa-bookmark"></i>
          </button>
        </form>
      @else
        <form action="{{route('bookmark.store',$post->id)}}" method="post">
          @csrf
          <button type="submit" class="btn shadow-none p-0">
            <i class="fa-regular fa-bookmark "></i>
          </button>
        </form>
      @endif
    </div>
  </div>
  {{-- Include the modal here --}}
  @include('users.posts.contents.modals.like', ['likedUsers' => $post->likes->pluck('user')])

  {{-- owner + description --}}
  <a href="{{route('profile.show',$post->user->id)}}" class="text-decoration-none text-dark fw-bold">{{$post->user->name}}</a>
  &nbsp;
  <p class="d-inline fw-light">{{$post->description}}</p>
  <p class="text-uppercase text-muted xsmall">{{date('M d, Y', strtotime($post->created_at))}}</p>

  @include('users.posts.contents.comments')


</div>

