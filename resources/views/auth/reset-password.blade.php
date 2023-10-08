@extends('layouts.guest')

@section('title', 'Reset Password')

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
                                    <h6>Reset Password</h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('password.store') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    <div class="edit-profile__body">
                                        <div class="form-group mb-25">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-15">
                                            <label for="password">password</label>
                                            <div class="position-relative">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" name="password"
                                                       required autocomplete="new-password">
                                                <div class="uil uil-eye-slash text-lighten fs-15 field-icon toggle-password2">
                                                </div>
                                            </div>
                                            @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-15">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <div class="position-relative">
                                                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                                                <div class="uil uil-eye-slash text-lighten fs-15 field-icon toggle-password2"></div>
                                            </div>
                                            @error('password_confirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="admin__button-group button-group d-flex pt-1 justify-content-md-start justify-content-center">
                                            <button type="submit" class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn ">
                                                Reset Password
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- End: .card-body -->

                        </div><!-- End: .card -->
                    </div><!-- End: .edit-profile -->
                </div><!-- End: .col-xl-5 -->
            </div>
        </div>
    </div><!-- End: .admin-element  -->
@endsection
