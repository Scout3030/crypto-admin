@can('merchant-users-actions-button')
    <a href="{{route('client.edit', $id)}}">Edit</a>
    <button class="delete-permission" data-id="{{$id}}" data-name="{{$first_name}}">Delete</button>
@endcan
