<?php
/** @var \App\MiamiOH\ShowsNumberFact $numberFact */
/** @var \App\MiamiOH\ShowsNumberFact $dateFact */
?>

@extends('base')

@section('title', 'Number Facts')

@section('body')
    <div class="fact-number">
        <form method="POST" action="lookup">
            @csrf
            <p>
                <span>Enter a number to lookup:</span>
                <input type="text" name="number" />
                <input type="submit" value="Lookup" />
            </p>
        </form>

        @if (!empty($numberFact))
            @include('partials.numberfact', [$numberFact])
        @endif
    </div>

@endsection