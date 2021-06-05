@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('OTP Verification') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('otp_verification.store') }}">
                      @csrf

                      @if(session()->has('error'))
                        <p class="alert alert-danger">{{ session()->get('error') }}</p>
                        @endif
                      @if(session()->has('success'))
                        <p class="alert alert-danger">{{ session()->get('success') }}</p>
                        @endif

                      @if(is_null(auth()->user()->otp_number))
                        <div class="form-group row">
                            <label for="otp_verification" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <input id="otp_verification" type="text" placeholder="Ex: 01xxxxxxxxx" class="form-control @error('otp_verification') is-invalid @enderror" name="otp_verification" value="{{ old('otp_verification') }}" required autocomplete="otp_verification" autofocus>
                                @error('otp_verification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      @else
                        <div class="form-group row">
                            <label for="otp_number" class="col-md-4 col-form-label text-md-right">{{ __('OTP Code') }}</label>
                            <div class="col-md-6">
                                <input id="otp_number" type="number" class="form-control @error('otp_number') is-invalid @enderror" name="otp_number" value="{{ old('otp_number') }}" required autocomplete="otp_number" autofocus>
                                @error('otp_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
