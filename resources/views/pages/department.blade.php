@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Departments</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Departments</li>
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
                                    <th class="wd-15p border-bottom-0">Code</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-15p border-bottom-0">Property</th>
                                    <th class="wd-20p border-bottom-0">Contact</th>
                                    <th class="wd-15p border-bottom-0">Email</th>
                                    <th class="wd-25p border-bottom-0">Location</th>
                                    <th class="wd-10p border-bottom-0">description</th>
                                    <th class="wd-10p border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->department_number }}</td>
                                        <td>{{ $row->department_name }}</td>
                                        <td>{{ $row->property_name }}</td>
                                        <td>{{ $row->phone_number }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->location }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td>
                                            <a class="btn btn-blue edit" title="Edit" 
                                            data-id="{{ $row->id }}"
                                            data-department_number="{{ $row->department_number }}" 
                                            data-department_name="{{ $row->department_name }}" 
                                            data-phone_number="{{ $row->phone_number }}" 
                                            data-email="{{ $row->email }}" 
                                            data-location="{{ $row->location }}" 
                                            data-description="{{ $row->description }}"  
                                            data-property_id="{{ $row->property_id }}" >
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
                    <h5 class="modal-title" id="createFormModal">Create Department</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    {{-- class="needs-validation" novalidate="" --}}
                    <form  method="POST" action="{{ route('department.store') }}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">

                        <div class="row">
                                    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Property<span class="text-danger">*</span></label>
                                    <div>
                                        <select class="form-select" required name="property_id" id="property_id">
                                            <option selected disabled value="">Choose...</option>
                                            @foreach ($properties as $item)
                                            <option value="{{ $item->id }}" {{ (old('property_id') == $item->id) ? 'selected' : '' }}>{{ $item->property_name }}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:Tomato"> @error('property_id'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Code<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="text" class="form-control" id="department_number" name="department_number"
                                            placeholder="Enter the  Code" value="{{ old('department_number') }}" required/>
                                        <p style="color:Tomato"> @error('department_number'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="text" class="form-control" id="department_name" name="department_name"
                                            placeholder="Enter the  Name" value="{{ old('department_name') }}" required/>
                                        <p style="color:Tomato"> @error('department_name'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Contact Number<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="number" class="form-control" id="phone_number" name="phone_number"
                                             value="{{ old('phone_number') }}" required/>
                                        <p style="color:Tomato"> @error('phone_number'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Email<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="text" class="form-control" id="email" name="email"
                                             value="{{ old('email') }}" required/>
                                        <p style="color:Tomato"> @error('email'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Location</label>
                                    <div>
                                        <textarea type="text" class="form-control" rows="1" id="location"
                                            name="location"
                                            placeholder="Enter the location">{{ old('location') }}</textarea>
                                    </div>
                                    <p style="color:Tomato"> @error('location'){{ $message }} @enderror
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Description</label>
                                    <div>
                                        <textarea type="text" class="form-control" rows="1" id="description"
                                            name="description"
                                            placeholder="Enter the description">{{ old('description') }}</textarea>
                                    </div>
                                    <p style="color:Tomato"> @error('description'){{ $message }} @enderror
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
                $('#createFormModal').html('Create Department');
            } else {
                $('#createFormModal').html('Update Department');
            }
        }

        // create
        $('#create_').click(function () { 
            $("#id").val(0);
            $("#department_number").val('');
            $("#department_name").val('');
            $("#phone_number").val('');
            $("#email").val('');
            $("#location").val('');
            $("#description").val('');

            $('#createFormModal').html('Create Department');
            $('p').html('');
            
            $('#createModal').modal('show');
        });

        // update
        $('.edit').click(function () { 
            $("#id").val($(this).attr('data-id'));
            $("#department_number").val($(this).attr('data-department_number'));
            $("#department_name").val($(this).attr('data-department_name'));
            $("#phone_number").val($(this).attr('data-phone_number'));
            $("#email").val($(this).attr('data-email'));
            $("#location").val($(this).attr('data-location'));
            $("#description").val($(this).attr('data-description'));
            $("#property_id").val($(this).attr('data-property_id'));

            $('#createFormModal').html('Update Department');
            $('p').html('');
            
            $('#createModal').modal('show');
        });
    });
</script>

@endsection
