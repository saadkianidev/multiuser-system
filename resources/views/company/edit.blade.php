@extends('layouts.dashboard')
@section('title', 'Edit Company')

@section('content')
    <h2>Edit Company</h2>

    <form method="POST" action="{{ route('admin.companies.update', $company) }}">
        @csrf @method('PUT')
        @include('company._form')
        <button type="submit" class="btn btn-primary">Update Company</button>
    </form>
@endsection