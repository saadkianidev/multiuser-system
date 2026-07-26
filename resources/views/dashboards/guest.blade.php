@extends('layouts.dashboard')
@section('title', 'Guest Dashboard')

@section('content')
    <h2>Guest Dashboard</h2>
    <p>Welcome, {{ auth()->user()->name }}.</p>
@endsection