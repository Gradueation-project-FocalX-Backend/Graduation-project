@extends('layouts.dashboard')

@section('title', 'Add new role')

@section('content')

    <div class="form">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Role name</label>
                <input type="text" class="form-control @error('name')
                    is-invalid
                @enderror" name="name">
                @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Save <i class="fa-solid fa-save ml-2"></i></button>
            </div>
        </form>
    </div>
@endsection
