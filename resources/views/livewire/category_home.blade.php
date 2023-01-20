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
                            <li class="breadcrumb-item active">Categories</li>
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
                        <div class="body">
                        <!-- <div class="table-responsive"> -->

@livewire('category')



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
