<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
@extends('header')
@section('title', 'Delete Account')
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
            border-radius: 20px;
            background-color: ghostwhite;
            margin-top: 20px;
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
    <div class="account-form d-flex mb-4">
        <form method="POST" action="{{ route('account.confirmDelete', ['id' => $account->user_id ?? '']) }}">
            @csrf
            <input type="hidden" name="id" value="{{ $account->user_id ?? '' }}">
            <h2>Delete Account</h2>
            <p>Are you sure you want to delete the account for {{ $account->username }}?</p>
            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a class="btn btn-secondary" href="{{ route('account.index') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
