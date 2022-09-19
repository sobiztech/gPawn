<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body,
        html {
            width: 210.2125984252px;
            padding-bottom: 10px;
        }

        .contant {
            font-family: "sans-serif";
            width: 210.2125984252px;
            border: .1px solid #000;
            margin: -8px;
            height: auto;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .header {
            margin-top: 4%;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-bottom: .1px dashed #000
        }

        .header div:nth-child(1) {
            font-size: 25px;
            display: flex;
            justify-content: center
        }

        .toprecipt {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 3px;
            font-size: 13px
        }

        .contant .toprecipt:nth-child(3) {
            font-size: 12px;
            border-bottom: .1px dashed #000
        }

        .details {
            padding: 3px;
            font-size: 13px;
        }

        .contant .details:nth-child(3) {
            font-size: 12px;
            border-bottom: .1px dashed #000
        }

        .head {
            display: flex;
            flex-direction: row;
            width: 100%;
            padding: 5px;
            font-size: 14px;
            font-weight: 600
        }

        .head div:nth-child(4) {
            width: 20%;
            display: flex;
            justify-content: center;
            text-align: center
        }

        .bottom {
            display: flex;
            align-items: center;
            justify-content: center;
            border-top: .1px dashed #000;
            border-bottom: .1px solid #000;
            height: 40px
        }

        table {
            width: 100%;
            padding: 0 5px !important;
            border-top: .1px dashed #000
        }

        tr {
            line-height: 15px
        }

        tr td:nth-child(1) {
            width: 70%
        }

        tr td:nth-child(3) {
            width: 30%;
            text-align: end;
        }

        tbody tr:nth-child(3) td {
            color: #000;
            font-weight: 600
        }

        tbody tr:nth-child(4) td {
            color: #000;
            height: 30px;
            font-weight: 600
        }
        span {
                text-align: center;
                font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="contant">
        <div class="header">
            <div><img
                    src="https://w7.pngwing.com/pngs/799/755/png-transparent-loan-money-bank-finance-for-business-bank-blue-payment-logo.png"
                    alt="" style="width:58%;height:auto;"></div>
            <div>${name}</div>
            <div>${phoneNumber}</div>
        </div>
        <div class="toprecipt">
            <div>${date}</div>
            <div></div>
            <div>${time}</div>
        </div>
        <div class="details">
            <div>Loan Invice: ${loan_invoice_no}</div>
            <div>Payment Invice: ${payment_invoice_no}</div>
            <div>Collector: ${collecter_name}</div>
        </div>

        <table>
            <tbody>
                <tr>
                    <td>Loan Amount</td>
                    <td>${loan_amount}</td>
                </tr>
                <tr>
                    <td>Payed Amount</td>
                    <td>${payment_amount}</td>
                </tr>
                <tr>
                    <td>Total Payed</td>
                    <td>${tillTotalPay}</td>
                </tr>
                <tr>
                    <td>Payment Mode</td>
                    <td> ${payment_type_name}</td>
                </tr>
            </tbody>
        </table>
        <div class="bottom">Thank You ..!</div>
        <span>technical solutions - sobiztech (pvt) ltd</span>
</div>
</body>

</html>
