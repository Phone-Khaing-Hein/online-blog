@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Post List</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="">
                                <a href="{{route('post.create')}}" class="btn btn-primary">
                                    Create Post
                                </a>
                                @isset(request()->search)
                                    <a href="{{route('post.index')}}" class="btn btn-outline-primary">
                                        All Posts
                                    </a>
                                    <h5 class="d-inline-block ms-2 fw-bold">Search By: '{{request()->search}}'</h5>
                                @endisset
                            </div>
                            <form class="w-25" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{request()->search}}" placeholder="Search Something" name="search">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-search fa-fw"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <table class="table table-hover align-middle">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="w-25">Title</th>
                                <th>Photo</th>
                                <th>Is Publish</th>
                                <th>Category</th>
                                <th>Owner</th>
                                <th>Control</th>
                                <th>Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td class="w-25 small">{{Str::words($post->title,10,'...')}}</td>
                                    <td>
                                        @forelse($post->photos()->latest('id')->limit(3)->get() as $photo)
                                            <a class="venobox list-thumbnail" data-gall="img{{$post->id}}" href="{{asset('storage/photo/'.$photo->name)}}">
                                                <img src="{{asset('storage/thumbnail/'.$photo->name)}}" height="30" class="rounded-circle border border-white shadow-sm" alt="image alt"/>
                                            </a>
                                        @empty
                                            No Photo
                                        @endforelse
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{$post->is_publish ? 'checked' : ''}}>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                                {{$post->is_publish ? 'Publish' : 'Unpublish'}}
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">{{$post->category->title ?? 'Unknown Category'}}</td>
                                    <td class="text-nowrap">{{$post->user->name ?? 'Unknown User'}}</td>
                                    <td class="text-nowrap">
                                        <div class="btn-group">
                                            <a href="{{route('post.show',$post->id)}}" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-info-circle fa-fw"></i>
                                            </a>
                                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-danger" form="deleteBtn{{$post->id}}">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>
                                        </div>
                                        <form action="{{route('post.destroy',$post->id)}}" id="deleteBtn{{$post->id}}" class="d-inline-block" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                    <td class="text-nowrap">
                                        <i class="fas fa-calendar"></i>
                                        {{$post->created_at->format("d-m-Y")}}
                                        <br>
                                        <i class="fas fa-clock"></i>
                                        {{$post->created_at->format("h:i a")}}
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">There is no Post</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            {{$posts->appends(request()->all())->links()}}
                            <p class="fw-bold mb-0 h4">Total Post : {{$posts->total()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
