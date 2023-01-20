@extends('layouts.dashboard.main')
@section('content')
<div id="main-content">
<div class="container-fluid">
<div class="block-header">
<div class="row">
<div class="col-lg-5 col-md-8 col-sm-12">                        
<h2>Receive Donation/Nsawa</h2>
</div>            
<div class="col-lg-7 col-md-4 col-sm-12 text-right">
<ul class="breadcrumb justify-content-end">
<li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
<li class="breadcrumb-item">Home</li>
<li class="breadcrumb-item active">Donations</li>
</ul>
</div>
</div>
</div>

<!-- New Cards -->
<div class="row clearfix">

<div class="col-lg-12 col-md-12">
<div class="card open_task">
<div class="header">

<div class = "col-4">
<!-- <form id="navbar-search" class="navbar-form search-form">
<input value="" class="form-control" placeholder="Search here..." type="text">
<button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
</form> -->
<h6><b>Report Options</b></h6>
</div> 
<!-- AAAAYIVIVIVIV -->
<div class="body">
                            <div class="accordion" id="accordion">
                                <div>
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            By Deceased Person
                                            </button>
                                        </h5>
                                    </div>                                
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                           <!-- Funeral Details Here -->
                                           
                                           <form action="{{route('donation_bydeceased')}}" method="POST">
                                            @csrf
                                            <!-- @METHOD('PATCH') -->
                                            <div class = "row">
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <!-- <label for="sel1" class = "control-label"><b>Select Deceased</b></label> -->
                                        
                                        <select class="form-control"  name="d_name" id = "d_name" required>
                                        <option value = "0">Select Deceased Person</option>
                                       
                                        @foreach ($deaths as $sta)
                                        <option value = "{{ $sta->did }}">{{ $sta->d_name }} |  {{ $sta->family->fam_name }}</option>
                                        @endforeach
                                        </select>
                                        </div>
                                        
                                        </div>
                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                        <button type="submit" class="btn btn-primary">Report>></button>
                                        </div>
              
                                        </form>
                                           <!-- Ending of Funeral Details -->
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            By Benefeciaries
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            Beneficiary Details Here
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        By Funeral
                                        </button>
                                    </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                              Funeral Options here
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

<!-- AAAAYIVIIVIVII -->

</div> </div> </div> </div> 
<!-- End New Cards -->










<div class="row clearfix">

<div class="col-lg-12 col-md-12">
<div class="card open_task">
<div class="header">

<div class = "col-4">
<!-- <form id="navbar-search" class="navbar-form search-form">
<input value="" class="form-control" placeholder="Search here..." type="text">
<button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
</form> -->
<h6><b>Donation/Nsawa Details</b></h6>
</div> 
<ul class="header-dropdown">
<li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
<li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
<li class="dropdown">
<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
<ul class="dropdown-menu dropdown-menu-right animated bounceIn">

<li><a href="{{route('get_paymt_detail_excel')}}">To Excel</a></li>
<li><a href="{{route('get_paymt_detail_pdf')}}">To PDF</a></li>

<li><a href="{{route('get_dashboard')}}">Dashboard</a></li>

</ul>
</li>
</ul>
</div>

<div class="body">
<!-- start from here -->
<div class="col-md-12">
<div class="card">
<div class="body">
<!-- <div class="table-responsive"> -->

<div class="table-responsive">
<table class="table">
<thead>
<tr>

<th>Deceased Name</th>

<th>Amount</th>
</tr>
</thead>
<tbody>
@if (count($payments) > 0)
@foreach ($payments as $paymt)
<tr>

<!-- <td> {{ date('d-M-y', strtotime($paymt->created_at)) }}</td> -->
<td> {{$paymt->d_name?? "n/a"}}</td>

<td> {{number_format($paymt->revenue,2)}}</td>
</tr>
@endforeach
@else
<tr>
<td colspan="3" align="center">
No donations/nsawa Found.
</td>
</tr>
@endif
</tbody>
</table>
</div>

<!-- </div> -->
</div>
</div>
</div>

<!-- end from here -->

</div>
</div>
</div>

</div>
</div>
</div>

</div>

<!-- Modals -->

@endsection
