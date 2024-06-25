@extends('layouts.dashboard')

@section('title', 'All users')

@section('content')

    <?php $i = 1; ?>
    <table class="table table-hover">
        <thead>
            <th>#ID</th>
            <th>User Name</th>
            <th>Email</th>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <?php $i++ ; ?>
            @empty
            <tr>
                <td colspan="3">Empty data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection
