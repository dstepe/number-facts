<?php
/** @var \App\MiamiOH\NumberFact $fact */
?>

@extends('base')

@section('title', 'Number Facts')

@section('body')
    <p>Fact for the number {{ $fact->number() }}.</p>
    <p>{{ $fact->string() }}</p>
@endsection