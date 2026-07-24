@extends('layouts.app')

@section('title', 'Browse Obituaries | Obituary Platform')
@section('meta_description', 'Browse recent obituaries and honor the memories of loved ones.')

@section('content')
    <h1>Obituaries</h1>

    @if ($obituaries->isEmpty())
        <p>No obituaries have been submitted yet.</p>
    @else
        <table class="obituaries-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Born</th>
                    <th>Died</th>
                    <th>Submitted By</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obituaries as $obituary)
                    <tr>
                        <td>{{ $obituary->name }}</td>
                        <td>{{ $obituary->date_of_birth->format('M j, Y') }}</td>
                        <td>{{ $obituary->date_of_death->format('M j, Y') }}</td>
                        <td>{{ $obituary->author }}</td>
                        <td><a href="{{ route('obituaries.show', $obituary->slug) }}">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $obituaries->links() }}
        </div>
    @endif
@endsection
