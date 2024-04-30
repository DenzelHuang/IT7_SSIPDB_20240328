<!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
@extends('header')
@section('title', 'Account Create')
@section('styling')
    .selected-item {
        margin-top: 5px;
    }
    button {
        width: 100%;
    }
    .location-sector-group {
        display: none;
    }
@endsection

@section('account_active', 'active')

@section('content')
    <div class="container mt-5">
        <div class="col-9 mx-auto border" id="form-container">
            <h2 class="text-center text-primary my-4">Create new account</h2>
            <div class="mx-5 mb-3 py-3">
                <form method="POST" action="{{ route('account.create') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="{{ $user->username ?? ''}}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="password" name="password" placeholder="Enter password" value="{{ $user->password ?? ''}}" aria-describedby="toggle-password">
                        </div>
                    </div>
                    @if($errors->any())
                        <div class="text-danger my-3">{{ $errors->first() }}</div>
                    @endif
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>    
        </div>
    </div>
    @include('footer')
@endsection