@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('tags.create') }}" class="btn btn-success">Add tags</a>
</div>
<div class="card card-default">
    <div class="card-header">
        tags
    </div>
    <div class="card-body">
        @if($tags->count() > 0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Posts Count</th>
                <th colspan="2">
                    Actions
                </th>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->posts->count() }}</td>
                    <td >
                        <a href="{{ route('tags.edit',$tag->id) }}" class="btn btn-info btn-sm text-white">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $tag->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
        <h3 class="text-center">No,Record Found!</h3>
        @endif
        <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <form action="" method="post" id="deleteform">
                @csrf
                @method('DELETE')
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Do,You Want to Delete The tag</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Go Back</button>
                        <button type="submit" class="btn btn-danger">Yes,Delete</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id){
            var form = document.getElementById('deleteform');
            form.action='tags/'+ id;
            $('#deleteModal').modal('show') 
        }
    </script>
@endsection