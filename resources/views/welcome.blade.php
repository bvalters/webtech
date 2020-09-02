@extends('layouts.app')
@section('content')
    <div class="container flex-center position-ref full-height text-center py-5">
        <h1 class="h1 font-weight-bold text-capitalize">{{__("welcome.title")}}</h1>
        <h4 class="text-muted">{{__("welcome.sub")}}</h4>
            <div class="btn-wrapper mt-5">
                <a class="btn btn-primary btn-lg btn-block" href="{{route('register')}}">{{ __('text.register') }}</a>
                <a class="btn btn-secondary btn-lg btn-block" href="{{route('login')}}">{{ __('text.login') }}</a>
            </div>
    </div>
@endsection

