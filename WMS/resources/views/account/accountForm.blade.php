<!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
@extends('header')
@section('title', 'Account Create')
@section('styling')
    <style>
        .accounts-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .account-form {
            border: 1px solid black;
            padding: 20px;
            border: 1px solid black;
            background-color: ghostwhite;
            border-radius: 20px;
        }
        .account-form form {
            display: flex;
            flex-direction: column;
        }
    </style>
@endsection

@section('account_active', 'active')

@section('content')
<div class="accounts-body">
    <div class="account-form d-flex">
        <form method="POST" action="{{ route('account.create') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $account->username ?? ''}}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="password" name="password" value="{{ $account->password ?? ''}}" aria-describedby="toggle-password">
                </div>
            </div>
            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('account.index') }}">Back</a>
            </div>
        </form>
    </div>
@include('footer')
</div>
@endsection