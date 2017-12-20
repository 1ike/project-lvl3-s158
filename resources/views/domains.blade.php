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
<!--         @if (count($domains) > 1)
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
        @endif -->
    </div>


@endif

@endsection
