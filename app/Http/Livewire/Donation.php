<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nsawa;
use App\Models\Beneficiary;
use App\Models\FuneralDetail;
use App\Models\Funeral;
use App\Models\Death;
use App\Models\Currency;
use Auth;
use Carbon\Carbon;

class Donation extends Component
{
    public $payments, $d_name, $f_name, $curr_name, $benefit_id,$amt, $ben_name,$pkid,$nid;
    public $benefits,$currency,$deaths,$description,$donor_name,$donor_phone,$posts,$receipt_no; 
    public $updateCategory = false;


    protected $listeners = [
    'deleteCategory'=>'destroy'
    ];

    // Validation Rules
    protected $rules = [
        'donor_name'=>'required',
        'donor_phone'=>'required',
        'd_name'=>'required',
        'amt'=>'required',
        'ben_name'=>'required',
        
    ];

  public function mount($nid)
  {
    $this->nid = $nid;
    
  }
    public function render()
    {
        // $random = mt_rand(1000, 9999);
        // $this->receipt_no = $random;
        // dd($this->nid);
        $this->deaths = FuneralDetail::select('*')->with(['dead'])
        ->where('fid','=',$this->nid)
        ->where('deleteflag','=','0')->get();
    
        $this->currency = Currency::all();
        $this->benefits = Beneficiary::all();

        $this->payments = Nsawa::select('*')->limit(10)
        ->where('capture_id','=',Auth::user()->userid)
        ->orderBy('pkid','desc')->get();
        return view('livewire.donation');
    }

    public function resetFields(){
        $this->f_name = '1';
        $this->d_name = '';
        $this->curr_name = '';
        $this->benefit_id = '';
        $this->amt = '';
        $this->ben_name = '';
        $this->description = '';
        $this->donor_name = '';
        $this->donor_phone = '';
        $this->receipt_no = '';
    }

    public function store(){

        // Validate Form Request
        $this->validate();

        try{
            // Create Doation
            // dd($this->d_name);
            $random = mt_rand(1000, 9999);
            $hash = uniqid();

            Nsawa::create([
                'fid'=>2,
                'did'=>$this->d_name,

                'currid'=>$this->curr_name,
                'benefit_id'=>$this->ben_name,
                'userid'=>Auth::user()->userid,
                'amt'=>$this->amt,
                'ben_name'=>$this->ben_name,
                'inv_no'=>$random,
                'description'=>$this->description ,
                'donor_name' => $this->donor_name ,
                'donor_phone' => $this->donor_phone,
                'deleteflag'=>0,
                'hash'=>$hash,
                'capture_id'=>Auth::user()->userid,
            ]);
    
// send sms
 // $emessage = "Hi! ". $user->name .", Your account has been created. Please click on the button below to login your account with this password: ". $password .". You will be required to change your password at first logon.";
$emessage = "Hi! ". $this->donor_name .", Thank you for your donation to support our funeral.";
$phone= $this->donor_phone;
$fname = $this->donor_name;
// $link = URL('/login');
$amount = $this->amt;
//  $this->email($email, $title, $emessage, $link);

 $this->send_sms($phone,$amount,$fname);
// end of sms sends

// Set Flash Message
session()->flash('success','Donation received Successfully!!');

// Reset Form Fields After Creating Category
$this->resetFields();

}catch(\Exception $e){
// Set Flash Message
session()->flash('error','Something goes wrong while saving donations!!');

// Reset Form Fields After Creating Category
$this->resetFields();
}
}

    public function edit($id){
        $category = Nsawa::findOrFail($id);
     
        $this->f_name= $category->fid;
        $this->d_name= $category->did;
        $this->curr_name= $category->currid;
        $this->benefit_id= $category->benefit_id;
        $this->amt = $category->amt;

        $this->ben_name = $category->ben_name;

        $this->description = $category->description;
        $this->donor_name = $category->donor_name;
        $this->donor_phone = $category->donor_phone;
        $this->pkid = $category->pkid;
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
            Nsawa::find($this->pkid)->fill([
                'fid'=>$this->f_name,
                'did'=>$this->d_name,
                'currid'=>$this->curr_name,
                'benefit_id'=>$this->benefit_id,
                'userid'=>Auth::user()->userid,
                'amt'=>$this->amt,
                'ben_name'=>$this->ben_name,
                'description'=>$this->description ,
                'donor_name' => $this->donor_name ,
                'donor_phone' => $this->donor_phone,
            ])->save();

            session()->flash('success','Doantion Updated Successfully!!');
    
            $this->cancel();
        }catch(\Exception $e){
            session()->flash('error','Something goes wrong while updating category!!');
            $this->cancel();
        }
    }

    public function destroy($id){
        try{
            Nsawa::find($id)->delete();
            session()->flash('success',"Category Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting category!!");
        }
    }



    public function send_sms($phone,$amount,$fname)
    {
    $random = mt_rand(1000, 9999);
    $find_dname = Death::find($this->d_name);

    $endPoint = 'https://api.mnotify.com/api/sms/quick';
    $api_key = 'J0QCzxooW6yDfUp0yqtNhNNvJIsAwhwghnSRUhfRoNuDI';
    $sender_id='mbrokerApp';
    $url = $endPoint . '?key=' . $api_key;
    $data = [
       'recipient' => [$phone, '0559989228'],
       'sender' => 'M-Funeral',
       'message' => 'Dear ' .$fname .', Thank you for donating an amout of  '.$amount . ' GHC towards the burial and funeral of our beloved one '
       . $find_dname->d_name,
       'is_schedule' => 'false',
       'schedule_date' => ''
    ];

    $ch = curl_init();
    $headers = array();
    $headers[] = "Content-Type: application/json";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $result = curl_exec($ch);
    $result = json_decode($result, TRUE);
    // dd($result);
    curl_close($ch);
    }



}