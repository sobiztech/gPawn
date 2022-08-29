@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Loan Create</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Loan Create</li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    {{-- class="needs-validation" novalidate="" --}}
                    <form method="POST" action="{{ route('loan.store') }}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Customer<span class="text-danger">*</span></label>
                                    <div>
                                        <select class="form-control select2-show-search form-select" required name="customer_id" id="customer_id">
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
                                    <label>Loan Type<span class="text-danger">*</span></label>
                                    <div>
                                        <select class="form-control select2-show-search form-select" required name="loan_type_id" id="loan_type_id">
                                            <option selected disabled value="">Choose...</option>
                                            @foreach ($loan_types as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('loan_type_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->loan_type_name }}</option>
                                            @endforeach
                                        </select>
                                        <p style="color:Tomato"> @error('loan_type_id')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment Type<span class="text-danger">*</span></label>
                                    <div>
                                        <select class="form-select" required name="payment_type" id="payment_type">
                                            <option selected disabled value="">Choose...</option>
                                            <option value="Monthly" >Monthly</option>
                                            <option value="Weekly">Weekly</option>
                                            <option value="Daily">Daily</option>
                                        </select>
                                        <p style="color:Tomato"> @error('payment_type')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage -(%)<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="number" class="form-control" id="interest" name="interest"
                                            value="{{ old('interest') ? old('interest') : 1  }}" required step="0.01" min="0" />
                                        <p style="color:Tomato"> @error('interest')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No of Month<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="number" class="form-control" id="period" name="period"
                                            value="{{ old('period') ? old('period') : 1  }}" required step="1" min="1" />
                                        <p style="color:Tomato"> @error('period')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="number" class="form-control" id="amount" name="amount"
                                            value="{{ old('amount') ? old('amount') : 0  }}" required step="0.01" min="1" />
                                        <p style="color:Tomato"> @error('amount')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date<span class="text-danger">*</span></label>
                                    <div>
                                        <input type="date" class="form-control" id="date" name="date"
                                            value="{{ old('date') ? old('date') : date('Y-m-d') }}" required  />
                                        <p style="color:Tomato"> @error('date')
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
                
                <div class="col-md-6">
                    <br>
                    <h5>Total Payable :- Rs. <span id="total_payable">0.00</span></h5>
                    <br>
                    <h5>Payments :-</h5>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table border text-nowrap text-md-nowrap table-striped">
                                <thead>
                                    <tr>
                                        <th class="wd-5p border-bottom-0">No</th>
                                        <th class="wd-10p border-bottom-0">Type</th>
                                        <th class="wd-10p border-bottom-0 d-flex justify-content-end" >Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                        <td>1</td>
                                        <td>Monthly (× <span id="month_count">0</span>)</td>
                                        <th  class="d-flex justify-content-end">Rs. <span id="monthly_payment">0.00</span></th>
                                   </tr>
                                   <tr>
                                        <td>2</td>
                                        <td>Weekly (× <span id="week_count">0</span>)</td>
                                        <th  class="d-flex justify-content-end">Rs. <span id="weekly_payment">0.00</span></th>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Daily (× <span id="day_count">0</span>)</td>
                                        <th  class="d-flex justify-content-end">Rs. <span id="daily_payment">0.00</span></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<!-- SELECT2 JS -->
{{-- <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script> --}}

<script>
    $(document).ready(function () {

        $('#amount, #percentage, #period, #date').change(function () { 
            calculatePayment();
        });

        $('#amount, #percentage, #period').click(function () { 
            $(this).select();
        });
        
        function calculatePayment() {
            var amount = $("#amount").val() ? $("#amount").val() : 0;
            var percentage = $("#percentage").val() ? $("#percentage").val() : 0;
            var period = $("#period").val() ? $("#period").val() : 1;
            var date = $("#date").val();

            $.ajax({
                type: "get",
                url: "{{ route('loan.getLoanPaymentDetailAjax') }}",
                data: {
                    'amount' : amount,
                    'percentage' : percentage,
                    'period' : period,
                    'date' : date
                },
                dataType: "",
                success: function (res) {
                    $('#total_payable').html(res.total_payable);
                    $('#monthly_payment').html(res.monthly_payment);
                    $('#weekly_payment').html(res.weekly_payment);
                    $('#daily_payment').html(res.daily_payment);
                    $('#month_count').html(res.month_count);
                    $('#week_count').html(res.week_count);
                    $('#day_count').html(res.day_count);
                }
            });
        }
    });
</script>

@endsection
