@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('category.update',$category->id)}}" method="post" class="mb-3">
                            @csrf
                            @method('put')
                            <div class="row align-items-end">
                                <div class="col-6 col-lg-3">
                                    <label for="title">Category Title</label>
                                    <input type="text" id="title" value="{{$category->title}}" name="title" class="form-control @error('title') is-invalid @enderror">

                                </div>
                                <div class="col-6 col-lg-3">
                                    <button class="btn btn-primary">Update Category</button>
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
