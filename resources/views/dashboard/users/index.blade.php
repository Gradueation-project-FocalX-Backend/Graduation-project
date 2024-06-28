@extends('layouts.dashboard')

@section('title', 'All users')

@section('content')

    <div class="mb-4">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add new user <i class="fa-solid fa-plus ml-2"></i></a>
    </div>
    <?php $i = 1; ?>
    <table class="table table-hover">
        <thead>
            <th>#ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="#" class="btn btn-info"><i class="fa-solid fa-info"></i></a>
                        <a href="#" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                        <form action="#" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php $i++ ; ?>
            @empty
            <tr>
                <td colspan="4">Empty data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection
