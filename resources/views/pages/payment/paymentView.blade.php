@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Payments</h1>
    </div>
    <div class="ms-auto pageheader-btn">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Payments</li>
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
                                <th class="wd-10p border-bottom-0">Invice No</th>
                                <th class="wd-15p border-bottom-0"> Name</th>
                                <th class="wd-15p border-bottom-0">Mobile</th>
                                <th class="wd-20p border-bottom-0">Amount</th>
                                <th class="wd-15p border-bottom-0">Date</th>
                                <th class="wd-10p border-bottom-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($actvieLoans as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->invoice_no }}</td>
                                <td>{{ $row->customer_first_name }}</td>
                                <td>{{ $row->phone_number }}</td>
                                <td>{{ number_format((float) $row->amount, 2, '.', ',') }}</td>
                                <td>{{ $row->date }}</td>
                                <td>
                                    <button class="btn btn-blue view" data-loan_id="{{ $row->loan_id }}">
                                        <span class="btn-icon-wrapper pr-2"> </span>
                                        View
                                    </button>
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
{{-- view model --}}
<div class="modal fade" id="PaymentViewModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFormModal">Payment Details</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom">
                        <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">No</th>
                                <th class="wd-10p border-bottom-0">Invice No</th>
                                <th class="wd-15p border-bottom-0">Date</th>
                                <th class="wd-20p border-bottom-0">Amount</th>
                                <th class="wd-15p border-bottom-0">Buyer Name</th>
                                <th class="wd-15p border-bottom-0">Description</th>
                            </tr>
                        </thead>
                        <tbody id="PaymentBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')
<script>
    $(document).ready(function() {

        // 
        $('.view').on('click', function(event) {
            event.preventDefault();

            var loan_id = $(this).attr('data-loan_id');

            $.ajax({
                url: "{{ route('payment.viewByLoanInAjax') }}",
                method: 'get',
                data: {
                    "loanId": loan_id
                },
                success: function(res) {

                    $('#PaymentBody').html('');

                    if (res.length > 0) {
                        var i = 1;
                        res.forEach(element => {

                            var body = ` <tr>
                                            <td>${i++}</td>
                                            <td>${element.invoice_no}</td>
                                            <td>${element.date}</td>
                                            <td>${element.amount}</td>
                                            <td>${element.buyer_name}</td>
                                            <td>${element.description != null ? element.description : ''}</td>
                                        </tr>`;

                            $('#PaymentBody').append(body);
                        });

                    } else {
                        var noData = `<tr>
                                    <td colspan="6" align="center">No Payment!!</td>
                                </tr>`;

                        $('#PaymentBody').append(noData);
                    }

                    $('#PaymentViewModal').modal('show');

                }
            });
        });
    });
</script>
@endsection