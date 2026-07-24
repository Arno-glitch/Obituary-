@extends('layouts.app')

@section('title', 'Submit an Obituary | Obituary Platform')
@section('meta_description', 'Submit an obituary to honor and remember a loved one.')

@section('content')
    <h1>Submit an Obituary</h1>

    <form id="obituary-form" action="{{ route('obituaries.store') }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" maxlength="100"
                   value="{{ old('name') }}" required>
            <span class="field-error" data-for="name"></span>
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" id="date_of_birth" name="date_of_birth"
                   value="{{ old('date_of_birth') }}" required>
            <span class="field-error" data-for="date_of_birth"></span>
        </div>

        <div class="form-group">
            <label for="date_of_death">Date of Death</label>
            <input type="date" id="date_of_death" name="date_of_death"
                   value="{{ old('date_of_death') }}" required>
            <span class="field-error" data-for="date_of_death"></span>
        </div>

        <div class="form-group">
            <label for="content">Obituary</label>
            <textarea id="content" name="content" rows="8" required>{{ old('content') }}</textarea>
            <span class="field-error" data-for="content"></span>
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" id="author" name="author" maxlength="100"
                   value="{{ old('author') }}" required>
            <span class="field-error" data-for="author"></span>
        </div>

        <button type="submit" class="btn btn-primary">Submit Obituary</button>
    </form>
@endsection
