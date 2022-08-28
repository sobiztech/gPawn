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
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">No</th>
                                    <th class="wd-15p border-bottom-0">First Name</th>
                                    <th class="wd-15p border-bottom-0">Nic</th>
                                    <th class="wd-20p border-bottom-0">Mobile</th>
                                    <th class="wd-15p border-bottom-0">Gender</th>
                                    <th class="wd-10p border-bottom-0">Type</th>
                                    <th class="wd-25p border-bottom-0">Address</th>
                                    <th class="wd-10p border-bottom-0">Status</th>
                                    <th class="wd-10p border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                               
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
