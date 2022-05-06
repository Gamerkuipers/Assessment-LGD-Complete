@extends('layouts.app')

@section('content')

    @foreach($users as $user)
        <div>
            {{$user}}
        </div>
    @endforeach
@endsection
