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
    <h1 class="h3 mb-4 text-gray-800">Earnings</h1>

    <div class="row">
        <div class="col-lg-12">
            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 justify-content-between d-sm-flex  mb-4">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings List</h6>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Add
                    </button>
                </div>
                <div class="card-body">
                    
                    <table class="table table-bordered" id="table1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Work</th>
                                <th>Pay</th>
                                <th>Pay Start</th>
                                <th>Pay End</th>
                                <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($earnings as $earning)
                            <tr>
                                <td>{{ $earning->id }}</td>
                                <td>{{ $earning->work_name }}</td>
                                <td>{{ $earning->pay }}</td>
                                <td>{{ $earning->start_pay }}</td>
                                <td>{{ $earning->end_pay }}</td>
                                <td>
                                    <form action="{{route('earning.destroy', [$earning->id])}}" method="post">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-warning" 
                                                data-toggle="modal" 
                                                data-target="#editExpense" 
                                                data-id="{{ $earning->id }}" 
                                                data-work="{{ $earning->work_id}}" 
                                                data-pay="{{ $earning->pay}}" 
                                                data-pay-start="{{ $earning->start_pay}}" 
                                                data-pay-end="{{ $earning->end_pay}}" 
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
                        <form method="POST" enctype="multipart/form-data" action="{{route('earning.store')}}">
                            {!! csrf_field() !!}
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Earning</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Work</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="txtWorkName" required="true">
                                                        <option value="0" selected>Open this select menu</option>
                                                        @foreach($works as $work)
                                                            <option value="{{ $work->id }}">{{ $work->work_name }}</option>
                                                        @endforeach
                                                      </select>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Pay (only digits)</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" pattern="[0-9]*" name="txtPay" placeholder="">
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Start of Pay</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control" name="txtSp" placeholder="">
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">End of Pay</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control" name="txtEp" placeholder="">
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Earning</h5>
                        <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="editForm">
                            {!! csrf_field() !!}
                            {{ method_field('PUT') }}
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Earning</label>
                                        <div class="col-sm-10">
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="txtWorkName" name="txtWorkName" required="true">
                                                <option value="0" selected>Open this select menu</option>
                                                @foreach($works as $work)
                                                    <option value="{{ $work->id }}">{{ $work->work_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pay</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="txtPay" id="txtPay" placeholder="">
                                            <input type="hidden" class="form-control" name="txtEarningId" id="txtEarningId" placeholder="">
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Start of Pay</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" name="txtSp" id="txtSp" placeholder="">
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">End of Pay</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" name="txtEp" id="txtEp" placeholder="">
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
      var work = button.data('work');
      var pay = button.data('pay');
      var pay_start = new Date(button.data('pay-start'));
      var pay_end = new Date(button.data('pay-end'));
      var date_of_pay = button.data('dop');
      var start_date = (pay_start.getFullYear() + '-' + ((pay_start.getMonth() > 8) ? (pay_start.getMonth() + 1) : ('0' + (pay_start.getMonth() + 1))) + '-' + ((pay_start.getDate() > 9) ? pay_start.getDate() : ('0' + pay_start.getDate())));
    //   alert(start_date)
      var end_date = (pay_end.getFullYear() + '-' + ((pay_end.getMonth() > 8) ? (pay_end.getMonth() + 1) : ('0' + (pay_end.getMonth() + 1))) + '-' + ((pay_end.getDate() > 9) ? pay_end.getDate() : ('0' + pay_end.getDate())));
      $(".modal-body #txtEarningId").val(id);
      $(".modal-body #txtWorkName").val(work);
      $(".modal-body #txtPay").val(pay);
      $(".modal-body #txtSp").val(start_date);
      $(".modal-body #txtEp").val(end_date);
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

    document.querySelector('input[name="txtPay"]').addEventListener('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

  </script>

  

<script>
  $('#editForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#txtEarningId').val();

        $.ajax({
            type: "PUT",
            url: `/earning/${id}`,
            data: $('#editForm').serialize(),
            success: function(response) {
                location.reload();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>
@endsection

