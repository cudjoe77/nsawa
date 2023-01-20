@extends('layouts.dashboard.main')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2>Report Death</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Report Death</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card open_task">
                        <div class="header">
                            <!-- <h2>Families</h2> -->
                        <div class = "col-4">
                        <form id="navbar-search" class="navbar-form search-form">
                            <input value="" class="form-control" placeholder="Search here..." type="text">
                            <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                        </form>
</div>
                            <ul class="header-dropdown">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right animated bounceIn">
                                        <!-- <li><a href="#exampleModal" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New</a></li> -->
                                        <li><a href="#largeModal" data-toggle="modal" data-target="#largeModal">Report Death</a></li>



                                    
                                        <li><a href="javascript:void(0);">Go to Dashboard</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                       
    <div class="body">
<!-- start from here -->
<div class="col-md-12">
                    <div class="card">
                        <!-- <div class="header">
                            <h2>Basic Example 8</h2>
                        </div> -->
                        <div class="body">
                        <div class="table-responsive">
                        <table class="table center-aligned-table">
                        <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Deceased Name</th>
                                        <th>Date of Death</th>
                                        <th>Place of Death</th>
                                        <th>Cause of Death</th>
                                        <th>Deceased Family</th>
                                        <!-- <th>Funeral Date</th> -->
                                        <th>Action</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($deaths as $fam)
                                    <tr>
                                        <td>{{$fam->did}}</td>
                                        <td>{{$fam->d_name}}</td>
                                        <td>{{$fam->d_date}}</td>
                                        <td>{{$fam->d_place}}</td>
                                        <td>{{$fam->cause->cause_name}}</td>
                                        <td>{{$fam->family->fam_name}}</td>
                                       

                                        <!-- <td>{{$fam->fundetail->pluck('funeral_date')->implode(', ')}}</td>
                                         -->
                                        
                                        <td>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#EditDeathModal{{$fam->did}}"><i class="icon-pencil"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="icon-trash"></i></button>
                                    </td>
                                    </tr>
                                   @endforeach
                                    </tbody>
                                </table>
                            </div>
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
<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="title" id="largeModalLabel">Report Death</h4>
</div>
<div class="modal-body"> 
<form class="actionform" action="{{ route('add_death') }}" method="POST">
@csrf
<div class = "row">
<div class="col-md-12">
<div class="form-group">
<label >Deceased Name</label>
<input type="text" class="form-control"  name="d_name" required>

</div>
</div>

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Date of Death</label>
<input type="date" class="form-control"  name="d_date"  required>
</div>

</div>
<!--  -->

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Place of Death</label>
<input type="text" class="form-control"  name="d_place"  required>
</div>
</div>
<!--  -->

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label for="sel1" class = "control-label"><b>Cause of Death</b></label>
<select class="form-control" id="policy_status" name="d_cause" required>
<option></option>
@foreach ($causes as $sta)
<option value = "{{ $sta->cid }}">{{ $sta->cause_name }}</option>
@endforeach
</select>
</div>
</div>


<!--  -->
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Deceased's Family</label>
<select class="form-control" id="policy_status" name="d_family" required>
<option></option>
@foreach ($fams as $sta)
<option value = "{{ $sta->fid }}">{{ $sta->fam_name }}</option>
@endforeach
</select>
</div>
</div>
<!--  -->
</div><!-- end of row  -->

</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">REPORT DEATH</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
</div>
</form>
</div>
</div>
</div>

<!-- Ending of Large Modal -->

@foreach($deaths as $fam)
<div class="modal fade" id="EditDeathModal{{$fam->did}}" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<form action="{{ route('edit_death',[$fam->did]) }}" method="POST">
                @csrf
                @METHOD('PATCH')
<div class="modal-header">
<h4 class="title" id="largeModalLabel">Edit Death Sheet</h4>
</div>
<div class="modal-body"> 

<div class = "row">
<div class="col-md-12">
<div class="form-group">
<label >Deceased Name</label>
<input type="text" class="form-control"  name="d_name" value = "{{$fam->d_name}}" required>

</div>
</div>

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Date of Death</label>
<input type="date" class="form-control"  name="d_date" value = "{{$fam->d_date}}" required>
</div>

</div>
<!--  -->

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Place of Death</label>
<input type="text" class="form-control"  name="d_place"  value = "{{$fam->d_place}}" required>
</div>
</div>
<!--  -->

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label for="sel1" class = "control-label"><b>Cause of Death</b></label>
<select class="form-control" id="policy_status" name="d_cause" required>
<option></option>
@foreach ($causes as $sta)
<option value = "{{ $sta->cid }}"@if($fam->d_cause==$sta->cid)selected = "selected" @endif>{{ $sta->cause_name }}</option>
@endforeach
</select>
</div>
</div>


<!--  -->
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Deceased's Family</label>
<select class="form-control" id="policy_status" name="d_family" required>
<option></option>
@foreach ($fams as $sta)
<option value = "{{ $sta->fid }}"@if($sta->fid==$fam->d_family) Selected = "selected" @endif>{{ $sta->fam_name }}</option>
@endforeach
</select>
</div>
</div>
<!--  -->
<!--  -->
</div><!-- end of row  -->

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            </div>
            </form>
        </div>

    </div>
</div>


@endforeach
@endsection
