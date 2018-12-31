<?php
/** @var \App\MiamiOH\NumberFact $fact */
?>

@extends('base')

@section('title', 'Number Facts')

@section('body')
    <div class="fact-number">
        <p>Fact for the number {{ $fact->number() }}.</p>
        <p>{{ $fact->string() }}</p>
    </div>

    <div class="fact-number">
        <p>Fact for the date October 15.</p>
        <p>October 15th is the day in 1582 that Pope Gregory XIII implements the Gregorian calendar.</p>
    </div>

@endsection