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

@endsection