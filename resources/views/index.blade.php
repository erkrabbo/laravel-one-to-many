@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center g-4">
        @foreach ($posts as $post)
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header @auth d-flex justify-content-between @endauth" id = "post-card-js" data-postid = "{{ $post->slug }}">
                        <h2>{{ $post->title }}</h2>
                        @auth
                        @if(Auth::user()->id == $post->user->id)
                            <div class="d-flex justify-content-end align-items-center">
                                <a href="{{route('post.edit', $post )}}" class="btn btn-warning btn-sm mx-2">EDIT</a>
                                <button id="modalToggler" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    &cross;
                                </button>
                                {{-- <button type="button" class="btn btn-danger btn-sm" id="modalToggler">
                                    &cross;
                                </button> --}}
                            </div>
                            <!-- Modal -->

                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Are you sure?</h5>
                                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <form method="POST" id = "form-delete-js" data-base="{{ route('post.destroy', '*****') }}" >
                                        @csrf
                                        @method('DELETE')
                                        <button id="confirm-delete-js" type="submit" class="btn btn-primary">YES</button>
                                    </form>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            @endif
                        @endauth
                    </div>

                    <div class="card-body">
                        <p>{{ $post->content }}</p>
                    </div>
                    <a href="{{ route('post.show', $post) }}" class="btn btn-primary">See more</a>
                </div>
            </div>
        @endforeach

        {{ $posts->onEachSide(0)->links() }}
    </div>
</div>
@endsection
