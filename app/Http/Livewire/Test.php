<?php
namespace App\Http\Livewire;
use Livewire\Component;
class Test extends Component
{
// public $name, $product_id;
// public Product $product;

public function mount() {
  $getProductID = explode('/', url()->current());
  $this->product_id = end($getProductID);
}

public function update() {
   // For simplicity i just update product name
   Product::find($this->product_id)->update(['name' => $this->name]);

   // I call event so ProductIndex listen it and it will auto update the productIndex list
   $this->emit('productUpdated');
}

public function render() {
   return view('livewire-edit-product', ['product' => Product::find($this->product_id)]);
}






}