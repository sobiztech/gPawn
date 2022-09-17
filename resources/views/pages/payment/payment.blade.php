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

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row row-deck">
                        {{-- Total --}}
                        <div class="col-md-6 col-xl-2">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h4 class="card-title">Total</h4>
                                    <p class="card-text">Rs.
                                        {{ number_format((float) $details->total_amount, 2, '.', ',') }}</span></p>
                                </div>
                            </div>
                        </div>
                        {{-- Total Payed --}}
                        <div class="col-md-6 col-xl-2">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <h4 class="card-title">Total Payed</h4>
                                    <p class="card-text">Rs. {{ number_format((float) $details->total_payed, 2, '.', ',') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        {{-- Payable --}}
                        <div class="col-md-6 col-xl-2">
                            <div class="card text-white bg-danger">
                                <div class="card-body">
                                    <h4 class="card-title">Payable</h4>
                                    <p class="card-text">Rs. {{ number_format((float) $details->total_payble, 2, '.', ',') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <form method="POST" action="{{ route('payment.store') }}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                        <label class="colorinput">
                            <input name="close_loan" type="checkbox" value="1" class="colorinput-input"
                                id="close_loan" />
                            <span class="colorinput-color bg-azure"></span>
                            <label for="close_loan">Close This Loan ?</label>
                        </label>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Loan Invice No</label>
                                    <div>
                                        <input type="hidden" name="loan_id" id="loan_id" value="{{ $details->loan_id }}">
                                        <input type="text" class="form-control" id="invoice_no" name="invoice_no"
                                            value="{{ $details->invoice_no }}" required readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <div>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name"
                                            value="{{ $details->customer_first_name }}" required readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="date" class="form-control" id="date" name="date"
                                            value="{{ old('date') ? old('date') : date('Y-m-d') }}" required
                                            max="{{ date('Y-m-d') }}" />
                                        <p style="color:Tomato"> @error('date')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Payment Type<span class="text-danger">*</span></label>
                                    <div>
                                        <select class="form-control" required name="payment_type_id" id="payment_type_id">
                                            {{-- <option selected disabled value="">Choose...</option> --}}
                                            @foreach ($payment_types as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('payment_type_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->payment_type_name }}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:Tomato"> @error('payment_type_id')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Amount<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="number" class="form-control" id="amount" name="amount"
                                            value="{{ old('amount') ? old('amount') : 0 }}" required step="0.01"
                                            min="1" />
                                        <p style="color:Tomato"> @error('amount')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" id="discountView" style="display: none;">
                                <div class="form-group">
                                    <label>Discount</label>
                                    <div>
                                        <input type="number" class="form-control" id="discount" name="discount"
                                            value="{{ old('discount') ? old('discount') : 0 }}" step="0.01"
                                            min="0" />
                                        <p style="color:Tomato"> @error('discount')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Description</label>
                                    <div>
                                        <textarea type="text" class="form-control" rows="1" id="description" name="description"
                                            placeholder="Enter the description">{{ old('description') }}</textarea>
                                    </div>
                                    <p style="color:Tomato"> @error('description')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" align="right">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-success save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <!-- SELECT2 JS --> --}}
    {{-- <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script> --}}

    <script>
        $(document).ready(function() {

            const totalPayable = parseFloat('{{ $details->total_payble }}');

            $('#amount, #discount').click(function() {
                $(this).select();
            });

            $('#close_loan, #amount, #discount').change(function() {
                checkLoanClose();
            });

            // check function
            function checkLoanClose() {
    
                if ($('#close_loan').is(':checked')) {
                    $('#discountView').show();
    
                    var amount = parseFloat($('#amount').val()) ? parseFloat($('#amount').val()) : 0;
                    var discount = parseFloat($('#discount').val()) ? parseFloat($('#discount').val()) : 0;
    
                    var total = parseFloat(amount + discount);
            
                    if (total >= totalPayable) {
                        $('.save').attr('disabled', false);
                    } else {
                        $('.save').attr('disabled', true);
                    }
    
                } else {
                    $('.save').attr('disabled', false);
                    $('#discountView').hide();
                }
            }
        });

    </script>
@endsection
