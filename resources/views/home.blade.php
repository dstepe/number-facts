<?php
/** @var \App\MiamiOH\ShowsNumberFact $numberFact */
/** @var \App\MiamiOH\ShowsNumberFact $dateFact */
?>

@extends('base')

@section('title', 'Number Facts')

@section('body')
    <div class="fact-number">
        @include('partials.numberfact', [$numberFact])
    </div>

    <div class="fact-number">
        <p>Fact for the date {{ $dateFact->number() }}.</p>
        <p>{{ $dateFact->string() }}</p>
    </div>

    <p><a href="{{ route('number-lookup') }}">Lookup Number Facts</a> | <a href="{{ route('date-lookup') }}">Lookup Date Facts</a></p>
@endsection