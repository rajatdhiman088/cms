@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        Users
    </div>
    <div class="card card-default">
        <div class="card-body">
            @if($users->count()> 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Email</th>
                        <th colspan="2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                        <img src="{{ Gravatar::src($user->email) }}" style="height:60px;width:70px;border-radius:50%;">
                        </td>

                        <td>{{ $user->name }}</td>

                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                        @if(!$user->isAdmin())
                            <form action="{{ route('users.make-admin',$user->id) }}" method="post">
                                @csrf

                                <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                            </form>
                        @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <h3 class="text-center">No,Record Found!</h3>
            @endif
        </div>
    </div>
</div>
@endsection