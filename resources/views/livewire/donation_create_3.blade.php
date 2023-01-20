<form>
<div class="form-group mb-3">

<label for="categoryName">Funeral For:</label>
<!-- <input type="text" class="form-control @error('ben_name') is-invalid @enderror" id="categoryName" placeholder="Enter Beneficiary name" wire:model="ben_name"> -->
<select class="form-control @error('d_name') is-invalid @enderror" id="d_name1" wire:model="d_name" required>
@foreach ($deaths as $client)
<option value = "{{ $client->did }}">{{ $client->dead->d_name }}</option>
@endforeach
</select>
@error('d_name') <span class="text-danger">{{ $message }}</span>@enderror
</div>


<div class="form-group mb-3">
<label for="categoryName">Beneficiary Name:</label>
<select class="form-control @error('ben_name') is-invalid @enderror" id="ben_name1" wire:model="ben_name" required>
@foreach ($benefits as $sta)
<option value = "{{ $sta->id }}">{{ $sta->ben_type }}</option>
@endforeach
</select>
@error('ben_name') <span class="text-danger">{{ $message }}</span>@enderror
</div>

<div class="form-group mb-3">
<label for="categoryName">Currency:</label>
<select class="form-control @error('curr_name') is-invalid @enderror" id="curr_name1" wire:model="curr_name">
@foreach ($currency as $curr)
<option value = "{{ $curr->currid }}">{{ $curr->curr_name }}</option>
@endforeach
</select>
@error('curr_name') <span class="text-danger">{{ $message }}</span>@enderror
</div>

<div class="form-group mb-3">
        <label for="categoryName">Donor Name:</label>
        <input type="text" class="form-control @error('donor_name') is-invalid @enderror" id="donor_name1" placeholder="Enter Name" wire:model="donor_name">
        @error('donor_name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group mb-3">
        <label for="categoryName">Donor Phone:</label>
        <input type="text" class="form-control @error('donor_phone') is-invalid @enderror" id="donor_phone1"  wire:model="donor_phone">
        @error('donor_phone') <span class="text-danger">{{ $message }}</span>@enderror
    </div>


    <div class="form-group mb-3">
        <label for="categoryName">Amount:</label>
        <input type="text" class="form-control @error('amt') is-invalid @enderror" id="amt1"  wire:model="amt">
        @error('amt') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

<div class="form-group mb-3">
<label for="categoryDescription">Description:</label>
<textarea class="form-control @error('description') is-invalid @enderror" id="categoryDescription" wire:model="description" placeholder="Enter Description"></textarea>
@error('description') <span class="text-danger">{{ $message }}</span>@enderror
</div>


<div class="d-grid gap-2">
<button wire:click.prevent="store()" class="btn btn-success btn-block">Save</button>
</div>
</form>