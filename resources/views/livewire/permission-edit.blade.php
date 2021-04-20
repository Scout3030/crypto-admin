<div>
    <form class="formLogin" wire:submit.prevent="update">
        <div class="mb-3">
            <label for="first-name">Permission Name</label>
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

        <a href="{{route('permissions.index')}}" class="btn btn-outline-info">Cancel</a>
        <button type="submit" class="btn btn-primary">@if($permission) Update @else Submit @endif</button>
    </form>
</div>
