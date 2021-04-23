<div>
    <h2 class="titleBody">{{ $title }} Role</h2>
    <form wire:submit.prevent="store" >
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

            <div><h3 class="titleBody">Permissions</h3></div>

            <livewire:search-role-filter/>

            <div class="row">
                <div class="col-md-6">
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
                <div class="col-md-6">
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-12 d-flex flex-row-reverse">
            <button type="submit" class="btn btn-primary">@if($role_id > 0) Update @else Submit @endif</button>
            <a href="{{route('roles.list')}}" class="btn btn-outline-info">Cancel</a>
        </div>
    </form>
</div>
