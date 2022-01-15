@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Category List</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{route('category.create')}}" class="btn btn-primary mb-3">Create Category</a>
                        @if(session('status'))
                            <p class="alert alert-success">{{session('status')}}</p>
                        @endif
                        <table class="table table-hover table-bordered align-middle">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Owner</th>
                                <th>Photo</th>
                                <th>Control</th>
                                <th>Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->title}}</td>
                                    <td>{{$category->user->name ?? 'unknown'}}</td>
                                    <td>
                                        @forelse($category->photos()->latest('id')->limit(3)->get() as $photo)
                                            <a class="venobox list-thumbnail" data-gall="img{{$category->id}}" href="{{asset('storage/photo/'.$photo->name)}}">
                                                <img src="{{asset('storage/thumbnail/'.$photo->name)}}" height="30" class="rounded-circle border border-white shadow-sm" alt="image alt"/>
                                            </a>
                                        @empty
                                            No Photo
                                        @endforelse
                                    </td>
                                    <td>
                                        <form action="{{route('category.destroy',$category->id)}}" class="d-inline-block" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>
                                        </form>
                                        <a href="{{route('category.edit',$category->id)}}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-pencil-alt fa-fw"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar"></i>
                                        {{$category->created_at->format("d-m-Y")}}
                                        <br>
                                        <i class="fas fa-clock"></i>
                                        {{$category->created_at->format("h:i a")}}
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">There is no Category</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
