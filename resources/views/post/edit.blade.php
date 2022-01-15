@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Post</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('post.update',$post->id)}}" method="post" id="editForm">
                            @csrf
                            @method('put')
                        </form>

                        <div class="mb-3">
                            <label for="title">Post Title</label>
                            <input type="text" id="title" form="editForm" value="{{old('title',$post->title)}}" name="title" class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select id="category" name="category" form="editForm" class="form-select @error('category') is-invalid @enderror">
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{$category->id}}" {{old('category',$post->category_id) == $category->id ? 'selected' : ''}}>{{$category->title}}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Tag</label>
                            <br>
                            @foreach(\App\Models\Tag::all() as $tag)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" form="editForm" type="checkbox" value="{{$tag->id}}" name="tags[]" id="flexCheckDefault{{$tag->id}}" {{in_array($tag->id,old('tags',$post->tags->pluck('id')->toArray())) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="flexCheckDefault{{$tag->id}}">
                                        {{$tag->title}}
                                    </label>
                                </div>
                            @endforeach
                            @error('tags')
                            <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-0">Photo</label>
                            <div class="border rounded d-flex gap-1 overflow-scroll p-3">
                                    <form action="{{route('photo.store')}}" method="post" enctype="multipart/form-data" class="mb-3 d-none" id="photoUploadForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Post Image</label>
                                            <input type="hidden" name="post_id" value="{{$post->id}}">
                                            <input type="file" id="photoInput" value="{{old('photo')}}" name="photo[]" class="form-control @error('photo') is-invalid @enderror" multiple>
                                            @error('photo')
                                            <p class="text-danger small">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary">Upload new photo</button>
                                    </form>

                                    <div class="photo-uploader-ui p-3 rounded d-flex justify-content-center align-items-center" id="photoUploaderUi">
                                        <i class="fas fa-plus-circle fa-2x"></i>
                                    </div>

                                    @forelse($post->photos as $photo)
                                        <div class="position-relative">
                                            <form action="{{route('photo.destroy',$photo->id)}}" method="post" class="position-absolute bottom-0 start-0">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            <img src="{{asset('storage/photo/'.$photo->name)}}" height="100" alt="" class="rounded">
                                        </div>
                                    @empty
                                        No Photo
                                    @endforelse
                                </div>
                        </div>
                        <div class="mb-3">
                            <label for="description">Post Description</label>
                            <textarea rows="10" id="description" form="editForm" rows="10" name="description" class="form-control @error('description') is-invalid @enderror">{{old('description',$post->description)}}</textarea>
                            @error('description')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" form="editForm" type="checkbox" role="switch" id="flexSwitchCheckDefault" required>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Confirm</label>
                            </div>
                            <button class="btn btn-primary" form="editForm">Update Post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let photoUploaderUi = document.getElementById('photoUploaderUi');
        let photoInput = document.getElementById('photoInput');
        let photoUploadForm = document.getElementById('photoUploadForm');

        photoUploaderUi.addEventListener('click',function (){
            photoInput.click();
        })

        photoInput.addEventListener('change',function (){
            photoUploadForm.submit();
        })
    </script>
@endsection
