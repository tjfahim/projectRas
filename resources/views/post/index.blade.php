@extends('admin.layouts.master')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4 >Post Manage</h4>
        <a href="{{ route('post.create')}}" class="btn btn-primary">Add New Post</a>
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)

              <tr>
                <th scope="row">1</th>
                <td><h4 class="card-title">{{ $post->title }}</h4></td>
                <td>                            <img src="{{ asset('image/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100px; height: 100px">
                </td>
                <td>{{ $post->status }}</td>
                <td>
             
                        <a class="btn btn-primary" href="{{ route('post.edit', ['id' => $post->id]) }}">Edit</a>
                        <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post record?')">Delete</button>
                        </form>
                    
                </td>
              </tr>            @endforeach

              
            </tbody>
            {{ $posts->links('pagination::bootstrap-4') }}
          </table>
        
        
    </div>
</div>
@endsection
