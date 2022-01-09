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
                        <form action="{{route('post.update',$post->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="title">Post Title</label>
                                <input type="text" id="title" value="{{old('title',$post->title)}}" name="title" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category">Category</label>
                                <select id="category" name="category" class="form-select @error('category') is-invalid @enderror">
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option value="{{$category->id}}" {{old('category',$post->category_id) == $category->id ? 'selected' : ''}}>{{$category->title}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description">Post Title</label>
                                <textarea type="text" id="description" rows="10" name="description" class="form-control @error('description') is-invalid @enderror">
                                        {{old('description',$post->description)}}
                                    </textarea>
                                @error('description')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" required>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Confirm</label>
                                </div>
                                <button class="btn btn-primary">Update Post</button>
                            </div>
                        </form>
                        <hr>
                        <form action="{{route('photo.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="photo">Post Image</label>
                                <input type="file" id="photo" value="{{old('photo')}}" name="photo[]" multiple class="form-control @error('photo') is-invalid @enderror">
                                @error('photo')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <button class="btn btn-primary">Upload new photo</button>
                        </form>
                        @forelse($post->photos as $photo)
                            <img src="{{asset('storage/photo/'.$photo->name)}}" height="100" alt="" class="d-block">
                            <form action="{{route('photo.destroy',$photo->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm img-del-btn">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        @empty
                            No Photo
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
