@extends('layouts.app')
@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-8 order-md-2 col-lg-9">
                <div class="container-fluid">
                    <div class="row mb-5">
                        <div class="col-12 d-flex justify-content-between align-items-end">
                            <div class="d-flex flex-column">
                                <label class="">Sort by:</label>
                                <select id="sort-by-select" class="form-control">
                                    <option value="relevance">Relevance</option>
                                    <option value="price-descending">Price Descending</option>
                                    <option value="price-ascending">Price Ascending</option>
                                    <option value="best-selling">Best Selling</option>
                                </select>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-lg btn-light"> <span class="fa fa-arrow-left"></span> </button>
                                <button type="button" class="btn btn-lg btn-light"> <span class="fa fa-arrow-right"></span> </button>
                            </div>
                            <div class="mb-3 mt-3 mt-md-0 mb-md-0 d-flex flex-row justify-content-center align-items-center">
                                <select id="results-per-page-select" class="form-control float-right products-count">
                                    <option value="3">3</option>
                                    <option value="6">6</option>
                                    <option value="9">9</option>
                                    <option value="12">12</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row" id="products-wrapper" data-storepath="{{ asset('storage/') }}" data-defaultimage="{{ $defaultImage }}">
                        @foreach($products as $product)
                            <div class="col-6 col-md-6 col-lg-4 mb-3">
                                <div class="card h-100 border-0">
                                    <div class="card-img-top">
                                        @if(!is_null($product->image_path))
                                        <img src="{{ asset('storage/'. $product->image_path) }}" class="img-fluid mx-auto d-block" alt="Zdjęcie {{ $product->name }}">
                                        @else
                                        <img src="{{ $defaultImage }}" class="img-fluid mx-auto d-block" alt="Zdjęcie produktu">
                                        @endif
                                    </div>
                                    <div class="card-body text-center">
                                        <h4 class="card-title">
                                            {{ $product->name }}
                                        </h4>
                                        <h5 class="card-price small text-danger">
                                            <i>{{ $product->price }} zł</i>
                                        </h5>
                                    </div>
                                    <button class="btn btn-success btn-sm add-cart-button" data-id="{{ $product->id }}" @guest disabled @endguest>
                                        <i class="fa-solid fa-cart-plus"></i> Dodaj do koszyka
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row sorting mb-5 mt-5">
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn btn-light">Back to top</a>
                            <div class="dropdown float-md-right">
                                <select id="results-per-page-select" class="form-control float-right products-count">
                                    <option value="3">3</option>
                                    <option value="6">6</option>
                                    <option value="9">9</option>
                                    <option value="12">12</option>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="col-md-4 order-md-1 col-lg-3 sidebar-filter">
                <h3 class="mt-0 mb-5">{{ __('shop.welcome.products') }} <span class="text-danger">{{ count($products) }}</span></h3>
                <h6 class="text-uppercase font-weight-bold mb-3">{{ __('shop.welcome.categories') }}</h6>

                @foreach($categories as $category)
                <div class="mt-2 mb-2 pl-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="filter[categories][]" id="category-{{$category->id}}" value="{{$category->id}}">
                        <label class="custom-control-label" for="category-{{$category->id}}">{{$category->name}}</label>
                    </div>
                </div>
                @endforeach
                <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
                <h6 class="text-uppercase mt-5 mb-3 font-weight-bold">{{ __('shop.welcome.price') }}</h6>
                <div class="price-filter-control">
                    <input type="number" class="form-control w-50 pull-left mb-2" name="filter[price_min]" placeholder="50" id="price-min-control">
                    <input type="number" class="form-control w-50 pull-right" name="filter[price_max]" placeholder="150" id="price-max-control">
                </div>
                <input id="ex2" type="text" class="slider " value="50,150" data-slider-min="10" data-slider-max="200" data-slider-step="5" data-slider-value="[50,150]" data-value="50,150" style="display: none;">
                <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
                <a href="#" class="btn btn-lg btn-block btn-primary mt-5" id="filter-button"><i class="fa-solid fa-magnifying-glass"></i> {{ __('shop.welcome.filter') }}</a>
            </form>

        </div>
    </div>
@endsection
@section('js-files')
    @vite(['resources/js/welcome.js'])
@endsection

