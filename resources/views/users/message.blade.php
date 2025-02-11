@extends('layouts.app')

@section('title', 'DM')

@section('content')
    <div class="container">

      @foreach ($messages as $message)
        <div>
          <p><strong>{{$message->sender->name}}</strong>{{$message->message}}</p>
          <small></small>
        </div>
        
      @endforeach

      <form action="#" method="post">
        @csrf
        <div class="inpu-group">
          <textarea name="message" id="receiver_id" cols="30" rows="1" class="form-control form-control-sm" placeholder="Message..."></textarea>
          <button type="submit" class="btn btn-outline-secondary btn-sm" title="Send">
            <i class="fa-regular fa-paper-plane"></i>
          </button>
        </div>
      </form>
    </div>
@endsection