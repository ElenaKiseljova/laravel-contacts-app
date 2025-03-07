@extends('layouts.main')

@section('title', 'Contact App | Reset Password')

@section('content')
  <div class="auth-wrapper d-flex bg-light">
    <div class="col-md-4 m-auto">
      <div class="bg-white shadow-sm">
        <h1 class="border-bottom p-4">Reset Password</h1>

        <div class="px-4 py-4">

          <form action="{{ route('password.email') }}" method="POST">
            @csrf
            @if ($message = session('status'))
              <div class="alert alert-success">{{ $message }}</div>
            @endif
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" />

              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <button type="submit" class="btn btn-block btn-primary">Send Password reset link</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
