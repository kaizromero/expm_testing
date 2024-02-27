@extends('layouts.app')

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css')}}">

@endsection

@section('javascript')

<script type="text/javascript" charset="utf8" src="{{asset('https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" charset="utf8" src="{{asset('https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $('#table1').DataTable({
            "ordering": false
        });
    });

</script>
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- EDit --}}
    

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Category</h1>

    <div class="row">
        <div class="col-lg-12">
            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 justify-content-between d-sm-flex  mb-4">
                    <h6 class="m-0 font-weight-bold text-primary">User List</h6>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Add
                    </button>
                </div>
                <div class="card-body">
                    
                    <table class="table table-bordered" id="table1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <form action="{{route('category.destroy', [$user->id])}}" method="post">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-warning" 
                                                data-toggle="modal" 
                                                data-target="#editExpense" 
                                                data-id="{{ $user->id }}" 
                                                data-cat="{{ $user->name}}" 
                                                type="button">Edit</button>
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form> 
                                </td>
                            </tr>
                            @endforeach
                        </tfoot>
                    </table>
                </div>
                <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form method="POST" enctype="multipart/form-data" action="{{route('user.store')}}">
                            {!! csrf_field() !!}
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                                                <div class="col-sm-10">
                                                   
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="txtRole" required="true">
                                                        <option value="0" selected>Open this select menu</option>
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="txtName" placeholder="">
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" name="txtEmail" placeholder="">
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" name="txtPassword" placeholder="">
                                                </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Modal -->
                <!-- Edit Modal-->
                <div class="modal fade" id="editExpense" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                        <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="editForm">
                        {!! csrf_field() !!}
                        {{ method_field('PUT') }}
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                       
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Details</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="txtDetails" id="txtDetails" placeholder="">
                                        <input type="text" class="form-control" name="txtExpenseId" id="txtExpenseId" placeholder="">
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Store</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="txtStore" id="txtStore" placeholder="">
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="txtPrice" id="txtPrice" placeholder="">
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Remarks</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="txtRemarks" id="txtRemarks" placeholder="">
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Date of Pay</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="txtDop" id="txtDop" placeholder="">
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-secondary" type="submit">Save changes</button>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
                <!-- End Edit Modal-->
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script>
    $('#editExpense').on('show.bs.modal', function (event) {
  
      var button = $(event.relatedTarget)
      var id = button.data('id');
      var id = button.data('id');
      var details = button.data('details');
      var store = button.data('store');
      var price = button.data('price');
      var remarks = button.data('remarks');
      var date_of_pay = button.data('dop');
      var cat = button.data('cat');
      var dop = button.data('dop');
      var date = new Date(dop);
      var mydate = (date.getFullYear() + '-' + ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '-' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())));
      alert(mydate)
    $(".modal-body #txtCategoryName").val(cat);
      $(".modal-body #txtExpenseId").val(id);
      $(".modal-body #txtDetails").val(details);
      $(".modal-body #txtStore").val(store);
      $(".modal-body #txtPrice").val(price);
      $(".modal-body #txtRemarks").val(remarks);
      $(".modal-body #txtDop").val(mydate);
    // console.log('modal');
    // });

    // $('button').click(function(){
    //     $('#editCategory').modal({show: true});
    });

    // $(document).on("click", "#editCategory", function () {
    //     var button = $(event.relatedTarget)
    //     var id = button.data('id');
    //     var name = button.data('name');
    //     $(".modal-body #txtCategoryId").val(id);
    //     $(".modal-body #txtCategoryName").val(name);
    //     // console.log('modal');
    // });

  </script>

  

<script>
  
  
    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        
        var id = $('#txtCategoryId').val();
        
        $.ajax({
            type:"PUT",
            url: "/category/"+id,
            data: $('#editForm').serialize(),
            success: function(response){
                
                // $('#editDivision').modal('hide.bs.modal')
                alert('data updated');
                location.reload();
            },
            error: function(error) {
                console.log(error);
            }
        })
        // $('#editDivision').modal('hide');
        //     $('#editDivision').on('hide.bs.modal', function (e) {
        //         console.log('ok');
        //     });
    })
</script>
@endsection

