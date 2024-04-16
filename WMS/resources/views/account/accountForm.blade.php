<!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
@extends('header')
@section('title', 'Accounts')
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

@section('content')
<?php 
    $username = $password = "";
?>
<div class="accounts-body">
    <div class="account-form d-flex">
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="email" class="form-control" id="username" value="{{ $username }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" value="{{ $password }}">
            </div>
            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-secondary" href="{{ route('account.index') }}">Back</a>
            </div>
        </form>
    </div>
@include('footer')
</div>
@endsection