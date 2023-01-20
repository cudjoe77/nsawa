<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Beneficiary as Beneficiries;

class Benefit extends Component
{
    public $benefits, $ben_type, $benefit_id;
    public $updateCategory = false;

    protected $listeners = [
        'deleteCategory'=>'destroy'
    ];

    // Validation Rules
    protected $rules = [
        'ben_type'=>'required',
        // 'description'=>'required'
    ];

    public function render()
    {
        $this->benefits = Beneficiries::select('*')->get();
        return view('livewire.benefit');
    }

    public function resetFields(){
        $this->ben_type = '';
        // $this->description = '';
    }

    public function store(){

        // Validate Form Request
        $this->validate();

        try{
            // Create Category
            Beneficiries::create([
                'ben_type'=>$this->ben_type,
                'deleteflag'=>0,
             
                // 'description'=>$this->description
            ]);
    
            // Set Flash Message
            session()->flash('success','Beneficiary type Created Successfully!!');

            // Reset Form Fields After Creating Category
            $this->resetFields();
        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error','Something goes wrong while creating category!!');

            // Reset Form Fields After Creating Category
            $this->resetFields();
        }
    }

    public function edit($id){
        $category = Beneficiries::findOrFail($id);
        $this->ben_type = $category->ben_type;
        // $this->description = $category->description;
        $this->benefit_id = $category->id;
        $this->updateCategory = true;
    }

    public function cancel()
    {
        $this->updateCategory = false;
        $this->resetFields();
    }

    public function update(){

        // Validate request
        $this->validate();

        try{

            // Update category
            Beneficiries::find($this->benefit_id)->fill([
                'ben_type'=>$this->ben_type,
                // 'description'=>$this->description
            ])->save();

            session()->flash('success','Category Updated Successfully!!');
    
            $this->cancel();
        }catch(\Exception $e){
            session()->flash('error','Something goes wrong while updating category!!');
            $this->cancel();
        }
    }

    public function destroy($id){
        try{
            Beneficiries::find($id)->delete();
            session()->flash('success',"Category Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting category!!");
        }
    }
}