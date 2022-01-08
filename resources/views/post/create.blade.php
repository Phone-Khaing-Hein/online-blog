@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Create Post</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('post.store')}}" method="post">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-6 col-lg-3">
                                    <label for="title">Post Title</label>
                                    <input type="text" id="title" value="{{old('title')}}" name="title" class="form-control @error('title') is-invalid @enderror">
                                </div>
                                <div class="col-6 col-lg-3">
                                    <label for="title"></label>
                                    <input type="text" id="title" value="{{old('title')}}" name="title" class="form-control @error('title') is-invalid @enderror">
                                </div>
                                <div class="col-6 col-lg-3">
                                    <label for="title">Post Title</label>
                                    <input type="text" id="title" value="{{old('title')}}" name="title" class="form-control @error('title') is-invalid @enderror">
                                </div>
                                <div class="col-6 col-lg-3">
                                    <button class="btn btn-primary">Add Category</button>
                                </div>
                                @error('title')
                                <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
