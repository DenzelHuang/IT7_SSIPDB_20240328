<!-- Order your soul. Reduce your wants. - Augustine -->
@extends('header')
@section('title', 'Account Edit')
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
    <div class="container my-5">
        <div class="col-9 mx-auto border" id="form-container">
            <h2 class="text-center text-primary my-4">Edit Account</h2>
            <div class="mx-5 my-5">
                <form method="POST" action="/account/edit/{{ $account->user_id ?? '' }}">
                    @csrf
                    {{-- Username Field --}}
                    <div class="form-group my-2">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $account->username ?? '' }}">
                    </div>

                    {{-- Old Password Field --}}
                    <div class="form-group my-2">
                        <label for="old-password">Old Password</label>
                        <input type="password" class="form-control" id="old-password" name="old_password">
                    </div>

                    {{-- New Password Field --}}
                    <div class="form-group my-2">
                        <label for="new-password">New Password</label>
                        <input type="password" class="form-control" id="new-password" name="new_password">
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                    @if($errors->any())
                        <div class="text-danger mt-3">{{ $errors->first() }}</div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    @include('footer')
@endsection