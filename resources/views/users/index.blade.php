@extends('layouts.app')

@section('content')
<div class="container">
    @include('helpers.flash-messages')
    <div class="row">
        <div class="col-6">
            <h1><i class="fa-solid fa-users"></i> {{ __('shop.user.index_title') }}</h1>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col">Imię</th>
                <th scope="col">Nazwisko</th>
                <th scope="col">Numer telefonu</th>
                <th scope="col">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->surname}}</td>
                    <td>{{$user->phone_number}}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}">
                            <button class="btn btn-success btn-sm"><i class="far fa-edit"></i></button>
                        </a>
                        <button data-id="{{$user->id}}" class="btn btn-danger btn-sm delete"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection
@section('javascript')
@endsection
@section('js-files')
    @vite(['resources/js/delete.js'])
@endsection

