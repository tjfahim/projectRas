@extends('admin.layouts.master')

@section('main_content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{ isset($post) && $post->id ? 'Post Edit' : 'Post Create' }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ isset($post) && $post->id ? route('post.process', ['id' => $post->id]) : route('post.process') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($post) && $post->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Post Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Post Title" value="{{ isset($post) ? $post->title : old('title') }}" name="title">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image" id="imageInput" onchange="previewImage()">
                                        @if(isset($post) && $post->image)
                                            <img src="{{ asset('image/' . $post->image) }}" alt="{{ $post->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="imagePreview" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @if(isset($post) && $post->id)

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="active" @if($post->status == 'active') selected @endif>Active</option>
                <option value="inactive" @if($post->status == 'inactive') selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($post) && $post->id ? 'Update' : 'Add Post' }}
                            </button>
                            <div class="clearfix"></div>
                        </form>
                        
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>

<script>
    function previewImage() {
        var input = document.getElementById('imageInput');
        var preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


@endsection
