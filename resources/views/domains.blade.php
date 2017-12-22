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

    <div class="d-inline-block">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>
                    <th scope="col">status code</th>
                    <th scope="col">content-length</th>
                    @if (!$hasPagination)
                    <th scope="col">meta[keywords]</th>
                    <th scope="col">meta[content]</th>
                    @endif
                </tr>
            </thead>
            <tbody class="table-striped">
                @foreach ($domains as $domain)
                <tr>
                    <th scope="row">{{ $domain->id }}</th>
                    <td><a href="{{ route('domain', ['id' => $domain->id]) }}">{{ $domain->name }}</a></td>
                    <td>{{ $domain->created_at }}</td>
                    <td>{{ $domain->updated_at }}</td>
                    <td>{{ $domain->code }}</td>
                    <td>{{ (int) $domain->content_length !== -1 ? $domain->content_length : 'has not header' }}</td>
                    @if (!$hasPagination)
                    <td>{{ $domain->meta_keywords }}</td>
                    <td>{{ $domain->meta_content }}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($hasPagination)
        <nav class="d-flex justify-content-center" aria-label="Page navigation">
            {{$domains}}
        </nav>
        @endif
    </div>


@endif

@endsection
