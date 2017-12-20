@extends('layouts/layout')

@section('title', $title)

@section('navbar')
    @include('layouts/navbar', ['routeName' => $routeName])
@endsection

@section('content')

<div class="jumbotron mt-5">
    <h1 class="display-3">Check your webpage!</h1>
    <p class="lead">
        Enter webpage URL for testing and get recomendations about webpage speed optimization.
    </p>

    <form action="{{ route('domains') }}"  method="post" class="search form-inline mt-5">

        <input class="form-control m-2" id="url" name="url" value="{{ $url }}" placeholder="Enter webpage URL" required="" type="text">

        <input class="btn btn-primary m-2" value="Test"  type="submit">
    </form>
    @if ($errors)
    @foreach ($errors as $error)
    <p class="alert alert-danger" role="alert">{{ $error }}</p>

    @endforeach
    @endif
</div>

@endsection
