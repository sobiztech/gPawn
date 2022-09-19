@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Employees</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Employees</li>
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
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">No</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-15p border-bottom-0">Property</th>
                                    <th class="wd-15p border-bottom-0">Department</th>
                                    <th class="wd-15p border-bottom-0">Role</th>
                                    <th class="wd-15p border-bottom-0">Nic</th>
                                    <th class="wd-15p border-bottom-0">Gender</th>
                                    <th class="wd-20p border-bottom-0">Mobile</th>
                                    <th class="wd-25p border-bottom-0">Address</th>
                                    <th class="wd-10p border-bottom-0">Status</th>
                                    <th class="wd-10p border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->employee_first_name }} {{ $row->employee_sur_name }}</td>
                                        <td>{{ $row->property_name }}</td>
                                        <td>{{ $row->department_name }}</td>
                                        <td>{{ $row->role_name }}</td>
                                        <td>{{ $row->nic }}</td>
                                        <td>
                                            @if ($row->gender==1)
                                                Male
                                            @else
                                                Female
                                            @endif
                                        </td>
                                        <td>{{ $row->phone_number }}</td>
                                        <td>{{ $row->address }}</td>
                                        <td>
                                            @if ($row->is_active)
                                            <button data-url="{{ route('employee.status-change') }}"
                                                data-id="{{ $row->id }}" data-is_active="{{ $row->is_active }}"
                                                class="btn btn-green btn-sm w-100 changeStatus">Active</button>
                                            @else
                                                <button data-url="{{ route('employee.status-change') }}"
                                                    data-id="{{ $row->id }}" data-is_active="{{ $row->is_active }}"
                                                    class="btn btn-red btn-sm w-100 changeStatus">Deactive</button>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-blue edit" title="Edit" 
                                            data-id="{{ $row->id }}"
                                            data-employee_first_name="{{ $row->employee_first_name }}" 
                                            data-employee_sur_name="{{ $row->employee_sur_name }}" 
                                            data-property_id="{{ $row->property_id }}"
                                            data-department_id="{{ $row->department_id }}"
                                            data-role_id="{{ $row->role_id }}"
                                            data-nic="{{ $row->nic }}" 
                                            data-date_of_birth="{{ $row->date_of_birth }}" 
                                            data-gender="{{ $row->gender }}" 
                                            data-phone_number="{{ $row->phone_number }}" 
                                            data-email="{{ $row->email }}" 
                                            data-address="{{ $row->address }}" 
                                            data-contract_start_date="{{ $row->contract_start_date }}" 
                                            data-contract_end_date="{{ $row->contract_end_date }}" 
                                            data-is_active="{{ $row->is_active }}" 
                                            data-description="{{ $row->description }}">
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
                    <h5 class="modal-title" id="createFormModal">Create Customer</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    {{-- class="needs-validation" novalidate="" --}}
                    <form  method="POST" action="{{ route('employee.store') }}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>First Name<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="text" class="form-control" id="employee_first_name" name="employee_first_name"
                                            placeholder="Enter the  First Name" value="{{ old('employee_first_name') }}" required/>
                                        <p style="color:Tomato"> @error('employee_first_name'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sur Name<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="text" class="form-control" id="employee_sur_name" name="employee_sur_name"
                                            placeholder="Enter the Sur Name" value="{{ old('employee_sur_name') }}" required/>
                                        <p style="color:Tomato"> @error('employee_sur_name'){{ $message }} @enderror</p>
                                    
                                    </div>
                                </div>
                            </div>

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
                                    <label >Department<span class="text-danger">*</span></label>
                                    <div>
                                        <select class="form-select" required name="department_id" id="department_id">
                                            <option selected disabled value="">Choose...</option>
                                            @foreach ($departments as $item)
                                            <option class="departments department_{{ $item->property_id }}" value="{{ $item->id }}" {{ (old('department_id') == $item->id) ? 'selected' : '' }}>{{ $item->department_name }}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:Tomato"> @error('department_id'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

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
                                    <label >Nic<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="text" class="form-control" id="nic" name="nic"
                                             value="{{ old('nic') }}" required minlength="10" maxlength="12"/>
                                        <p style="color:Tomato"> @error('nic'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Date of Birth<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                             value="{{ old('date_of_birth') }}" required max="{{ date('Y-m-d') }}"/>
                                        <p style="color:Tomato"> @error('date_of_birth'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Gender<span class="text-danger">*</span></label>
                                    <div>
                                        <select class="form-select" required name="gender" id="gender">
                                            <option selected disabled value="">Choose...</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                        <p style="color:Tomato"> @error('gender'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Mobile Number<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="number" class="form-control" id="phone_number" name="phone_number"
                                             value="{{ old('phone_number') }}" required/>
                                        <p style="color:Tomato"> @error('phone_number'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Email</label>
                                    <div>
                                        <input type="email" class="form-control" id="email" name="email"
                                             value="{{ old('email') }}" />
                                        <p style="color:Tomato"> @error('email'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Address<span class="text-danger">*</span></label>
                                    <div>
                                        <textarea type="text" class="form-control" rows="1" id="address" required
                                            name="address"
                                            placeholder="Enter the address">{{ old('address') }}</textarea>
                                    </div>
                                    <p style="color:Tomato"> @error('address'){{ $message }} @enderror
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Contract Sign Date<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="date" class="form-control" id="contract_start_date" name="contract_start_date"
                                             value="{{ old('contract_start_date') }}" required/>
                                        <p style="color:Tomato"> @error('contract_start_date'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Contract End Date<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="date" class="form-control" id="contract_end_date" name="contract_end_date"
                                             value="{{ old('contract_end_date') }}" required/>
                                        <p style="color:Tomato"> @error('contract_end_date'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Status<span class="text-danger">*</span></label>
                                    <div>
                                        <select class="form-select" required name="is_active" id="is_active">
                                            <!-- <option selected disabled value="">Choose...</option> -->
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                        <p style="color:Tomato"> @error('is_active'){{ $message }} @enderror</p>
                                    </div>
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
                $('#createFormModal').html('Create Employee');
            } else {
                $('#createFormModal').html('Update Employee');
            }
        }

        // create
        $('#create_').click(function () { 
            $("#id").val(0);
            $("#employee_first_name").val('');
            $("#employee_sur_name").val('');
            $("#nic").val('');
            $("#date_of_birth").val('');
            $("#gender").val('');
            $("#phone_number").val('');
            $("#email").val('');
            $("#address").val('');
            $("#contract_start_date").val('');
            $("#contract_end_date").val('');
            $("#description").val('');
            $("#role_id").val('');
            $("#department_id").val('');
            $("#property_id").val('');
            $("#is_active").val('');

            $('#createFormModal').html('Create Employee');
            $('p').html('');
            
            $('#createModal').modal('show');
        });

        // update
        $('.edit').click(function () { 
            $("#id").val($(this).attr('data-id'));
            $("#employee_first_name").val($(this).attr('data-employee_first_name'));
            $("#employee_sur_name").val($(this).attr('data-employee_sur_name'));
            $("#nic").val($(this).attr('data-nic'));
            $("#date_of_birth").val($(this).attr('data-date_of_birth'));
            $("#gender").val($(this).attr('data-gender'));
            $("#phone_number").val($(this).attr('data-phone_number'));
            $("#email").val($(this).attr('data-email'));
            $("#address").val($(this).attr('data-address'));
            $("#contract_start_date").val($(this).attr('data-contract_start_date'));
            $("#contract_end_date").val($(this).attr('data-contract_end_date'));
            $("#is_active").val($(this).attr('data-is_active'));
            $("#description").val($(this).attr('data-description'));
            $("#role_id").val($(this).attr('data-role_id'));
            $("#department_id").val($(this).attr('data-department_id'));
            $("#property_id").val($(this).attr('data-property_id'));

            $('#createFormModal').html('Update Employee');
            $('p').html('');
            
            $('#createModal').modal('show');
        });

        // change status
        $('#basic-datatable').on('click', '.changeStatus', function() {
            var id = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            var status = $(this).attr('data-is_active');

            swal({
                    title: 'Are you sure?',
                    text: 'Change Employee Status !',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: url,
                            method: 'get',
                            data: {
                                status: status,
                                id: id
                            },
                            success: function(res) {
                                swal('Poof! Change Employee Status!', {
                                    icon: 'success',
                                    timer: 1000,
                                });
                                location.reload();
                            }
                        });
                    }
                });
        });

        //Dropdown change -Property -> Department
        $('.departments').hide();

        $("#property_id").change(function(){
            $('.departments').hide();
            var property_id =  $("#property_id").val();
            $('.department_'+property_id).show();
        });
        
    });
</script>

@endsection
