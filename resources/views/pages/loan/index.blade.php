@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Loans</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Loans</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <a class="btn btn-blue" href="{{ route('loan.create') }}">
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
                                    <th class="wd-15p border-bottom-0">Customer Name</th>
                                    <th class="wd-15p border-bottom-0">Mobile Number</th>
                                    <th class="wd-15p border-bottom-0">Date</th>
                                    <th class="wd-20p border-bottom-0">Amount</th>
                                    <th class="wd-15p border-bottom-0">Period(Months)</th>
                                    <th class="wd-10p border-bottom-0">Pay Type</th>
                                    <th class="wd-10p border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($loan as $row)
                                   <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->customer_first_name }}</td>
                                        <td>{{ $row->phone_number }}</td>
                                        <td>{{ $row->date }}</td>
                                        <td>{{ $row->amount }}</td>
                                        <td>{{ $row->period }}</td>
                                        <td>{{ $row->pay_type }}</td>
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