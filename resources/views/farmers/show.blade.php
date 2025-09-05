@extends('layouts.app')

@section('content')
<h1>Farmer Details</h1>
<p><strong>Name:</strong> {{ $farmer->name }}</p>
<p><strong>Phone:</strong> {{ $farmer->phone }}</p>
<p><strong>Village:</strong> {{ $farmer->village }}</p>
<a href="{{ route('farmers.index') }}" class="btn btn-secondary">Back</a>
@endsection