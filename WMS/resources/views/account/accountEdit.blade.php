<!-- Order your soul. Reduce your wants. - Augustine -->
@extends('header')
@section('title', 'Account Edit')
@section('styling')
    h1 {
        color: white;
        text-shadow: black 0px 0px 5px;
    }
@endsection
@section('account_active', 'active')

@section('content')
    <div class="container mt-5">
        <div class="col-9 mx-auto border" id="form-container">
            <h2 class="text-center text-primary my-4">Edit Account</h2>
            <div class="mx-5 py-3">
                <form method="POST" action="/account/edit/{{ $account->user_id ?? '' }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $account->user_id ?? '' }}"> <!-- Include the user_id as a hidden field -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $account->username ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="password" name="password" value="{{ $account->password ?? '' }}" aria-describedby="toggle-password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-secondary" href="{{ route('account.index') }}">Back</a>
                </form>
                </div>    
        </div>
    </div>
@include('footer')
@endsection