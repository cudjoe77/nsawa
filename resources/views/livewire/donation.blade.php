<div>
    <div class = "row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif

                @if($updateCategory)
                    @include('livewire.donation_update')
                @else
                    @include('livewire.donation_create')
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>DeceasedName</th>
                                <!-- <th>Family</th> -->
                                <th>Donor Name</th>
                                <th>Amount</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($payments) > 0)
                                @foreach ($payments as $paymt)
                                    <tr>
                                      
                                        <td> {{$paymt->dead->d_name}}</td>
                                        
                                        <!-- <td>{{$paymt->dead->family->fam_name}}</td> -->
                                        <td> {{$paymt->donor_name}}</td>
                                        <td> {{number_format($paymt->amt,2)}}</td>
                                        <td> {{$paymt->donor_phone}}</td>
                                        <td>
                                            <button wire:click="edit({{$paymt->pkid}})" class="btn btn-primary btn-sm">Edit</button>
                                            <!-- <button onclick="deleteCategory({{$paymt->pkid}})" class="btn btn-danger btn-sm">Delete</button> -->
                                        </td>
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
            </div>
        </div>
    </div>

</div>
    <script>
        function deleteCategory(pkid){
            if(confirm("Are you sure to delete this record?"))
                window.livewire.emit('deleteCategory',pkid);
        }
    </script>
</div>