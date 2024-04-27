@extends('header')
@section('title', 'Accounts')
@section('account_active', 'active')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Accounts</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="{{ route('account.create') }}" class="btn btn-primary mt-1 mb-2">
                    <img src="{{ asset('images/green-add-icon.png') }}" alt="Add Icon" style="width: 20px; height: auto;">
                    <span>Add New Account</span>
                </a>
            </div>
        </div>
        <div id="table-container" class="container-flex border px-3 py-3">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <a href="/account/edit/{{ $user->id }}">Edit</a>
                                <span>|</span>
                                <a href="/account/delete/{{ $user->id }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('footer')
@endsection