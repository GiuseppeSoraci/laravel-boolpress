@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>OUR POSTS</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        <a class="btn btn-success" href="{{ route('admin.posts.show', $post->id) }}">SHOW</a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->id) }}">
                            EDIT
                        </a>
                    </td>
                    <td><form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input type="submit" class="btn btn-danger" value="DELETE"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
