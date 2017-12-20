@extends('layouts/layout')

@section('title', $title)

@section('navbar')
    @include('layouts/navbar', ['routeName' => $routeName])
@endsection

@section('content')

@if ($domains->isEmpty())
    <h1>There no domains found.</h1>
@else
    <h1>{{trans_choice('plures.Domains', count($domains))}}</h1>

    <div class="domains-list">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                @foreach ($domains as $domain)
                <tr>
                    <th scope="row">{{ $domain->id }}</th>
                    <td><a href="{{ route('domain', ['id' => $domain->id]) }}">{{ $domain->name }}</a></td>
                    <td>{{ $domain->created_at }}</td>
                    <td>{{ $domain->updated_at }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">
                    </td>
                </tr>
            </tbody>
        </table>
        @if (count($domains) > 1 )
        <nav class="pagination-nav" aria-label="Page navigation">
            {{$domains}}
        </nav>
        @endif
    </div>


@endif

@endsection
