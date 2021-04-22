<div class="d-flex">
	@can('role-edit')<a class="btn btn-primary shadow btn-xs sharp" href="{{route('permissions.edit', $id)}}"><i class="fa fa-pencil"></i></a>@endcan
	@can('role-delete')<button class="delete-permission btn btn-danger shadow btn-xs sharp" data-id="{{$id}}" data-name="{{$name}}"><i class="fa fa-trash"></i></button>@endcan
</div>