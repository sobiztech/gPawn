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
                    <a class="btn btn-blue" href="{{ route('payment.schedule') }}">
                        <span class="btn-icon-wrapper pr-2"> </span>
                        Run Schedule
                    </a>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">No</th>
                                    <th class="wd-15p border-bottom-0">Customer Name</th>
                                    <th class="wd-15p border-bottom-0">Mobile Number</th>
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
                                        <td>{{ $row->customer_first_name }}</td>
                                        <td>{{ $row->phone_number }}</td>
                                        <td>{{ number_format((float)$row->amount, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$row->total_payble, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$row->total_payed, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$row->till_balance_amount, 2, '.', ',') }}</td>
                                        <td></td>
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

@endsection
