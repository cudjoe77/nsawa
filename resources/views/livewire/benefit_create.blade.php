<form>
    <div class="form-group mb-3">
        <label for="categoryName">Beneficiary Type:</label>
        <input type="text" class="form-control @error('ben_type') is-invalid @enderror" id="categoryName" placeholder="Enter Name" wire:model="ben_type">
        @error('ben_type') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <!-- <div class="form-group mb-3">
        <label for="categoryDescription">Description:</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="categoryDescription" wire:model="description" placeholder="Enter Description"></textarea>
        @error('description') <span class="text-danger">{{ $message }}</span>@enderror
    </div> -->
    <div class="d-grid gap-2">
        <button wire:click.prevent="store()" class="btn btn-success btn-block">Save</button>
    </div>
</form>