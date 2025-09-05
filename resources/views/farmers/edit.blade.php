@extends('layouts.app')

@section('content')
<h1>Edit Farmer</h1>
<form action="{{ route('farmers.update', $farmer) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $farmer->name }}" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $farmer->phone }}" required>
    </div>
    <div class="mb-3">
        <label for="village" class="form-label">Village</label>
        <input type="text" class="form-control" id="village" name="village" value="{{ $farmer->village }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection