@extends('admin.layouts.app')

@section('content')
    <div>
        <h3>Create API</h3>
        <form action="{{ route('admin.api.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="key">Key</label>
                <input class="form-control" type="text" name="key" id="key" class="form-control" required>
            </div>
            <button type="submit" class="btn">Create</button>
        </form>
    </div>
@endsection