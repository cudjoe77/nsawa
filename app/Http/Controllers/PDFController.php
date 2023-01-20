<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PDF;
Use Alert;

class PDFController extends Controller
{ public function generatePDF()
    {
        $users = User::get();
  
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'users' => $users
        ]; 
        alert('Title','Lorem Lorem Lorem', 'success');
        
        $pdf = PDF::loadView('myPDF', $data);

        Alert::success('Congrats', 'You\'ve Successfully Registered');
        return $pdf->download('itsolutionstuff.pdf');
    }
}
