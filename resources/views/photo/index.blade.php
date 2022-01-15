@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">My Photo List</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex gap-2 flex-wrap">
                            @forelse($photos as $photo)
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
                </div>
            </div>
        </div>
    </div>
@endsection
