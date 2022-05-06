@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <td>
                    Name
                </td>
                <td>

                </td>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)

            @endforeach
        </tbody>
    </table>

@endsection
