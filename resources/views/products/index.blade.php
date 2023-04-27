@extends('layouts.app')

@section('content')
    <div class="container">
        @include('helpers.flash-messages')
        <div class="row">
            <div class="col-6">
                <h1><i class="fa-solid fa-store"></i> {{ __('shop.product.index_title') }}</h1>
            </div>
            <div class="col-6">
                <a class="d-flex justify-content-end" href="{{ route('products.create') }}">
                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-plus"></i> {{ __('shop.button.add') }}</button>
                </a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('shop.product.fields.name') }}</th>
                    <th scope="col">{{ __('shop.product.fields.image') }}</th>
                    <th scope="col">{{ __('shop.product.fields.description') }}</th>
                    <th scope="col">{{ __('shop.product.fields.amount') }}</th>
                    <th scope="col">{{ __('shop.product.fields.price') }}</th>
                    <th scope="col">{{ __('shop.product.fields.category') }}</th>
                    <th scope="col">{{ __('shop.columns.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>{{$product->name}}</td>
                        <td>@if(!is_null($product->image_path))<img style="width: 100px; height: 100px;" src="{{ asset('storage/'.$product->image_path) }}">@endif</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->amount}}</td>
                        <td>{{$product->price}}</td>
                        <td>@if($product->hasCategory()){{ $product->category->name }}@endif</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.show', $product->id) }}">
                                    <button class="btn btn-primary btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}">
                                    <button class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                                </a>
                                <button data-id="{{$product->id}}" class="btn btn-danger btn-sm delete"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
@endsection
@section('javascript')
@endsection
@section('js-files')
    @vite(['resources/js/delete.js'])
@endsection

