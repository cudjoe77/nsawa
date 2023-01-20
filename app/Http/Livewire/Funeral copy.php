<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Nsawa;
use App\Models\Beneficiary;
use App\Models\FuneralDetail;
use App\Models\Funeral as Funerals;
use App\Models\Currency;
use Auth;
use Carbon\Carbon;

class Funeral extends Component
{
protected $listeners = ['productUpdated'];

public function productUpdated() {
  // Just Blank
}

public function render() {
return view('your-livewire-product-index', ['products' => Product::all()]);
}
    // public function render()
    // {
    //     return view('livewire.funeral');
    // }
}
