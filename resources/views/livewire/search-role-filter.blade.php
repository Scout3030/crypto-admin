<div class="pb-3 col-6">
    <input type="text"
           wire:model="permission"
           class="form-control @error('permission') validation @enderror"
           wire:keydown="search"
           placeholder="Search..."
    >
    @error('permission')
    <div class="form-text validation pb-1">{{ $message }}</div>
    @enderror
</div>
