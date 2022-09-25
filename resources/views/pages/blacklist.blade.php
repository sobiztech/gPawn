@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Black List</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Black List</li>
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
                        <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">No</th>
                                    <th class="wd-15p border-bottom-0">code</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-15p border-bottom-0">NIC</th>
                                    <th class="wd-10p border-bottom-0">black List Type</th>
                                    <th class="wd-10p border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blackLists as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->customer_number }}</td>
                                        <td>{{ $row->customer_first_name }} {{ $row->customer_sur_name }}</td>
                                        <td>{{ $row->nic }}</td>
                                        <td>{{ $row->black_list_type_name }}</td>
                                        <td>
                                            <a class="btn btn-blue edit" title="Edit" data-id="{{ $row->id }}"
                                                data-customer_id="{{ $row->customer_id }}"
                                                data-black_list_type_id="{{ $row->black_list_type_id }}">
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFormModal">Create Black List</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    {{-- class="needs-validation" novalidate="" --}}
                    <form method="POST" action="{{ route('blacklist.store') }}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Customer<span class="text-danger">*</span></label>
                                    <div> 
                                        {{-- form-control select2-show-search form-select --}}
                                        <select class="form-control  form-select" required
                                            name="customer_id" id="customer_id">
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

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Block List Type<span class="text-danger">*</span></label>
                                    <div>
                                        <select class="form-select" required name="black_list_type_id"
                                            id="black_list_type_id">
                                            <option selected disabled value="">Choose...</option>
                                            @foreach ($blackListTypes as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('black_list_type_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->black_list_type_name }}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:Tomato"> @error('black_list_type_id')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
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
    <!-- INTERNAL SELECT2 JS -->
    {{-- <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script> --}}
    {{-- <!-- SELECT2 JS --> --}}
    {{-- <script src="{{ asset('assets/js/formelementadvnced.js') }}"></script> --}}

    <script>
        $(document).ready(function() {

            // show model back end validate
            if (!@json($errors->isEmpty())) {
                $('#createModal').modal('show');

                var id = $('#id').val();

                if (id == 0) {
                    $('#createFormModal').html('Create Black List');
                } else {
                    $('#createFormModal').html('Update Black List');
                }
            }

            // create
            $('#create_').click(function() {
                $("#id").val(0);
                $("#customer_id").val('');
                $("#black_list_type_id").val('');

                $('#createFormModal').html('Create Black List');
                $('p').html('');

                $('#createModal').modal('show');
            });

            // update
            $('#responsive-datatable').on('click', '.edit', function() {
                $("#id").val($(this).attr('data-id'));
                $("#customer_id").val($(this).attr('data-customer_id'));
                $("#black_list_type_id").val($(this).attr('data-black_list_type_id'));

                $('#createFormModal').html('Update Black List');
                $('p').html('');

                $('#createModal').modal('show');
            });
        });
    </script>
@endsection
