<div class="d-flex">
    @can('merchant-users-actions-button')
        <a href="{{route('user.edit', $id)}}" class="btn btn-primary shadow btn-xs sharp"><i class="fa fa-pencil"></i></a>
        <button class="delete-permission btn btn-danger shadow btn-xs sharp" data-id="{{$id}}" data-name="{{$first_name}}"><i class="fa fa-trash"></i></button>
    @endcan
</div>
