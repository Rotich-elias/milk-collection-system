@extends('layouts.app')

@section('content')
<h1>Add Farmer</h1>
<form action="{{ route('farmers.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
    </div>
    <div class="mb-3">
        <label for="village" class="form-label">Village</label>
        <input type="text" class="form-control" id="village" name="village" required>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection