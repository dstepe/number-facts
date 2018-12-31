<?php
/** @var \App\MiamiOH\ShowsNumberFact $numberFact */
/** @var \App\MiamiOH\ShowsNumberFact $dateFact */
?>

@extends('base')

@section('title', 'Number Facts')

@section('body')
    <div class="fact-number">
        <p>Fact for the number {{ $numberFact->number() }}.</p>
        <p>{{ $numberFact->string() }}</p>
    </div>

    <div class="fact-number">
        <p>Fact for the date {{ $dateFact->number() }}.</p>
        <p>{{ $dateFact->string() }}</p>
    </div>

@endsection