@extends('layouts.dashboard')
@section('title', 'Employee Dashboard')

@section('content')
    <h2>Employee Dashboard</h2>
    <p>Welcome, {{ auth()->user()->name }}.</p>
@endsection