<div>
    <div class = "row">
    <div class="col-md-4">
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
                    @include('livewire.benefit_update')
                @else
                    @include('livewire.benefit_create')
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Creation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($benefits) > 0)
                                @foreach ($benefits as $category)
                                    <tr>
                                        <td>
                                            {{$category->ben_type}}
                                        </td>
                                        <td>
                                            {{$category->created_at}}
                                        </td>
                                        <td>
                                            <button wire:click="edit({{$category->id}})" class="btn btn-primary btn-sm">Edit</button>
                                            <!-- <button onclick="deleteCategory({{$category->id}})" class="btn btn-danger btn-sm">Delete</button> -->
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" align="center">
                                        No Beneficiary Type Found.
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
        function deleteCategory(id){
            if(confirm("Are you sure to delete this record?"))
                window.livewire.emit('deleteCategory',id);
        }
    </script>
</div>