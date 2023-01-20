<x-slot name="header">
<h2 class="text-center">Receive Donations</h2>
</x-slot>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
@if (session()->has('message'))
<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
role="alert">
<div class="flex">
<div>
<p class="text-sm">{{ session('message') }}</p>
</div>
</div>
</div>
@endif
<!-- <button wire:click="create()"
class=" btn btn-primary ">

Create Student
</button> -->
@if($isModalOpen)
@include('livewire.setfuneral_modal')
@endif
<div class="table-responsive">
<table class="table">
<thead>
<tr class="bg-gray-100">
<th class="px-4 py-2 w-20">No.</th>
<th class="px-4 py-2">Funeral Date</th>
<th class="px-4 py-2">No of Deceased</th>
<th class="px-4 py-2">Town</th>
<th class="px-4 py-2">Venue</th>
<th class="px-4 py-2">Action</th>
</tr>
</thead>
<tbody>
@foreach($students as $fam)
<tr>
<td class="border px-4 py-2">{{ $fam->funeral_code }}</td>
<td class="border px-4 py-2">{{ date('d-M-y', strtotime($fam->funeral_date)) }}</td>
<td>
<a href = "#EditFuneralModal{{$fam->fid}}" data-toggle="modal" data-target="#EditFuneralModal{{$fam->fid}}">  view  | ({{$fam->detail_count?? "0"}} ) </a>
</td>
<!-- <td class="border px-4 py-2">{{ $fam->detail_count?? "0"}}</td> -->
<td class="border px-4 py-2">{{ $fam->town}}</td>
<td class="border px-4 py-2">{{ $fam->venue}}</td>

<td class="border px-4 py-2">
<a href = "{{route('get_nsawa',[$fam->fid])}}"
class=" btn btn-primary btn-sm ">Take Nsawa</a>
<!-- <button wire:click="delete({{ $fam->fid }})"
class=" btn btn-primary btn-sm">Delete</button> -->
</td>
<!-- @foreach($fam->detail as $dtl)
<tr>
<td>{{$dtl->detail_id}}</td>
<td>{{$dtl->dead->d_name?? "n/a"}}</td>
<td>{{$dtl->dead->d_date?? "n/a"}}</td>
<td>{{$dtl->dead->d_place?? "n/a"}}</td>
<td>{{$dtl->dead->family->fam_name?? "n/a"}}</td>

@endforeach -->

</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>

@foreach($students as $fam)
<div class="modal fade" id="EditFuneralModal{{$fam->fid}}" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<form action="{{ route('edit_funeral',[$fam->fid]) }}" method="POST">
                @csrf
                @METHOD('PATCH')
<div class="modal-header">
<h4 class="title" id="largeModalLabel">List of Deceased under code: ({{$fam->funeral_code}})</h4>
</div>
<div class="modal-body"> 
<div class = "row">

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
<!-- <th>Check</th> -->
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

<!-- <td>

<input type = "checkbox" name = "del[]" class = "form-control">
</td> -->

</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<!-- END OF FUNRAL DETAILS-->
<div class="modal-footer">
<!-- <button type="submit" class="btn btn-primary">SAVE CHANGES</button> -->
<button type="button" class="btn btn-danger float-right" data-dismiss="modal">CLOSE</button>
</div> 
<!--  -->
</div><!-- end of row  -->

</div>

</div>

</div>
</div>
<!-- Ending of update Modals -->

@endforeach
