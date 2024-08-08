@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img
                                src="{{ $product->images->isNotEmpty() ? Storage::url($product->images->first()->path) : asset('path/to/default-image.jpg') }}"
                                class="card-img-top img-fluid" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
