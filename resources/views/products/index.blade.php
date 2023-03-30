@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Lista produktów</h1>
            </div>
            <div class="col-6">
                <a class="d-flex justify-content-end" href="{{ route('products.create') }}">
                    <button type="button" class="btn btn-primary">Dodaj </button>
                </a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Obraz</th>
                    <th scope="col">Opis</th>
                    <th scope="col">Ilość</th>
                    <th scope="col">Cena</th>
                    <th scope="col">Akcje</th>
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
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.show', $product->id) }}">
                                    <button class="btn btn-primary btn-sm">P</button>
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}">
                                    <button class="btn btn-success btn-sm">E</button>
                                </a>
                                <button data-id="{{$product->id}}" class="btn btn-danger btn-sm delete">X</button>
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

