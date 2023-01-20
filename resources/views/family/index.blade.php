@extends('layouts.dashboard.main')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2>Family</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Family</li>
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
                                        <li><a href="#largeModal" data-toggle="modal" data-target="#largeModal">Add New Family</a></li>



                                    
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
                                        <th>Family Name</th>
                                        <th>Family Head</th>
                                        <th>Head: No1</th>
                                        <th>Head: No2</th>
                                       
                                        <th>Action</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fams as $fam)
                                    <tr>
                                        <td>{{$fam->fid}}</td>
                                        <td>{{$fam->fam_name}}</td>
                                        <td>{{$fam->fam_head}}</td>
                                        <td>{{$fam->head_no2}}</td>
                                        <td>{{$fam->head_no2}}</td>
                                        
                                        
                                        <td>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#EditFamilyModal{{$fam->fid}}"><i class="icon-pencil"></i></button>
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
<h4 class="title" id="largeModalLabel">Add New Family</h4>
</div>
<div class="modal-body"> 
<form class="actionform" action="{{ route('add_family') }}" method="POST">
@csrf
<div class = "row">
<div class="col-md-12">
<div class="form-group">
<label >Family Name</label>
<input type="text" class="form-control"  name="fam_name" required>

</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Family Head</label>
<input type="text" class="form-control"  name="fam_head"  required>
</div>

</div>
<!--  -->

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Head Cell #1</label>
<input type="text" class="form-control"  name="phone1"  required>
</div>
</div>
<!--  -->
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Head Cell #2</label>
<input type="text" class="form-control"  name="phone2">
</div>
</div>
<!--  -->
</div><!-- end of row  -->

</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">ADD FAMILY</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
</div>
</form>
</div>
</div>
</div>

<!-- Ending of Large Modal -->

@foreach($fams as $fam)
<div class="modal fade" id="EditFamilyModal{{$fam->fid}}" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<form action="{{ route('edit_family',[$fam->fid]) }}" method="POST">
                @csrf
                @METHOD('PATCH')
<div class="modal-header">
<h4 class="title" id="largeModalLabel">Edit Family({{$fam->fid}})</h4>
</div>
<div class="modal-body"> 

<div class = "row">
<div class="col-md-12">
<div class="form-group">
<label class="rlb">Family Name</label>
<input type="text" class="form-control"  name="fam_name"  value="{{$fam->fam_name}}" required>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Family Head</label>
<input type="text" class="form-control"  name="fam_head" value="{{$fam->fam_head}}" required>
</div>
</div>
<!--  -->

<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Head Cell #1</label>
<input type="text" class="form-control"  name="phone1" value="{{$fam->head_no1}}" required>
</div>
</div>
<!--  -->
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
<label class="rlb">Head Cell #2</label>
<input type="text" class="form-control"  name="phone2" value="{{$fam->head_no2}}">
</div>
</div>
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
