@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Payment</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payment</li>
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
                                    <th class="wd-15p border-bottom-0">Date</th>
                                    <th class="wd-15p border-bottom-0">Invoice</th>
                                    <th class="wd-15p border-bottom-0">Customer Code</th>
                                    <th class="wd-15p border-bottom-0">Customer Name</th>
                                    <th class="wd-15p border-bottom-0">Payment Type</th>
                                    <th class="wd-15p border-bottom-0">Amount</th>
                                    <th class="wd-10p border-bottom-0">description</th>
                                    <th class="wd-15p border-bottom-0">User</th>
                                    <th class="wd-10p border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->date }}</td>
                                        <td>{{ $row->invoice_no }}</td>
                                        <td>{{ $row->customer_number }}</td>
                                        <td>{{ $row->customer_first_name }} {{ $row->customer_sur_name }}</td>
                                        <td>{{ $row->payment_type_name }}</td>
                                        <td>{{ $row->amount }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td>{{ $row->employee_number }}</td>
                                        <td>
                                            <a class="btn btn-blue edit" title="Edit" 
                                            data-id="{{ $row->id }}"
                                            data-date="{{ $row->date }}" 
                                            data-invoice_no="{{ $row->invoice_no }}"
                                            data-amount="{{ $row->amount }}"
                                            data-description="{{ $row->description }}" 
                                            data-customer_id="{{ $row->customer_id }}"
                                            data-payment_type_id="{{ $row->payment_type_id }}" 
                                            data-user_id="{{ $row->user_id }}">
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
                    <h5 class="modal-title" id="createFormModal">Create Payment</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    {{-- class="needs-validation" novalidate="" --}}
                    <form  method="POST" action="{{ route('payment.store') }}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="date" class="form-control" id="date" name="date"
                                            value="{{ old('date') ? old('date') : date('Y-m-d') }}" required  />
                                        <p style="color:Tomato"> @error('date')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer<span class="text-danger">*</span></label>
                                    <div>
                                        <select class="form-control select2-show-search form-select" required name="customer_id" id="customer_id">
                                            <option selected disabled value="">Choose...</option>
                                            @foreach ($customers as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('customer_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->customer_first_name }}/ {{ $item->phone_number }}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:Tomato"> @error('customer_id')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Payment Type<span class="text-danger">*</span></label>
                                    <div>
                                        <select class="form-select" required name="payment_type_id" id="payment_type_id">
                                            <option selected disabled value="">Choose...</option>
                                            @foreach ($payment_types as $item)
                                            <option value="{{ $item->id }}" {{ (old('payment_type_id') == $item->id) ? 'selected' : '' }}>{{ $item->payment_type_name }}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:Tomato"> @error('payment_type_id'){{ $message }} @enderror</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Amount<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="number" class="form-control" id="amount" name="amount"
                                            value="{{ old('amount') ? old('amount') : 0  }}" required step="0.01" min="1" />
                                        <p style="color:Tomato"> @error('amount')
                                                {{ $message }}
                                            @enderror
                                        </p>
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
                $('#createFormModal').html('Create Payment');
            } else {
                $('#createFormModal').html('Update Payment');
            }
        }

        // create
        $('#create_').click(function () { 
            $("#id").val(0);
            $("#date").val('');
            $("#invoice_no").val('');
            $("#loan_type_name").val('');
            $("#amount").val('');
            $("#description").val('');
            $("#customer_id").val('');
            $("#payment_type_id").val('');
            $("#user_id").val('');

            $('#createFormModal').html('Create Payment');
            $('p').html('');
            
            $('#createModal').modal('show');
        });

        // update
        $('.edit').click(function () { 
            $("#id").val($(this).attr('data-id'));
            $("#date").val($(this).attr('data-date'));
            $("#invoice_no").val($(this).attr('data-invoice_no'));
            $("#loan_type_name").val($(this).attr('data-loan_type_name'));
            $("#amount").val($(this).attr('data-amount'));
            $("#description").val($(this).attr('data-description'));
            $("#customer_id").val($(this).attr('data-customer_id'));
            $("#payment_type_id").val($(this).attr('data-payment_type_id'));
            $("#user_id").val($(this).attr('data-user_id'));

            $('#createFormModal').html('Update Payment');
            $('p').html('');
            
            $('#createModal').modal('show');
        });
    });
</script>

@endsection
