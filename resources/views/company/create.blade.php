
@extends('layouts.dashboard')
@section('title', 'Add Company')

@section('content')
    <h2>Add Company</h2>

    <form method="POST" action="{{ route('admin.companies.store') }}">
        @csrf
        @include('company._form')
        <button type="submit" class="btn btn-primary">Create Company</button>
    </form>
@endsection