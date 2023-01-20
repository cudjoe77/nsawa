<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\Funeral as Funerals;



class Funeral extends Component
{

public $nid, $funs,$causes,$relations,$users,$fams,$deaths;

    public function render()
    {
     
      $this->funs = Funerals::select('*')->with(['dead','detail'])
      ->withCount('detail')
      ->orderBy('updated_at','desc')->where('deleteflag','=' ,'0')
      ->get();

     

        return view('livewire.funeral_home');
    }



}
