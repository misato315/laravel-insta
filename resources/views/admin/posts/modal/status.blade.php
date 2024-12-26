@if ($post -> trashed())
  {{-- Visible --}}
  <div class="modal fade" id="visible-post-{{$post->id}}">
    <div class="modal-dialog">
      <div class="modal-content border-primary">
        <div class="modal-header border-primary">
          <h3 class="h5 modal-title text-primary">
            <i class="fa-solid fa-eye"></i> Unhide Post
          </h3>
        </div>
        <div class="modal-body text-secondary">
          <div class="row">
            <p>Are you sure you want to unhide this post?</p>
          </div>
          <div class="row">
            <div class="col-5">
              <img src="{{$post->image}}" alt="post id {{$post->id}}" class="w-100  image-sm">
              <h5 class="mt-2">{{$post->description}}</h5>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <form action="{{route('admin.posts.visible',$post->id)}}" method="post">
            @csrf
            @method('PATCH')
            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-sm">Unhide</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@else
  {{-- Unvisible --}}
  <div class="modal fade" id="unvisible-post-{{$post->id}}">
    <div class="modal-dialog">
      <div class="modal-content border-danger">
        <div class="modal-header border-danger">
          <h3 class="h5 modal-title text-danger">
            <i class="fa-solid fa-eye-slash"></i> Hide Post
          </h3>
        </div>
        <div class="modal-body text-secondary">
          <div class="row mb-3">
            <p>Are you sure you want to hide this post?</p>
          </div>
          <div class="row">
            <div class="col-5">
              <img src="{{$post->image}}" alt="post id {{$post->id}}" class="w-100  image-sm">
              <h5 class="mt-2">{{$post->description}}</h5>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <form action="{{route('admin.posts.unvisible',$post->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger btn-sm">Hide</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endif



