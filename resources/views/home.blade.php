@extends('layouts/layout')

@section('title', $title)

@section('navbar')
    @include('layouts/navbar', ['routeName' => $routeName])
@endsection

@section('content')

get_loaded_extensions();

<div class="jumbotron jumbotron--home">
    <h1 class="display-3">Check your webpage!</h1>
    <p class="lead">
        Enter webpage URL for testing and get recomendations about webpage speed optimization.
    </p>

    <form action="/domains"  method="post" class="search form-inline">

        <input class="form-control" id="url" name="url" value="{{ $url }}" placeholder="Enter webpage URL" required="" type="text">

        <input class="btn btn-primary" value="Test"  type="submit">
    </form>
    @if ($errors)
    @foreach ($errors as $error)
    <p class="alert alert-danger" role="alert">{{ $error }}</p>

    @endforeach
    @endif
</div>

@endsection
