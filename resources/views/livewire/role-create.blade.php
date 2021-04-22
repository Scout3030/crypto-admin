<div>
    <h2>{{ $title }} Role</h2>
    <form class="formLogin" wire:submit.prevent="store" >
        @csrf

        <input type="hidden" wire:model="role_id">

        <div class="mb-3">
            <label for="first-name">Role Name</label>
            <input type="text"
                class="form-control @error('name') validation @enderror"
                id="name"
                wire:model="name"
                autocomplete="off"
                >
        </div>
        @error('name')
        <div class="form-text validation pb-1">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <div><h3>Permissions</h3></div>
            <div class="row">
                <div class="col-sm-4 mb-3">
                    @php $no = 1; @endphp
                    @foreach($permissions as $permission)
                        <div class="form-group form-check">
                            <input type="checkbox"
                                    @if( $role_id == 0) wire:model="permissions_selected" @endif
                                    class="form-check-input"
                                    id="permission-{{$permission->id}}"
                                    value="{{$permission->id}}"
                                    @if($role_id > 0 && Permissions::roleHasPermission($role, $permission->name)) checked @endif
                                    name="permissions[]">
                            <label class="form-check-label" for="permission-{{$permission->id}}">{{$permission->name}}</label>
                        </div>
                    @if ($no++%4 == 0)
                </div>
                <div class="col-sm-4 mb-3">
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <a href="{{route('roles.list')}}" class="btn btn-outline-info">Cancel</a>
        <button type="submit" class="btn btn-primary">@if($role_id > 0) Update @else Submit @endif</button>
    </form>
</div>
