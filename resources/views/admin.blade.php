@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header font-weight-bold bg-light">{{ __('text.users') }}</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('text.username') }}</th>
                        <th scope="col">{{ __('text.email') }}</th>
                        <th scope="col">{{ __('text.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a href="{{route('user.edit',$user->id)}}"><button type="button" class="btn btn-secondary float-left">{{ __('text.edit') }}</button></a>
                                @if ($user->id != Auth::user()->id)
                                    <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger float-left">{{ __('text.delete') }}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
