@extends('layouts/layout')

@section('title', $title)

@section('navbar')
    @include('layouts/navbar', ['routeName' => $routeName])
@endsection

@section('content')

@if (empty($domains))
    <h1>There no domains found.</h1>
@else
    @if (count($domains) == 1)
    <h1>Domain</h1>
    @else
    <h1>Domains</h1>
    @endif
    <table class="table table-responsive">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">URL</th>
            </tr>
        </thead>
        <tbody class="table-striped">
            @foreach ($domains as $domain)
            <tr>
                <th scope="row">{{ $domain->id }}</th>
                <td>{{ $domain->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endif

@endsection
