@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">{{$post->title}}</h4>
                    </div>
                    <div class="card-body">
                        {{$post->description}}
                        <hr>
                        <div class="">
                            <a href="{{route('post.index')}}" class="btn btn-primary">
                                All Posts
                            </a>
                            <a href="{{route('post.create')}}" class="btn btn-outline-primary">
                                Create Post
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
