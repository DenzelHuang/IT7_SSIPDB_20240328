<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
@extends('header')
@section('title', 'Delete Account')
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
            <h2 class="text-center text-primary mt-4">Delete Account</h2>
            <div class="mx-5 py-3">
                <form method="POST" action="{{ route('account.confirmDelete', ['id' => $account->user_id ?? '']) }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $account->user_id ?? '' }}">
                    <p>Are you sure you want to delete the account: {{ $account->username }} ?</p>
                    
                    {{-- Password Field --}}
                    <div class="form-group my-2">
                        <label for="password">Enter Password to Confirm</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @if($errors->any())
                            <div class="text-danger">{{ $errors->first() }}</div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-evenly">
                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                        <a class="btn btn-secondary" href="{{ route('account.index') }}">Cancel</a>
                    </div>
                </form>
            </div>    
        </div>
    </div>
    @include('footer')
@endsection