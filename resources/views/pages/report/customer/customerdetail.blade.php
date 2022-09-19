@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Customers Detail</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Report</a></li>
                <li class="breadcrumb-item active" aria-current="page">Customer</li>
                <li class="breadcrumb-item active" aria-current="page">Customer Detail</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                
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
                                        <td>{{ $row->gender }}</td>
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

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
    // $(document).ready(function () {

    //     // show model back end validate
    //     if (!@json($errors->isEmpty())) {
    //         $('#createModal').modal('show');

    //         var id = $('#id').val();

    //         if (id == 0) {
    //             $('#createFormModal').html('Create Employee');
    //         } else {
    //             $('#createFormModal').html('Update Employee');
    //         }
    //     }

    //     // create
    //     $('#create_').click(function () { 
    //         $("#id").val(0);
    //         $("#employee_first_name").val('');
    //         $("#employee_sur_name").val('');
    //         $("#nic").val('');
    //         $("#date_of_birth").val('');
    //         $("#gender").val('');
    //         $("#phone_number").val('');
    //         $("#email").val('');
    //         $("#address").val('');
    //         $("#contract_start_date").val('');
    //         $("#contract_end_date").val('');
    //         $("#description").val('');
    //         $("#role_id").val('');
    //         $("#department_id").val('');
    //         $("#property_id").val('');

    //         $('#createFormModal').html('Create Employee');
    //         $('p').html('');
            
    //         $('#createModal').modal('show');
    //     });

    //     // update
    //     $('.edit').click(function () { 
    //         $("#id").val($(this).attr('data-id'));
    //         $("#employee_first_name").val($(this).attr('data-employee_first_name'));
    //         $("#employee_sur_name").val($(this).attr('data-employee_sur_name'));
    //         $("#nic").val($(this).attr('data-nic'));
    //         $("#date_of_birth").val($(this).attr('data-date_of_birth'));
    //         $("#gender").val($(this).attr('data-gender'));
    //         $("#phone_number").val($(this).attr('data-phone_number'));
    //         $("#email").val($(this).attr('data-email'));
    //         $("#address").val($(this).attr('data-address'));
    //         $("#contract_start_date").val($(this).attr('data-contract_start_date'));
    //         $("#contract_end_date").val($(this).attr('data-contract_end_date'));
    //         $("#description").val($(this).attr('data-description'));
    //         $("#role_id").val($(this).attr('data-role_id'));
    //         $("#department_id").val($(this).attr('data-department_id'));
    //         $("#property_id").val($(this).attr('data-property_id'));

    //         $('#createFormModal').html('Update Employee');
    //         $('p').html('');
            
    //         $('#createModal').modal('show');
    //     });

    //     // change status
    //     $('#basic-datatable').on('click', '.changeStatus', function() {
    //         var id = $(this).attr('data-id');
    //         var url = $(this).attr('data-url');
    //         var status = $(this).attr('data-is_active');

    //         swal({
    //                 title: 'Are you sure?',
    //                 text: 'Change Employee Status !',
    //                 icon: 'warning',
    //                 buttons: true,
    //                 dangerMode: true,
    //             })
    //             .then((willDelete) => {
    //                 if (willDelete) {
    //                     $.ajax({
    //                         url: url,
    //                         method: 'get',
    //                         data: {
    //                             status: status,
    //                             id: id
    //                         },
    //                         success: function(res) {
    //                             swal('Poof! Change Employee Status!', {
    //                                 icon: 'success',
    //                                 timer: 1000,
    //                             });
    //                             location.reload();
    //                         }
    //                     });
    //                 }
    //             });
    //     });

    //     //Dropdown change -Property -> Department
    //     $('.departments').hide();

    //     $("#property_id").change(function(){
    //         $('.departments').hide();
    //         var category_id =  $("#property_id").val();
    //         $('.department_'+category_id).show();
    //     });
        
    // });
</script>

@endsection
