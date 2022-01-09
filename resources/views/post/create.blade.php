@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Create Post</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="mb-3">
                                    <label for="title">Post Title</label>
                                    <input type="text" id="title" value="{{old('title')}}" name="title" class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                    <p class="text-danger small">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <select id="category" name="category" class="form-select @error('category') is-invalid @enderror">
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{$category->id}}" {{old('category') == $category->id ? 'selected' : ''}}>{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <p class="text-danger small">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="photo">Post Image</label>
                                    <input type="file" id="photo" value="{{old('photo')}}" name="photo[]" multiple class="form-control @error('photo') is-invalid @enderror">
                                    @error('photo')
                                    <p class="text-danger small">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description">Post Title</label>
                                    <textarea type="text" id="description" rows="10" name="description" class="form-control @error('description') is-invalid @enderror">
                                        {{old('description')}}
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
                                    <button class="btn btn-primary">Create Post</button>
                                </div>
                        </form>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
