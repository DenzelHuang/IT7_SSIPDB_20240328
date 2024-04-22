@extends('header')
@section('title', 'Accounts')
@section('styling')
    <style>
        /* Accounts */
        .accounts-body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            align-items: center;
        }
        .account-box {
            padding: 20px;
            border: 1px solid black;
            background-color: ghostwhite;
            border-radius: 20px;
            overflow: hidden;
            overflow-y: scroll;
        }
        .account-list {
            height: 100%;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            border-collapse: collapse;
            overflow: hidden;
            overflow-y: scroll;
        }
        .account-box::-webkit-scrollbar,
        .account-list::-webkit-scrollbar {
            display: none;
        }
        .account-list table {
            margin-top: -1px;
            margin-bottom: -1px;
            padding: 0;
            width: 100%;
        }
        .account-list th, 
        .account-list td {
            text-align: center;
            border: 1px solid black;
        }
    </style>
@endsection

@section('shipment_active', 'active')

@section('content')
<div class="accounts-body">
    <div class="account-box container">
        <h3>Accounts Index</h3>
        <a href="{{ route('account.create') }}" class="btn btn-primary mt-1 mb-2">Add New Account</a>
        <div class="account-list">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
                @foreach ($accounts as $account)
                <tr>
                    <td>{{ $account->user_id }}</td>
                    <td>{{ $account->username }}</td>
                    <td>{{ $account->password }}</td>
                    <td>
                        <a href="/account/edit/{{ $account->user_id }}">Edit</a>
                        <span>/</span>
                        <a href="/account/delete/{{ $account->user_id }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@include('footer')
</div>
@endsection