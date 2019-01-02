<?php
/** @var \App\MiamiOH\ShowsNumberFact $numberFact */
/** @var \App\MiamiOH\ShowsNumberFact $dateFact */
?>

@extends('base')

@section('title', 'Number Facts')

@section('body')
    <div class="fact-number">
        <form method="POST" action="{{ route('number-lookup') }}">
            @csrf
            <p>
                <span>Enter a number to lookup:</span>
                <input type="text" name="number" />
                <input type="submit" value="Lookup" />
            </p>
        </form>

        @if (!empty($numberFact))
            @include('partials.numberfact', ['type' => 'number', 'numberFact' => $numberFact])
        @endif
    </div>

    <p><a href="{{ route('home') }}">Home</a> | <a href="{{ route('date-lookup') }}">Lookup Date Facts</a></p>
@endsection