@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Payble</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payble</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <button class="btn btn-blue" data-href="{{ route('payment.schedule') }}" id="runSchedule">
                        <span class="btn-icon-wrapper pr-2"> </span>
                        Run Schedule
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">No</th>
                                    <th class="wd-10p border-bottom-0">Invice No</th>
                                    <th class="wd-10p border-bottom-0">Date</th>
                                    <th class="wd-15p border-bottom-0"> Name</th>
                                    <th class="wd-15p border-bottom-0">Mobile</th>
                                    <th class="wd-20p border-bottom-0">Amount</th>
                                    <th class="wd-15p border-bottom-0">Payable</th>
                                    <th class="wd-15p border-bottom-0">Total Payed</th>
                                    <th class="wd-10p border-bottom-0">Blance Pay</th>
                                    <th class="wd-10p border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payable as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->invoice_no }}</td>
                                        <td>{{ $row->date }}</td>
                                        <td>{{ $row->customer_first_name }}</td>
                                        <td>{{ $row->phone_number }}</td>
                                        <td>{{ number_format((float) $row->amount, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float) $row->total_payble, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float) $row->total_payed, 2, '.', ',') }}</td>
                                        <td style="background-color: {{ $row->till_balance_amount > 0 ? 'rgb(255, 230, 255)' : '' }}">
                                            {{ number_format((float) $row->till_balance_amount, 2, '.', ',') }}
                                        </td>
                                        <td>
                                            <a class="btn btn-blue"
                                                href="{{ route('payment.create', ['id' => $row->loan_id]) }}">
                                                <span class="btn-icon-wrapper pr-2"> </span>
                                                Payment
                                            </a>
                                            <br><br>
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
    <div class="modal fade" id="PaymentViewModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFormModal">Payments View</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


    <script>
        $(document).ready(function() {
            // run 
            $('#runSchedule').on('click', function(event) {
                event.preventDefault();

                var route = $('#runSchedule').attr('data-href');

                swal({
                        title: 'Run Daily Scheduler ?',
                        text: 'Run Scheduler Now !',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: route,
                                method: 'get',
                                data: {},
                                success: function(res) {
                                    swal('Poof! Run Scheduler !', {
                                        icon: 'success',
                                        timer: 1000,
                                    });
                                    location.reload();
                                }
                            });
                        }
                    });
            });

            // view payments
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
