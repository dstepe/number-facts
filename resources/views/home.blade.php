@extends('base')

@section('title', 'Number Facts')

@section('body')
    <p>Fact for the number {{ $number }}.</p>
    <p>{{ $fact }}</p>
@endsection