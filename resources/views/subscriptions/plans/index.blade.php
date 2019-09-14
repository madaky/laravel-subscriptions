@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('rolepcreation') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="plan" class="col-md-4 col-form-label text-md-right">{{ __('Plan Name') }}</label>

                            <div class="col-md-6">
                                <input id="plan" type="text" class="form-control @error('plan') is-invalid @enderror" 
                                       name="plan" value="{{ old('plan') }}" required autocomplete="email" autofocus>

                                @error('plan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" 
                                       name="price" value="{{ old('price') }}" required  autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('Duration') }}</label>

                            <div class="col-md-6">
                                <input id="duration" type="number" class="form-control @error('duration') is-invalid @enderror" 
                                       name="duration" value="{{ old('duration') }}" required  autofocus>

                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
