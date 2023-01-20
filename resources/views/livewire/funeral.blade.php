<div>
<div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Deceased Name</th>
                                <!-- <th>Family</th> -->
                                <th>Donor</th>
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
                                            <button onclick="deleteCategory({{$paymt->pkid}})" class="btn btn-danger btn-sm">Delete</button>
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
