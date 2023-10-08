@extends('layouts.guest')
@section('title', 'Forgotten Password')
@section('content')
    <div class="admin">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-8">
                    <div class="edit-profile">
                        <div class="edit-profile__logos">
                            <a href="{{ route('login') }}">
                                <img class="dark" src="{{ asset('img/logo-dark.png') }}" alt="">
                                <img class="light" src="{{ asset('img/logo-white.png') }}" alt="">
                            </a>
                        </div>
                        <div class="card border-0">
                            <div class="card-header">
                                <div class="edit-profile__title">
                                    <h6>Forgot Password?</h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="edit-profile__body">
                                    <p>Enter the email address you used when you joined and we’ll send you instructions to reset your password.</p>
                                    @if(session()->has('status'))
                                        <div class="alert alert-success">
                                            {{ session()->get('status') }}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                    <div class="form-group mb-20">
                                        <label for="email">Email Adress</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary btn-default btn-squared text-capitalize lh-normal px-md-50 py-15 signIn-createBtn">
                                            Send Reset Instructions
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div><!-- End: .card-body -->
                        </div><!-- End: .card -->
                    </div><!-- End: .edit-profile -->
                </div><!-- End: .col-xl-5 -->
            </div>
        </div>
    </div><!-- End: .admin-element  -->
@endsection
