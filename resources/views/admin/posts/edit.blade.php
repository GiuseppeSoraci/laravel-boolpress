@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">EDIT:
        <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>
    </h1>

    <div>
        <form action="{{ route('admin.posts.show', $post->id) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="mb-5">
                <label for="title" class="control-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            </div>

            <div class="mb-3">
                <label for="content" class="control-label">Content</label>
                <textarea class="form-control" id="content" name="content"
                    rows="6">{{ $post->content }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection

