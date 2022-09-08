@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Authentcation</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Authentcation</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <a class="btn btn-blue" id="create_">
                        <span class="btn-icon-wrapper pr-2"> </span>
                        Create
                    </a>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">No</th>
                                    <th class="wd-15p border-bottom-0">Role</th>
                                    <th class="wd-10p border-bottom-0">permisions</th>
                                    <th class="wd-10p border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customerTypes as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->role_name }}</td>
                                        <td>{{ $row->permisions }}</td>
                                        <td>
                                            <a class="btn btn-blue edit" title="Edit" 
                                            data-id="{{ $row->id }}"
                                            data-permisions="{{ $row->permisions }}" 
                                            data-role_id="{{ $row->role_id }}">
                                                <i style="color:rgb(226, 210, 210);cursor: pointer" class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    {{-- create & update model --}}
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFormModal">Create Authentcation</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    {{-- class="needs-validation" novalidate="" --}}
                    <form  method="POST" action="{{ route('authentication.store') }}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">

                        <div class="row">

                            <div class="col-md-4">
                            <div class="form-group">
                                    <label >Role<span class="text-danger">*</span></label>
                                    <div>
                                        <select class="form-select" required name="role_id" id="role_id">
                                            <option selected disabled value="">Choose...</option>
                                            @foreach ($roles as $item)
                                            <option value="{{ $item->id }}" {{ (old('role_id') == $item->id) ? 'selected' : '' }}>{{ $item->role_name }}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:Tomato"> @error('role_id'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Permissions</label>
                                    <div>
                                        <textarea type="text" class="form-control" rows="1" id="permisions"
                                            name="permisions"
                                            placeholder="Enter the permisions">{{ old('permisions') }}</textarea>
                                    </div>
                                    <p style="color:Tomato"> @error('permisions'){{ $message }} @enderror
                                    </p>
                                </div>
                            </div>
                        </div>
                          
                        <div class="form-group" align="right">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
    $(document).ready(function () {

        // show model back end validate
        if (!@json($errors->isEmpty())) {
            $('#createModal').modal('show');

            var id = $('#id').val();

            if (id == 0) {
                $('#createFormModal').html('Create Authentcation');
            } else {
                $('#createFormModal').html('Update Authentcation');
            }
        }

        // create
        $('#create_').click(function () { 
            $("#id").val(0);
            $("#role_id").val('');
            $("#permisions").val('');

            $('#createFormModal').html('Create Authentcation');
            $('p').html('');
            
            $('#createModal').modal('show');
        });

        // update
        $('.edit').click(function () { 
            $("#id").val($(this).attr('data-id'));
            $("#role_id").val($(this).attr('data-role_id'));
            $("#permisions").val($(this).attr('data-permisions'));

            $('#createFormModal').html('Update Authentcation');
            $('p').html('');
            
            $('#createModal').modal('show');
        });
    });
</script>

@endsection
