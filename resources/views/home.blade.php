@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <x-alert type="success" />
                    <x-alert type="danger" message="hello" />
                    <x-alert>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consectetur doloribus eveniet, ex libero, maiores molestiae nihil officia rerum sint sunt voluptatum? Aspernatur autem dolor error in laboriosam vel voluptatibus.
                    </x-alert>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
