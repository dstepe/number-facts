<?php
/** @var \App\MiamiOH\ShowsNumberFact $numberFact */
/** @var \App\MiamiOH\ShowsNumberFact $dateFact */
?>

@extends('base')

@section('title', 'Number Facts')

@section('body')
    <div class="fact-number">
        <form method="POST" action="{{ route('date-lookup') }}">
            @csrf
            <p>
                <span>Enter a date to lookup:</span>
                <input type="text" name="month" />
                <input type="text" name="day" />
                <input type="submit" value="Lookup" />
            </p>
        </form>

        @if (!empty($dateFact))
            @include('partials.numberfact', ['type' => 'date', 'numberFact' => $dateFact])
        @endif
    </div>

    <p><a href="{{ route('home') }}">Home</a> | <a href="{{ route('number-lookup') }}">Lookup Number Facts</a></p>
@endsection