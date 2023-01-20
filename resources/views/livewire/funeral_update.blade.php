<div>
<form wire:submit.prevent="update">
<input type="hidden" wire:model="product_id">
<input type="text" wire:model="name">
<input type="submit" value="save">
</form>
</div>