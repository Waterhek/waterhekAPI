@extends('admin.layouts.app')

@section('content')
    <div class="container p-4">
        <div class="flex justify-between items-center mb-4">
            <h3>API Management</h3>
            <a href="{{ route('admin.api.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create API</a>
        </div>
        <div>
            <table class="table-auto w-full border-collapse">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apis as $api)
                        <tr>
                            <td>{{ $api->id }}</td>
                            <td>{{ $api->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection