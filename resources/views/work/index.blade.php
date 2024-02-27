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
        $('#table1').DataTable();
    });

</script>
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    {{-- EDit --}}
    

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Work</h1>

    <div class="row">
        <div class="col-lg-12">
            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 justify-content-between d-sm-flex  mb-4">
                    <h6 class="m-0 font-weight-bold text-primary">Work List</h6>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Add
                    </button>
                </div>
                <div class="card-body">
                    
                    <table class="table table-bordered" id="table1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Work Name</th>
                                <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($works as $work)
                            <tr>
                                <td>{{ $work->id }}</td>
                                <td>{{ $work->work_name }}</td>
                                <td>
                                    <form action="{{route('work.destroy', [$work->id])}}" method="post">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-warning" 
                                                data-toggle="modal" 
                                                data-target="#editWork" 
                                                data-id="{{ $work->id }}" 
                                                data-name="{{ $work->work_name}}" 
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
                        <form method="POST" enctype="multipart/form-data" action="{{route('work.store')}}">
                            {!! csrf_field() !!}
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Work</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                        <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Work name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="txtWorkName" placeholder="">
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
                <div class="modal fade" id="editWork" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Work</h5>
                        <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="editForm">
                        {!! csrf_field() !!}
                        {{ method_field('PUT') }}
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Work Name</label>
                                        <input class="form-control" id="txtWorkName" name="txtWorkName" type="text">
                                        <input class="form-control" id="txtWorkId" name="txtWorkId" type="hidden">
                                    </div>
                                    </div>
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
    $('#editWork').on('show.bs.modal', function (event) {
  
      var button = $(event.relatedTarget)
      var id = button.data('id');
      var name = button.data('name');
      $(".modal-body #txtWorkId").val(id);
      $(".modal-body #txtWorkName").val(name);
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
        
        var id = $('#txtWorkId').val();
        
        $.ajax({
            type:"PUT",
            url: "work/"+id,
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

