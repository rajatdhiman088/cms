@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Posts</a>
</div>
<div class="card card-default">
    <div class="card-header">
        Posts
    </div>
    <div class="card card-default">
        <div class="card-body">
            @if($posts->count()> 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th colspan="2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td><img src="{{ asset('storage/'.$post->image) }}" style="border-radius:60%;" height="60px" width="70px" alt="" ></td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <a href="{{ route('categories.edit',$post->category->id) }}">
                                {{ $post->category->name }}
                            </a>
                        </td>
                        @if($post->trashed())
                        <td> 
                            <form action="{{ route('restore-posts',$post->id) }}"  method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-info btn-sm text-white">Restore</button>
                            </form>
                        </td>
                            @else
                        <td>
                            <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-info btn-sm text-white">Edit</a> 
                         
                        </td>
                        @endif 
                        <td>
                            <form action="{{ route('posts.destroy',$post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm text-white">
                            {{ $post->trashed() ? 'Delete':'Trash'}}
                            </button>
                            </form>
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