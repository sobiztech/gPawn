@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Collection View Report</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Collection View Report</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('collectorPaymentReport') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <strong>Date From</strong>
                                    <input type="date" name="from" value="{{ $fromDate }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <strong>Date To</strong>
                                    <input type="date" name="to" value="{{ $toDate }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" style="margin-top:24px">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">No</th>
                                    <th class="wd-10p border-bottom-0">Date</th>
                                    <th class="wd-10p border-bottom-0">Loan Invice</th>
                                    <th class="wd-10p border-bottom-0">Payment Invice</th>
                                    <th class="wd-20p border-bottom-0">Amount</th>
                                    <th class="wd-20p border-bottom-0">Collector Name</th>
                                    <th class="wd-15p border-bottom-0">description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th align="right">Rs.
                                        {{ number_format((float) $collection->sum('amount'), 2, '.', ',') }}</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($collection as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->date }}</td>
                                        <td>{{ $row->loan_invoice_no }}</td>
                                        <td>{{ $row->payment_invoice_no }}</td>
                                        <td align="right">Rs. {{ number_format((float) $row->amount, 2, '.', ',') }}</td>
                                        <td>{{ $row->collecter_name }}</td>
                                        <td>{{ $row->description }}</td>
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
    <script>
        $(document).ready(function() {
            var from_date = '{{ $fromDate }}';
            var to_date = '{{ $toDate }}';

            // most order food
            $('#collectionView').DataTable({
                "pageLength": 10,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excel',
                        text: 'excel',
                        titleAttr: 'Loan ',
                        title: 'Loan -  ',
                        messageTop: 'Collection Report :- ' + from_date + ' to  ' + to_date,
                        footer: true,
                        autoPrint: true
                    },
                    {
                        extend: 'print',
                        text: 'print',
                        titleAttr: 'Loan',
                        title: 'Loan - ',
                        messageTop: 'Collection Report :- ' + from_date + ' to  ' + to_date,
                        footer: true,
                        autoPrint: true
                    }
                ]
            });
        });
    </script>
@endsection
