@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Loan Details</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Loan Details</li>
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
                                    <th class="wd-15p border-bottom-0">Code</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-15p border-bottom-0">Loan Type</th>
                                    <th class="wd-20p border-bottom-0">Amount</th>
                                    <th class="wd-15p border-bottom-0">Status</th>
                                    <th class="wd-10p border-bottom-0">description</th>
                                    <th class="wd-10p border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loanDetails as $row)
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

