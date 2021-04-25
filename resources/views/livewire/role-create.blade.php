<div>
    <h2 class="titleBody">{{ $title }} Role</h2>
    <form wire:submit.prevent="store" class="formLogin">
        <input type="hidden" wire:model="role_id">
        <div class="mb-3">
            <label for="current_password" class="form-label">Role Name</label>
            <input id="name"
                type="text"
                wire:model="name"
                class="form-control @error('name') validation @enderror"
                autocomplete="off"
            >
            @error('name')
            <div class="form-text validation pb-1">{{ $message }}</div>
            @enderror
            @error('permissions_selected')
            <div class="form-text validation pb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">

            <div><h3 class="titleBody">Permissions</h3></div>

            <livewire:search-role-filter/>

            <div class="row">
                @foreach($permissions->chunk(2) as $chunk)
                    <div class="col-md-6">
                        @foreach($chunk as $index => $permission)
                            <div class="form-group form-check" wire:key="{{ $index }}">
                                <input type="checkbox"
                                       @if( $role_id == 0) wire:model="permissions_selected.{{ $index }}" @endif
                                       class="form-check-input"
                                       id="permission-{{$permission->id}}"
                                       value="{{$permission->id}}"
                                       @if($role_id > 0 && Permissions::roleHasPermission($role, $permission->name)) checked @endif
                                >
                                <label class="form-check-label" for="permission-{{$permission->id}}">{{$permission->name}}</label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-12 d-flex flex-row-reverse">
            <button type="submit" class="btn btn-primary">@if($role_id > 0) Update @else Submit @endif</button>
            <a href="{{route('roles.list')}}" class="btn btn-outline-info">Cancel</a>
        </div>
    </form>
</div>
