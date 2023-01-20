@extends('layouts.dashboard.main')
@section('content')
<div id="main-content">
<div class="container-fluid">
<div class="block-header">
<div class="row">
<div class="col-lg-5 col-md-8 col-sm-12">                        
<h2>Funeral Setup</h2>
</div>            
<div class="col-lg-7 col-md-4 col-sm-12 text-right">
<ul class="breadcrumb justify-content-end">
<li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
<li class="breadcrumb-item">Home</li>
<li class="breadcrumb-item active">Setup Funeral</li>
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
<li><a href="#largeModal" data-toggle="modal" data-target="#largeModal">Add New Funeral</a></li>

<li><a href="{{route('get_dashboard')}}">Go to Dashboard</a></li>
<!-- <li><a href="javascript:void(0);">Something else</a></li> -->
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
<!-- <th>ID</th> -->
<th>Date of Funeral</th>
<th>No of Deceased</th>
<th>Deceased Name(s)</th>
<th>Town</th>
<th>Venue</th>
<th>Contact Name</th>
<th>Contact Phone</th>

<th>Action</th>
<th></th>
</tr>
</thead>
<tbody>
@foreach($funs as $fam)
<tr>
<!-- <td>{{$fam->fid}}</td> -->
<td>
{{ date('d-M-y', strtotime($fam->funeral_date)) }}
<!-- {{$fam->funeral_date}} -->


</td>
<td>
  <a href = "#EditFuneralModal{{$fam->fid}}" data-toggle="modal" data-target="#EditFuneralModal{{$fam->fid}}">  {{$fam->detail_count?? "0"}} </a>
</td>
<td>{{$fam->funDeath->pluck('d_name')->implode(', ')}}</td>
<td>{{$fam->town}}</td>
<td>{{$fam->venue}}</td>
<td>{{$fam->contact_name}}</td>
<td>{{$fam->contact_phone}}</td>


<td>
<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#EditFuneralModal{{$fam->fid}}"><i class="icon-pencil"></i></button>
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
<h4 class="title" id="largeModalLabel">Setup Funeral</h4>
</div>
<div class="modal-body"> 
<form class="actionform" action="{{ route('add_funeral') }}" method="POST">
@csrf
<div class = "row">
    <!--  -->
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label for="sel1" class = "control-label"><b>Deceased Name</b></label>
<div class="multiselect_div">
<select id="multiselect2" name="d_name[]" class="multiselect multiselect-custom" multiple="multiple" required>

@foreach ($deaths as $sta)
<option value = "{{ $sta->did }}" checked>{{ $sta->d_name }} ({{ $sta->family->fam_name }})</option>
@endforeach
</select>
</div>
</div>
</div>


<!--  -->


<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Funeral Date</label>
<input type="date" class="form-control"  name="funeral_date"  required>
</div>

</div>
<!--  -->

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Town</label>
<input type="text" class="form-control"  name="town"  required>
</div>
</div>
<!--  -->
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Venue</label>
<input type="text" class="form-control"  name="venue"  required>
</div>
</div>
<!--  -->

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Contact Name</label>
<input type="text" class="form-control"  name="contact_name"  required>
</div>
</div>
<!--  -->
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Contact Phone</label>
<input type="text" class="form-control"  name="contact_phone"  required>
</div>
</div>
<!--  -->
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Comments</label>
<textarea type="text" class="form-control"  name="remarks" row = "4" required></textarea>
</div>
</div>

<!--  -->
</div><!-- end of row  -->

</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">SAVE FUNERAL</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
</div>
</form>
</div>
</div>
</div>

<!-- Ending of Large Modal -->

@foreach($funs as $fam)
<div class="modal fade" id="EditFuneralModal{{$fam->fid}}" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<form action="{{ route('edit_funeral',[$fam->fid]) }}" method="POST">
                @csrf
                @METHOD('PATCH')
<div class="modal-header">
<h4 class="title" id="largeModalLabel">Edit Funeral Sheet: Code: ({{$fam->funeral_code}})</h4>
</div>
<div class="modal-body"> 
<div class = "row">

<!--  -->
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label for="sel1" class = "control-label"><b>Selected Funerals</b></label>
<div class="multiselect_div">
<select id="multiselect2" name="d_name_2[]" class="multiselect multiselect-custom" multiple="multiple">

@foreach($fam->detail as $dtl)
@foreach ($deaths as $sta)

@if($sta->did==$dtl->dead->did)
<option value = "{{ $sta->did }}"selected = "selected" disabled>{{ $sta->d_name }} ({{ $sta->family->fam_name }})</option>

@endif
@endforeach
@endforeach


</select>
</div>
</div>

</div>

<!--  -->
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label for="sel1" class = "control-label"><b>Select Deceased (if not)</b></label>
<div class="multiselect_div">
<select id="multiselect2" name="d_name[]" class="multiselect multiselect-custom" multiple="multiple"  style = "color:red;">
@foreach ($deaths as $sta)
<option value = "{{ $sta->did }}" >{{ $sta->d_name }} ({{ $sta->family->fam_name }})</option>
@endforeach

</select>
</div>
</div>
</div>

<!--  -->
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Funeral Date</label>
<input type="date" class="form-control"  name="funeral_date" value = "{{$fam->funeral_date}}" required>
</div>

</div>
<!--  -->

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Town</label>
<input type="text" class="form-control"  name="town" value = "{{$fam->town}}" required>
</div>
</div>
<!--  -->
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Venue</label>
<input type="text" class="form-control"  name="venue"  value = "{{$fam->venue}}" required>
</div>
</div>
<!--  -->

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Contact Name</label>
<input type="text" class="form-control"  name="contact_name" value = "{{$fam->contact_name}}" required>
</div>
</div>
<!--  -->
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Contact Phone</label>
<input type="text" class="form-control"  name="contact_phone" value = "{{$fam->contact_phone}}" required>
</div>
</div>
<!--  -->
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Comments</label>
<textarea type="text" class="form-control"  name="remarks" row = "4" required>{{$fam->remarks}}</textarea>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">SAVE CHANGES</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
</div> 
</form>
<!-- FUNERAL DETAILS -->
<div class = "container">
<div class="table-responsive">
<table class="table center-aligned-table">
<thead>
<tr>
<th>ID</th>
<th>Deceased Name</th>
<th>Date of Death</th>
<th>Place Of Death</th>
<th>Family</th>
<th>Check</th>
</tr>
</thead>
<tbody>
@foreach($fam->detail as $dtl)
<tr>
<td>{{$dtl->detail_id}}</td>
<td>{{$dtl->dead->d_name?? "n/a"}}</td>
<td>{{$dtl->dead->d_date?? "n/a"}}</td>
<td>{{$dtl->dead->d_place?? "n/a"}}</td>
<td>{{$dtl->dead->family->fam_name?? "n/a"}}</td>

<td>

<input type = "checkbox" name = "del[]" class = "form-control">
</td>
<!-- <td>
<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#EditFuneralModal{{$fam->fid}}"><i class="icon-pencil"></i></button>
<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#DeleteDeceasedModal{{$dtl->detail_id}}"><i class="icon-trash"></i></button>
</td> -->
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<!-- END OF FUNRAL DETAILS-->

<!--  -->
</div><!-- end of row  -->

</div>

</div>

</div>
</div>
<!-- Ending of update Modals -->

@endforeach


<!-- Small Size -->

@foreach($fam->detail as $dtl)
<div class="modal fade" id="DeleteDeceasedModal{{$dtl->detail_id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <form action="{{ route('del_deceased',[$dtl->detail_id]) }}" method="POST">
                @csrf
                @METHOD('PATCH')
            <div class="modal-header">
                <h4 class="title" id="smallModalLabel">Delete Funeral</h4>
            </div>
            <div class="modal-body"> 
                <p>Are you sure you want to delete the Funeral..</p>
                <p><b>{{$dtl->dead->d_name?? "n/a"}}<b></p>
        </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
</form>
        </div>
    </div>
</div>
@endforeach


@endsection
