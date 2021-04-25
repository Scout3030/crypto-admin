<div>
    <form wire:submit.prevent="update" class="formLogin">
        <div class="mb-3">
            <label class="form-label" for="first-name">Permission Name</label>
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

        <div class="col-md-12 d-flex flex-row-reverse">
          <button type="submit" class="btn btn-primary">@if($permission) Update @else Submit @endif</button>
          <a href="{{route('permissions.index')}}" class="btn btn-outline-info">Cancel</a>
        </div>
    </form>
</div>
