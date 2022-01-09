@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Create Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('category.store')}}" method="post" class="mb-3">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-6 col-lg-3">
                                    <label for="title">Category Title</label>
                                    <input type="text" id="title" value="{{old('title')}}" name="title" class="form-control @error('title') is-invalid @enderror">

                                </div>
                                <div class="col-6 col-lg-3">
                                    <button class="btn btn-primary">Create Category</button>
                                </div>
                                @error('title')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                        </form>

                        <table class="table table-hover table-bordered align-middle">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Owner</th>
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
                        <div class="text-center">
                            <a href="{{route('category.index')}}" class="btn btn-primary">All Category List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
