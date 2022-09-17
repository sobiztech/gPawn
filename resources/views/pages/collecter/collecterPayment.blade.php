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
                                    <p class="card-text">Rs. {{ number_format((float)$details->total_amount, 2, '.', ',') }}</span></p>
                                </div>
                            </div>
                        </div>
                        {{-- Total Payed --}}
                        <div class="col-md-6 col-xl-2">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <h4 class="card-title">Total Payed</h4>
                                    <p class="card-text">Rs. {{ number_format((float)$details->total_payed, 2, '.', ',') }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- Payable --}}
                        <div class="col-md-6 col-xl-2">
                            <div class="card text-white bg-danger">
                                <div class="card-body">
                                    <h4 class="card-title">Payable</h4>
                                    <p class="card-text">Rs. {{ number_format((float)$details->total_payble, 2, '.', ',') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <hr>
                    <form method="POST" action="{{ route('payment.collecterPaymentStore') }}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Loan Invice No</label>
                                    <div>
                                        <input type="hidden" name="loan_id" id="loan_id" value="{{ $details->loan_id }}">
                                        <input type="text" class="form-control" id="invoice_no" name="invoice_no"
                                            value="{{ $details->invoice_no  }}" required readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <div>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name"
                                            value="{{ $details->customer_first_name  }}" required readonly/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="date" class="form-control" id="date" name="date"
                                            value="{{ old('date') ? old('date') : date('Y-m-d') }}" required  max="{{ date('Y-m-d') }}" />
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
                                            value="{{ old('amount') ? old('amount') : 0  }}" required step="1" min="1" />
                                        <p style="color:Tomato"> @error('amount')
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
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script>
    $(document).ready(function () {
        $('#amount').click(function () { 
            $(this).select();
        });
        
    });
</script>

@endsection
