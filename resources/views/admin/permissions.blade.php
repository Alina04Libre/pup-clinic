@extends('partials.header')
@section('title', 'Permissions')

@section('permissions')
<style>
    .form-check-input[readonly] {
        pointer-events: none; /* Prevent interaction with the element */
    }
</style>
<div class="container">

    <div class="form-group">
        <!-- <label for="permissions">Assign Permissions:</label>
        @foreach($permissions as $permission)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}">
            <label class="form-check-label">{{ $permission->name }}</label>
        </div>
        @endforeach -->

        <!-- <button type="submit" class="btn btn-primary">Save</button> -->

        <div class="form-check">
            @foreach ($roles as $role)
            <h2>{{ $role->name }}</h2>
            <ul>
                @foreach ($role->permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[{{ $role->id }}][]" value="{{ $permission->id }}" readonly checked>
                    <label class="form-check-label">{{ $permission->name }}</label>
                </div>
                @endforeach
            </ul>
            @endforeach
        </div>
    </div>
    @endsection