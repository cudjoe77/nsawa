<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Funeral as Funerals;

class Setfuneral extends Component
{

    public $students, $name, $email, $mobile, $student_id;
    public $isModalOpen = 0;

  
    public function render()
    {
      
        $this->students  = Funerals::select('*')->with(['dead','detail'])
        ->withCount('detail')
        ->orderBy('updated_at','desc')
        ->get()->where('deleteflag','=' ,'0');
        
        return view('livewire.setfuneral');
    }


    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->student_id = '';
    }


    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);
    
        Students::updateOrCreate(['id' => $this->student_id], [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ]);
        session()->flash('message', $this->student_id ? 'Student updated.' : 'Student created.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }
    public function edit($id)
    {
        $student = Students::findOrFail($id);
        $this->student_id = $id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->mobile = $student->mobile;
    
        $this->openModalPopover();
    }
    


    public function delete($id)
    {
        Students::find($id)->delete();
        session()->flash('message', 'Student deleted.');
    }




}
