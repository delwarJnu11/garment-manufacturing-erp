<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Sheet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        .total {
            font-weight: bold;
        }
    </style>

</head>
<body>
    <h1>Balance Sheet</h1>
    <table class="table table-light table-striped w-75 mx-auto">
        <tr>
            <th>Assets</th>
            <th>Amount</th>
        </tr>
        <tr>
            <td>Current Assets</td>
            <td>{{ number_format($assets, 2) }}</td>
        </tr>
        <tr class="total">
            <td>Total Assets</td>
            <td>{{ number_format($assets, 2) }}</td>
        </tr>

        <tr>
            <th>Liabilities</th>
            <th>Amount</th>
        </tr>
        <tr>
            <td>Current Liabilities</td>
            <td>{{ number_format($liabilities, 2) }}</td>
        </tr>
        <tr class="total">
            <td>Total Liabilities</td>
            <td>{{ number_format($liabilities, 2) }}</td>
        </tr>

        <tr>
            <th>Equity</th>
            <th>Amount</th>
        </tr>
        <tr>
            <td>Owner's Equity</td>
            <td>{{ number_format($equity, 2) }}</td>
        </tr>
        <tr class="total">
            <td>Total Equity</td>
            <td>{{ number_format($equity, 2) }}</td>
        </tr>
    </table>
</body>
</html> -->

<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Sheet</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
        }

        .total {
            font-weight: bold;
            background-color: #f4f4f4;
        }

        .section-title {
            background-color: #f0f0f0;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Balance Sheet</h1>

    <h2>Assets</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Asset Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr class="section-title">
                <td>Current Assets</td>
                <td></td>
            </tr>
            <tr>
                <td>Cash</td>
                <td>8,000.00</td>
            </tr>
            <tr>
                <td>Receivables</td>
                <td>1,500.00</td>
            </tr>
            <tr>
                <td>Finished Goods Inventory</td>
                <td>3,000.00</td>
            </tr>
            <tr>
                <td>Raw Materials</td>
                <td>500.00</td>
            </tr>
            <tr>
                <td>Prepaid Expenses</td>
                <td>600.00</td>
            </tr>
            <tr class="total">
                <td>Total Current Assets</td>
                <td>13,600.00</td>
            </tr>
            <tr class="section-title">
                <td>Fixed Assets</td>
                <td></td>
            </tr>
            <tr>
                <td>Fixed Assets</td>
                <td>2,000.00</td>
            </tr>
            <tr class="section-title">
                <td>Work-in-Progress</td>
                <td></td>
            </tr>
            <tr>
                <td>Work-in-Progress</td>
                <td>1,200.00</td>
            </tr>
            <tr class="total">
                <td>Total Assets</td>
                <td>16,800.00</td>
            </tr>
        </tbody>
    </table>

    <h2>Liabilities</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Liability Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr class="section-title">
                <td>Current Liabilities</td>
                <td></td>
            </tr>
            <tr>
                <td>Accounts Payable</td>
                <td>1,000.00</td>
            </tr>
            <tr>
                <td>Accrued Taxes</td>
                <td>1,000.00</td>
            </tr>
            <tr>
                <td>Accrued Wages</td>
                <td>800.00</td>
            </tr>
            <tr>
                <td>Accrued Expenses</td>
                <td>500.00</td>
            </tr>
            <tr>
                <td>Sales Tax Receivable</td>
                <td>400.00</td>
            </tr>
            <tr class="total">
                <td>Total Current Liabilities</td>
                <td>3,700.00</td>
            </tr>
            <tr class="section-title">
                <td>Loans</td>
                <td></td>
            </tr>
            <tr>
                <td>Short-Term Loan</td>
                <td>3,000.00</td>
            </tr>
            <tr>
                <td>Long-Term Loan</td>
                <td>5,000.00</td>
            </tr>
            <tr class="total">
                <td>Total Liabilities</td>
                <td>11,700.00</td>
            </tr>
        </tbody>
    </table>

    <h2>Equity</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Equity Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr class="section-title">
                <td>Owner's Equity</td>
                <td></td>
            </tr>
            <tr>
                <td>Owner's Equity Capital</td>
                <td>5,000.00</td>
            </tr>
            <tr class="section-title">
                <td>Retained Earnings</td>
                <td></td>
            </tr>
            <tr>
                <td>Retained Earnings from Last Year</td>
                <td>1,000.00</td>
            </tr>
            <tr class="section-title">
                <td>Revenue</td>
                <td></td>
            </tr>
            <tr>
                <td>Sales Revenue</td>
                <td>4,500.00</td>
            </tr>
            <tr>
                <td>Service Income</td>
                <td>400.00</td>
            </tr>
            <tr>
                <td>Embroidery Services Income</td>
                <td>500.00</td>
            </tr>
            <tr>
                <td>Miscellaneous Revenue</td>
                <td>200.00</td>
            </tr>
            <tr class="total">
                <td>Total Equity</td>
                <td>11,600.00</td>
            </tr>
        </tbody>
    </table>

    <h2>Balance Sheet Summary</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Category</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr class="total">
                <td>Total Assets</td>
                <td>16,800.00</td>
            </tr>
            <tr class="total">
                <td>Total Liabilities</td>
                <td>11,700.00</td>
            </tr>
            <tr class="total">
                <td>Total Equity</td>
                <td>11,600.00</td>
            </tr>
        </tbody>
    </table>

</body>
</html> -->

<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Statement</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
        }

        .total {
            font-weight: bold;
            background-color: #f4f4f4;
        }

        .section-title {
            background-color: #f0f0f0;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Income Statement</h1>

    <h2>Revenues</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Revenue Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sales Revenue (Garment Sales)</td>
                <td>4,500.00</td>
            </tr>
            <tr>
                <td>Service Income (Shipping)</td>
                <td>400.00</td>
            </tr>
            <tr>
                <td>Embroidery Services Income</td>
                <td>500.00</td>
            </tr>
            <tr>
                <td>Miscellaneous Revenue</td>
                <td>200.00</td>
            </tr>
            <tr class="total">
                <td>Total Revenues</td>
                <td>5,600.00</td>
            </tr>
        </tbody>
    </table>

    <h2>Cost of Goods Sold (COGS)</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Expense Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr class="section-title">
                <td>Raw Materials</td>
                <td></td>
            </tr>
            <tr>
                <td>Fabric Purchase</td>
                <td>800.00</td>
            </tr>
            <tr>
                <td>Trims and Accessories Purchase</td>
                <td>400.00</td>
            </tr>
            <tr class="total">
                <td>Total COGS</td>
                <td>1,200.00</td>
            </tr>
        </tbody>
    </table>

    <h2>Operating Expenses</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Expense Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr class="section-title">
                <td>Labor and Factory Costs</td>
                <td></td>
            </tr>
            <tr>
                <td>Direct Labor Costs</td>
                <td>1,000.00</td>
            </tr>
            <tr>
                <td>Factory Utility Costs</td>
                <td>600.00</td>
            </tr>
            <tr>
                <td>Machine Maintenance Costs</td>
                <td>200.00</td>
            </tr>
            <tr>
                <td>Factory Rent Expense</td>
                <td>1,500.00</td>
            </tr>
            <tr>
                <td>Depreciation of Factory Assets</td>
                <td>500.00</td>
            </tr>
            <tr>
                <td>Freight and Shipping Costs</td>
                <td>300.00</td>
            </tr>
            <tr class="section-title">
                <td>Administrative and General Expenses</td>
                <td></td>
            </tr>
            <tr>
                <td>Salaries for Administrative Staff</td>
                <td>2,000.00</td>
            </tr>
            <tr>
                <td>Office Supplies Purchased</td>
                <td>150.00</td>
            </tr>
            <tr>
                <td>Legal and Professional Fees</td>
                <td>300.00</td>
            </tr>
            <tr>
                <td>Marketing Expenses</td>
                <td>500.00</td>
            </tr>
            <tr class="total">
                <td>Total Operating Expenses</td>
                <td>7,550.00</td>
            </tr>
        </tbody>
    </table>

    <h2>Other Expenses</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Expense Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr class="section-title">
                <td>Financial Expenses</td>
                <td></td>
            </tr>
            <tr>
                <td>Interest Expense on Loan</td>
                <td>200.00</td>
            </tr>
            <tr class="section-title">
                <td>Tax Expenses</td>
                <td></td>
            </tr>
            <tr>
                <td>Income Tax Payable</td>
                <td>800.00</td>
            </tr>
            <tr class="total">
                <td>Total Other Expenses</td>
                <td>1,000.00</td>
            </tr>
        </tbody>
    </table>

    <h2>Income Statement Summary</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Category</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Revenues</td>
                <td>5,600.00</td>
            </tr>
            <tr>
                <td>Total COGS</td>
                <td>(1,200.00)</td>
            </tr>
            <tr class="total">
                <td>Gross Profit</td>
                <td>4,400.00</td>
            </tr>
            <tr>
                <td>Total Operating Expenses</td>
                <td>(7,550.00)</td>
            </tr>
            <tr>
                <td>Total Other Expenses</td>
                <td>(1,000.00)</td>
            </tr>
            <tr class="total">
                <td>Net Income (Loss)</td>
                <td>(4,150.00)</td>
            </tr>
        </tbody>
    </table>

</body>
</html> -->

<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Flow Statement</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
        }

        .total {
            font-weight: bold;
            background-color: #f4f4f4;
        }

        .section-title {
            background-color: #f0f0f0;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Cash Flow Statement</h1>

    <h2>Operating Activities</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Activity Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Cash Received from Customers</td>
                <td>1,000.00</td>
            </tr>
            <tr>
                <td>Cash Payments to Suppliers (Raw Materials)</td>
                <td>(1,200.00)</td>
            </tr>
            <tr>
                <td>Cash Payments for Operating Expenses</td>
                <td>(6,750.00)</td>
            </tr>
            <tr>
                <td>Cash Payments for Interest</td>
                <td>(200.00)</td>
            </tr>
            <tr>
                <td>Cash Payments for Taxes</td>
                <td>(800.00)</td>
            </tr>
            <tr class="total">
                <td>Net Cash from Operating Activities</td>
                <td>(7,950.00)</td>
            </tr>
        </tbody>
    </table>

    <h2>Investing Activities</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Activity Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Purchase of Fixed Assets (Machine and Equipment)</td>
                <td>(2,000.00)</td>
            </tr>
            <tr class="total">
                <td>Net Cash Used in Investing Activities</td>
                <td>(2,000.00)</td>
            </tr>
        </tbody>
    </table>

    <h2>Financing Activities</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Activity Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Owner's Equity Capital Contribution</td>
                <td>5,000.00</td>
            </tr>
            <tr>
                <td>Short-Term Loan Received</td>
                <td>3,000.00</td>
            </tr>
            <tr>
                <td>Long-Term Loan Received</td>
                <td>5,000.00</td>
            </tr>
            <tr class="total">
                <td>Net Cash from Financing Activities</td>
                <td>13,000.00</td>
            </tr>
        </tbody>
    </table>

    <h2>Cash Flow Summary</h2>
    <table class="table table-light table-striped w-75 mx-auto">
        <thead>
            <tr>
                <th>Category</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Net Cash from Operating Activities</td>
                <td>(7,950.00)</td>
            </tr>
            <tr>
                <td>Net Cash Used in Investing Activities</td>
                <td>(2,000.00)</td>
            </tr>
            <tr>
                <td>Net Cash from Financing Activities</td>
                <td>13,000.00</td>
            </tr>
            <tr class="total">
                <td>Net Change in Cash</td>
                <td>3,050.00</td>
            </tr>
            <tr>
                <td>Cash at Beginning of Period</td>
                <td>0.00</td>
            </tr>
            <tr class="total">
                <td>Cash at End of Period</td>
                <td>3,050.00</td>
            </tr>
        </tbody>
    </table>

</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Statements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .statement-section {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>

    <h1>Financial Statements</h1>

    <!-- Balance Sheet Section -->
    <div class="statement-section">
        <h2>Balance Sheet</h2>
        <table>
            <thead>
                <tr>
                    <th>Assets</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cash</td>
                    <td>$6,000.00</td> <!-- Based on transactions like cash received, deposits -->
                </tr>
                <tr>
                    <td>Accounts Receivable</td>
                    <td>$1,500.00</td> <!-- Receivables from customer payments -->
                </tr>
                <tr>
                    <td>Raw Materials</td>
                    <td>$500.00</td> <!-- Raw materials purchase -->
                </tr>
                <tr>
                    <td>Finished Goods Inventory</td>
                    <td>$3,000.00</td> <!-- Finished goods inventory addition -->
                </tr>
                <tr>
                    <td>Prepaid Expenses</td>
                    <td>$600.00</td> <!-- Payment for prepaid expenses -->
                </tr>
                <tr>
                    <td>Fixed Assets</td>
                    <td>$2,000.00</td> <!-- Purchase of fixed assets -->
                </tr>
            </tbody>
        </table>

        <h3>Liabilities</h3>
        <table>
            <thead>
                <tr>
                    <th>Liabilities</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Accounts Payable</td>
                    <td>$1,000.00</td> <!-- Accounts payable to suppliers -->
                </tr>
                <tr>
                    <td>Short-term Loan</td>
                    <td>$3,000.00</td> <!-- Short-term loan received -->
                </tr>
                <tr>
                    <td>Long-term Loan</td>
                    <td>$5,000.00</td> <!-- Long-term loan received -->
                </tr>
                <tr>
                    <td>Accrued Liabilities</td>
                    <td>$1,000.00</td> <!-- Accrued liabilities (taxes, wages, expenses) -->
                </tr>
            </tbody>
        </table>

        <h3>Equity</h3>
        <table>
            <thead>
                <tr>
                    <th>Equity</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Owner's Equity</td>
                    <td>$5,000.00</td> <!-- Owner's equity capital contribution -->
                </tr>
                <tr>
                    <td>Retained Earnings</td>
                    <td>$1,000.00</td> <!-- Retained earnings from last year -->
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Income Statement Section -->
    <div class="statement-section">
        <h2>Income Statement</h2>
        <table>
            <thead>
                <tr>
                    <th>Revenue</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sales Revenue</td>
                    <td>$4,500.00</td> <!-- Sales revenue from garment sales, custom orders, wholesale -->
                </tr>
                <tr>
                    <td>Service Income</td>
                    <td>$400.00</td> <!-- Service income from shipping -->
                </tr>
                <tr>
                    <td>Embroidery Services Income</td>
                    <td>$500.00</td> <!-- Embroidery services income -->
                </tr>
                <tr>
                    <td>Miscellaneous Revenue</td>
                    <td>$200.00</td> <!-- Miscellaneous revenue -->
                </tr>
            </tbody>
        </table>

        <h3>Expenses</h3>
        <table>
            <thead>
                <tr>
                    <th>Expenses</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Raw Materials Purchase</td>
                    <td>$800.00</td> <!-- Fabric and trims/accessories purchase -->
                </tr>
                <tr>
                    <td>Direct Labor Costs</td>
                    <td>$1,000.00</td> <!-- Direct labor costs for production staff -->
                </tr>
                <tr>
                    <td>Factory Utility Costs</td>
                    <td>$600.00</td> <!-- Factory utility costs -->
                </tr>
                <tr>
                    <td>Machine Maintenance Costs</td>
                    <td>$200.00</td> <!-- Machine maintenance costs -->
                </tr>
                <tr>
                    <td>Factory Rent Expense</td>
                    <td>$1,500.00</td> <!-- Factory rent expense -->
                </tr>
                <tr>
                    <td>Depreciation of Factory Assets</td>
                    <td>$500.00</td> <!-- Depreciation of factory assets -->
                </tr>
                <tr>
                    <td>Freight and Shipping Costs</td>
                    <td>$300.00</td> <!-- Freight and shipping costs -->
                </tr>
                <tr>
                    <td>Marketing Expenses</td>
                    <td>$500.00</td> <!-- Marketing expenses -->
                </tr>
                <tr>
                    <td>Salaries for Administrative Staff</td>
                    <td>$2,000.00</td> <!-- Salaries for administrative staff -->
                </tr>
                <tr>
                    <td>Office Supplies Purchased</td>
                    <td>$150.00</td> <!-- Office supplies purchased -->
                </tr>
                <tr>
                    <td>Legal and Professional Fees</td>
                    <td>$300.00</td> <!-- Legal and professional fees -->
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Cash Flow Section -->
    <div class="statement-section">
        <h2>Cash Flow</h2>
        <table>
            <thead>
                <tr>
                    <th>Cash Flow from Operating Activities</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cash Received from Customers</td>
                    <td>$6,000.00</td> <!-- Cash received from customer payment -->
                </tr>
                <tr>
                    <td>Cash Paid for Raw Materials</td>
                    <td>-$800.00</td> <!-- Cash paid for raw materials purchase -->
                </tr>
                <tr>
                    <td>Cash Paid for Labor</td>
                    <td>-$1,000.00</td> <!-- Cash paid for direct labor -->
                </tr>
                <tr>
                    <td>Cash Paid for Operating Expenses</td>
                    <td>-$3,250.00</td> <!-- Cash paid for various expenses -->
                </tr>
            </tbody>
        </table>

        <h3>Cash Flow from Financing Activities</h3>
        <table>
            <thead>
                <tr>
                    <th>Cash Flow from Financing Activities</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Short-term Loan Received</td>
                    <td>$3,000.00</td> <!-- Short-term loan received -->
                </tr>
                <tr>
                    <td>Long-term Loan Received</td>
                    <td>$5,000.00</td> <!-- Long-term loan received -->
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
