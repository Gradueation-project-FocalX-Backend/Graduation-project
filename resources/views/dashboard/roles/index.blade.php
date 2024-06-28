@extends('layouts.dashboard')

@section('title', 'All users')

@section('content')

    <?php $i = 1; ?>
    <table class="table table-hover">
        <thead>
            <th>#ID</th>
            <th>Role Name</th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('roles.edit', ['role' => $role]) }}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('roles.delete', ['id' => $role->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
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
