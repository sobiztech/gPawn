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
                                    <p class="card-text">Rs.
                                        {{ number_format((float) $details->total_payble, 2, '.', ',') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <form method="POST" id="paymentStore" action="{{ route('payment.store') }}">
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
                            {{-- <button type="submit" class="btn btn-success" id="save">Save</button> --}}
                            <button type="button" class="btn btn-success" id="save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    
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
                        $('#save').attr('disabled', false);
                    } else {
                        $('#save').attr('disabled', true);
                    }

                } else {
                    $('#save').attr('disabled', false);
                    $('#discountView').hide();
                }
            }

            // click save button
            $('#save').click(function() {

                swal({
                        title: 'Add This Payment ?',
                        text: 'Payment Add Now !',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            $('#save').attr('disabled', true);

                            swal('Poof! Payment Saving !', {
                                icon: 'success',
                                // timer: 1000,
                            });

                            $.ajax({
                                type: "post",
                                url: "{{ route('payment.store') }}",
                                data: $("#paymentStore").serialize(),
                                dataType: "",
                                success: function(res) {
                                    if (res.is_save) { // sucess save

                                        printBill(res.loan_id);
                                    } else {
                                        swal("Oh noes!", "The Payment Store Failed!",
                                            "error");
                                    }
                                }
                            });
                        }
                    });
            });

            // print function
            function printBill(loanId) {

                $.ajax({
                    type: "get",
                    url: "{{ route('payment.getDetailsForPrintAjax') }}",
                    data: {
                        'loanId': loanId
                    },
                    dataType: "",
                    success: function(res) {

                        if (res.is_success) { // success body return

                            // 
                            // swal.stopLoading();
                            // swal.close();

                            var imageURL = res.imageURL;
                            var name = res.name;
                            var phoneNumber = res.phoneNumber;
                            var date = res.date;
                            var time = res.time;
                            var loan_invoice_no = res.loanDetails.loan_invoice_no;
                            var loan_amount = res.loanDetails.loan_amount;
                            var payment_invoice_no = res.lastPayment.payment_invoice_no;
                            var payment_amount = res.lastPayment.payment_amount;
                            var collecter_name = res.lastPayment.collecter_name;
                            var payment_type_name = res.lastPayment.payment_type_name;
                            var tillTotalPay = res.tillTotalPay;


                            var mywindow = window.open("", "PRINT");
                            mywindow.document.write(
                                `<!DOCTYPE html><html lang="en"><head> <style>body, html{width: 210.2125984252px; padding-bottom: 10px;}.contant{font-family: "sans-serif"; width: 210.2125984252px; border: .1px solid #000; margin: -8px; height: auto; display: flex; flex-direction: column; overflow: hidden;}.header{margin-top: 4%; width: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; border-bottom: .1px dashed #000}.header div:nth-child(1){font-size: 25px; display: flex; justify-content: center}.toprecipt{display: flex; flex-direction: row; justify-content: space-between; padding: 3px; font-size: 13px}.contant .toprecipt:nth-child(3){font-size: 12px; border-bottom: .1px dashed #000}.details{padding: 3px; font-size: 13px;}.contant .details:nth-child(3){font-size: 12px; border-bottom: .1px dashed #000}.head{display: flex; flex-direction: row; width: 100%; padding: 5px; font-size: 14px; font-weight: 600}.head div:nth-child(4){width: 20%; display: flex; justify-content: center; text-align: center}.bottom{display: flex; align-items: center; justify-content: center; border-top: .1px dashed #000; border-bottom: .1px solid #000; height: 40px}table{width: 100%; padding: 0 5px !important; border-top: .1px dashed #000}tr{line-height: 15px}tr td:nth-child(1){width: 70%}tr td:nth-child(3){width: 30%; text-align: end;}tbody tr:nth-child(3) td{color: #000; font-weight: 600}tbody tr:nth-child(4) td{color: #000; height: 30px; font-weight: 600}span{text-align: center; font-size: 12px;}</style></head><body> <div class="contant"> <div class="header"> <div><img src="https://w7.pngwing.com/pngs/799/755/png-transparent-loan-money-bank-finance-for-business-bank-blue-payment-logo.png" alt="" style="width:58%;height:auto;"></div><div>${name}</div><div>${phoneNumber}</div></div><div class="toprecipt"> <div>${date}</div><div></div><div>${time}</div></div><div class="details"> <div>Loan Invice: ${loan_invoice_no}</div><div>Payment Invice: ${payment_invoice_no}</div><div>Collector: ${collecter_name}</div></div><table> <tbody> <tr> <td>Loan Amount</td><td>Rs.${loan_amount}</td></tr><tr> <td>Payed Amount</td><td>Rs.${payment_amount}</td></tr><tr> <td>Total Payed</td><td>Rs.${tillTotalPay}</td></tr><tr> <td>Payment Mode</td><td> ${payment_type_name}</td></tr></tbody> </table> <div class="bottom">Thank You ..!</div><span>technical solutions - sobiztech (pvt) ltd</span></div></body></html>`
                                );
                            mywindow.focus();
                            mywindow.print();
                            // mywindow.document.close();
                            mywindow.close();

                            // admin view url 
                            location.assign("/payable/view"); // /payable/view

                        } else {
                            swal("Oh noes!", "The AJAX request failed!", "error");
                        }

                    }
                });
            }


        });
    </script>
@endsection
