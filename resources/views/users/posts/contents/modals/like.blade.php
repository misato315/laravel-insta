{{-- Like Modal --}}
<div class="modal fade" id="likeModal{{ $post->id }}" tabindex="-1" aria-labelledby="likeModalLabel{{ $post->id }}" aria-hidden="true" data-bs-backdrop="false">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-center" id="likeModalLabel{{ $post->id }}">Likes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
        {{-- 検索欄 --}}
        <div class="col">
          @auth
            <ul class="navbar-nav ms-auto">
                <form action="{{route('search')}}" style="width:300px;">
                    <input type="search" name="search" class="form-control form-control-sm " placeholder="Search...">
                </form>                
            </ul>
            @endauth
        </div>
        
        {{-- ユーザー表示 --}}
        <div class="row">
          <div class="col">
            @foreach ($post->likes as $like)
              <div class="row align-items-center mt-3">

                <div class="col-auto">
                  <a href="{{route('profile.show',$like->user->id)}}">
                    @if ($like->user->avatar)
                      <img src="{{$like->user->avatar}}" alt="{{$like->user->name}}" class="rounded-circle avatar-sm">                    
                    @else
                      <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                    @endif
                  </a>
                </div>

                <div class="col ps-0 text-truncate">
                  <a href="{{route('profile.show',$like->user->id)}}" class="text-decoration-none text-dark fw-bold">{{$like->user->name}}</a>
                </div>
                <div class="col-auto text-center">
                @if ($like->user->id != Auth::user()->id)
                  <div class="d-flex justify-content-end">
                    @if ($like->user->isFollowed())
                    <form class="d-inline-block" action="{{route('follow.destroy',$like->user->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="border-0 bg-transparent text-secondary btn-sm">Following</button>
                    </form>
                    @else
                      <form class="d-inline-block" action="{{route('follow.store',$like->user->id)}}" method="post">
                        @csrf
                        <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                      </form>
                    @endif   
                  </div>
                                
                @endif
                </div>
              </div>
            @endforeach
          </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>