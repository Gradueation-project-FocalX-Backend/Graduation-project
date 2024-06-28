@extends('layouts.dashboard')

@section('title', 'Add new user')

@section('content')
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">User name</label>
            <input type="text" name="name" class="form-control @error('name')
                is-invalid
            @enderror" value="{{ old('name', optional($user ?? null)->name) }}">
            @error('name')
                <p class="inavlid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email')
                is-invalid
            @enderror" value="{{ old('email', optional($user ?? null)->email) }}">
            @error('email')
                <p class="inavlid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="role" class="form-label">Role</label>
            <select name="roles[]" id="role" class="form-control">
                <option value="">-- Select role for the new user --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="row">
            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control @error('password')
                    is-invalid
                @enderror">
                @error('password')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                <label for="password">Password Confirmation</label>
                <input type="password" name="password-confirmation" class="form-control @error('password-confirmation')
                    is-invalid
                @enderror">
            </div>
        </div>

        <div>
            <button  type="submit" class="btn btn-primary">Save <i class="fa-solid fa-save"></i></button>
        </div>
    </form>
@endsection