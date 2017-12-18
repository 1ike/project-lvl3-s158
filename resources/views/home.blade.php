@extends('layout')

@section('content')

        <h1>PageSpeed optimization</h1>

        @include('form', ['url' => $url])

        {{ $html }}


@endsection
