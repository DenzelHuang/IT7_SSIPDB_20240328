<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
@extends('header')
@section('title', 'Delete Account')
@section('account_active', 'active')

@section('content')
    <div class="container mt-5">
        <div class="col-9 mx-auto border" id="form-container">
            <h2 class="text-center text-primary mt-4">Delete Account</h2>
            <div class="mx-5 py-3">
                <form method="POST" action="{{ route('account.confirmDelete', ['id' => $user->id ?? '']) }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id ?? '' }}">
                    <p>Are you sure you want to delete the account: {{ $user->username }} ?</p>
                    
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