@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-image-container">
                            @if ($product->images->isNotEmpty())
                                <img src="{{ Storage::url($product->images->first()->path) }}" class="card-img-top"
                                     alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('path/to/default-image.jpg') }}" class="card-img-top"
                                     alt="{{ $product->name }}">
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Цена: {{ number_format($product->price, 2) }} руб.</p>
                        <p class="card-text">Скидка: {{ round($product->discount) }}%</p>

                        <div class="accordion mb-3" id="additionalFieldsAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                        Дополнительные характеристики
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                     aria-labelledby="headingOne" data-bs-parent="#additionalFieldsAccordion">
                                    <div class="accordion-body">
                                        @foreach ($product['additionalFields'] as $field)
                                            <p class="card-text"><strong>{{ $field['key'] }}
                                                    :</strong> {{ $field['value'] }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary">Купить</a>
                    </div>
                </div>
                <a href="{{ route('products.index') }}" class="btn btn-primary mb-4 btn-sm">Назад к списку</a>
            </div>
        </div>
    </div>
@endsection
