@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if ($submitted)
                <div class="alert alert-info">
                    Thank you for contacting us!
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Contact us') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('contact') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control {{-- @error('contact-title') is-invalid @enderror --}}" name="title" value="{{ old('title') }}" required autofocus>

                                {{-- TODO Add error handling for e.g. too short title --}}
                                {{-- @error('contact-title') --}}
                                {{--     <span class="invalid-feedback" role="alert"> --}}
                                {{--         <strong>{{ $message }}</strong> --}}
                                {{--     </span> --}}
                                {{-- @enderror --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" name="description" rows="4" cols="32" class="form-control {{-- @error('contact-description') is-invalid @enderror --}}" required></textarea>

                                {{-- TODO Add error handling for e.g. too short description --}}
                                {{-- @error('contact-description') --}}
                                {{--     <span class="invalid-feedback" role="alert"> --}}
                                {{--         <strong>{{ $message }}</strong> --}}
                                {{--     </span> --}}
                                {{-- @enderror --}}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('submissions') }}">
                                    {{ __('View Submissions') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
