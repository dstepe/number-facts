<?php
/** @var \App\MiamiOH\ShowsNumberFact $numberFact */
/** @var \App\MiamiOH\ShowsNumberFact $dateFact */
?>

@extends('base')

@section('title', 'Number Facts')

@section('body')
    <div class="fact-number">
        @include('partials.numberfact', ['type' => 'number', 'numberFact' => $numberFact])
    </div>

    <div class="fact-number">
        @include('partials.numberfact', ['type' => 'date', 'numberFact' => $dateFact])
    </div>

    <p><a href="{{ route('number-lookup') }}">Lookup Number Facts</a> | <a href="{{ route('date-lookup') }}">Lookup Date Facts</a></p>
@endsection