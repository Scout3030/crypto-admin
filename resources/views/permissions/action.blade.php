@can('role-edit')<a href="{{route('permissions.edit', $id)}}">Edit</a>@endcan
@can('role-delete')<button class="delete-permission" data-id="{{$id}}" data-name="{{$name}}">Delete</button>@endcan
