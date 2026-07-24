@extends('layouts.app')

@section('title', $obituary->name . ' Obituary | Obituary Platform')
@section('meta_description', $obituary->excerpt())
@section('meta_keywords', "obituary, {$obituary->name}, memorial, remembrance")

@section('canonical_url', route('obituaries.show', $obituary->slug))

@section('og_type', 'article')
@section('og_title', $obituary->name . ' Obituary')
@section('og_description', $obituary->excerpt())
@section('og_url', route('obituaries.show', $obituary->slug))

{{-- Task 6.2: schema.org structured data (JSON-LD) --}}
@section('structured_data')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": {{ Illuminate\Support\Js::from($obituary->name) }},
        "birthDate": "{{ $obituary->date_of_birth->toDateString() }}",
        "deathDate": "{{ $obituary->date_of_death->toDateString() }}",
        "description": {{ Illuminate\Support\Js::from($obituary->excerpt(300)) }}
    }
    </script>
@endsection

@section('content')
    <article class="obituary">
        <h1>{{ $obituary->name }}</h1>
        <p class="obituary-dates">
            {{ $obituary->date_of_birth->format('F j, Y') }} &ndash;
            {{ $obituary->date_of_death->format('F j, Y') }}
        </p>

        <div class="obituary-content">
            {!! nl2br(e($obituary->content)) !!}
        </div>

        <p class="obituary-author">Submitted by {{ $obituary->author }}
            on {{ $obituary->submission_date->format('F j, Y') }}</p>

        {{-- Task 6.4: social sharing buttons --}}
        <div class="share-buttons">
            <span>Share:</span>
            <a class="share-btn share-facebook"
               href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('obituaries.show', $obituary->slug)) }}"
               target="_blank" rel="noopener noreferrer">Facebook</a>
            <a class="share-btn share-twitter"
               href="https://twitter.com/intent/tweet?url={{ urlencode(route('obituaries.show', $obituary->slug)) }}&text={{ urlencode('In memory of ' . $obituary->name) }}"
               target="_blank" rel="noopener noreferrer">X / Twitter</a>
            <a class="share-btn share-email"
               href="mailto:?subject={{ urlencode('In memory of ' . $obituary->name) }}&body={{ urlencode(route('obituaries.show', $obituary->slug)) }}">
               Email</a>
        </div>
    </article>
@endsection
