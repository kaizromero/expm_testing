@extends('layouts.app')

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css')}}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    /* Custom CSS for adding indentation to the alert */
    .indented-alert {
        display:flex;  /* Adjust the padding as needed */
    }
</style>
@endsection

@section('javascript')

<script type="text/javascript" charset="utf8" src="{{asset('https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" charset="utf8" src="{{asset('https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js')}}"></script>


@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    
    {{-- EDit --}}
    

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Expenses</h1>

    <div class="row">
        <div class="col-lg-12">
            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 justify-content-between d-sm-flex  mb-4">
                    <h6 class="m-0 font-weight-bold text-primary align-self-center">Expenses Multiple Add</h6>
                    <div class="d-flex justify-content-end bd-highlight mb-3">
                        <div class="p-2 bd-highlight">
                            {{-- <button type="button" class="btn btn-primary" onclick="addRow()" data-toggle="modal" data-target="#exampleModal">
                                Add Row
                            </button> --}}
                            <a href="{{route('expenses.create')}}" class="btn btn-primary"> Multiple Add</a>
                        </div>
                    </div>
                </div>

                <form action="{{route('multi.store')}}" method="POST">
                    @csrf 
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
        
                        @if (Session::has('success'))
                            <div class="alert alert-success indented-alert text-center">
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                    <div class="card-body">
                        <table id="table" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Details</th>
                                    <th>Store</th>
                                    <th>Price</th>
                                    <th>Remarks</th>
                                    <th>Date of Pay</th>
                                    <th>Action</th>
                            </thead>
                            <tr>
                                <td>
                                    <select class="form-select form-select-sm" aria-label="form-select-sm example" name="inputs[1][txtCategoryId]" required="true">
                                        <option value="0" selected>Open this select menu</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="inputs[1][txtDetails]" placeholder="Enter Details" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="inputs[1][txtStore]" placeholder="Enter Store" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="inputs[1][txtPrice]" placeholder="Enter Price" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="inputs[1][txtRemarks]" placeholder="Enter Price" class="form-control">
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="inputs[1][txtDop]" placeholder="">
                                </td>
                                <td>
                                    <button  type="button" name="add" id="add" class="btn btn-success">Add more</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div align="center">
                        <input type="submit" class="btn btn-primary" value="Add all">
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>

    // $('#add').click(function() {
    //     alert('asda')
    // })
        var categories = @json($categories);
        var i = 1;
        $('#add').click(function() {
            ++i;
            var selectOptions = '';
            categories.forEach(function(category) {
                selectOptions += '<option value="' + category.id + '">' + category.category_name + '</option>';
            });
            $('#table').append(
                `<tr>
                    <td>
                        <select class="form-select form-select-sm" aria-label="form-select-sm example" name="inputs[${i}][txtCategoryId]" required="true">
                            <option value="0" selected>Open this select menu</option>
                            ` + selectOptions + `
                        </select>
                    </td>
                    <td>
                        <input type="text" name="inputs[${i}][txtDetails]" placeholder="Enter Details" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="inputs[${i}][txtStore]" placeholder="Enter Store" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="inputs[${i}][txtPrice]" placeholder="Enter Price" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="inputs[${i}][txtRemarks]" placeholder="Enter Price" class="form-control">
                    </td>
                    <td>
                        <input type="date" class="form-control" name="inputs[${i}][txtDop]" placeholder="">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-table-row">Remove</button>
                    </td>
                </tr>`
            );
        });

        $(document).on('click', '.remove-table-row', function() {
            $(this).parents('tr').remove();
        });
</script>


@endsection