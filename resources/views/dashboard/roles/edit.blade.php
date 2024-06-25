@extends('layouts.dashboard')

@section('title', 'Edit on role')

@section('content')

    <div class="row">
        <div class="col-6">
            <?php $per_name = ' '; ?>
            <h4>Not assigned Permissions</h4>
            <p><i>click to assign permission to role :</i><i class="fa-solid fa-arrow-right fa-lg ml-2"
                    style="color: #009f0b"></i></p>

            @forelse ($unassigned_permissions as $permission)
                <form action="{{ route('role.assign-permission', ['role' => $role, 'id' => $permission->id]) }}"
                    class="d-inline" method="POST">
                    @csrf
                    @method('put')
                    @if ($per_name != strtok($permission->name, ' '))
                        <br>
                    @endif
                    <?php
                    $per_name = strtok($permission->name, ' ');
                    ?>

                    <button class="btn btn-outline-dark btn-sm mx-1 my-2"
                        title="Click to assign it"><b>{{ $permission->name }}</b></button>
                </form>
            @empty
                <p style="color: red">All permissions is assigned to this role.</p>
            @endforelse
        </div>

        <div class="col-6">
            <?php $ass_per = ' '; ?>
            <h4>{{ $role->name }} Permissions</h4>
            <p><i class="fa-solid fa-arrow-left fa-lg mr-2" style="color: red"></i><i>click to revoke from role:</i></p>

            @forelse ($permissions as $permission)
                <form action="{{ route('role.revoke-permission', ['role' => $role, 'id' => $permission->id]) }}"
                    class="d-inline" method="post">
                    @csrf
                    @method('put')
                    @if ($ass_per != strtok($permission->name, ' '))
                        <br>
                    @endif
                    <?php
                    $ass_per = strtok($permission->name, ' ');
                    ?>


                    <button class="btn btn-outline-success mx-1 my-2 btn-sm"
                        title="Click to revoke it"><b>{{ $permission->name }}</b> </button>
                </form>
            @empty
                <p style="color: red">This role does not have any permissions yet.</p>
            @endforelse
        </div>
    </div>
@endsection
