@component('mail::message')

#### Hello, {{ $payment->user->fullname }}
Thanks for using PixInvent. This is an invoice for your recent purchase.

**Amount Due**: {{ $payment->total_format }} <br>
**Due By**: {{ $payment->invoice_duedate_format }}
@component('mail::table')
| Invoice No                         | Date Issued                             |
|:---------------------------------- | ---------------------------------------:|
| **#{{ $payment->transactionno }}** | **{{ $payment->invoice_date_format }}** |
@endcomponent

@component('mail::table')
| No                     | Product                      | Price                            | Quantity                     | Total                            |
|:---------------------- |:---------------------------- |:-------------------------------- |:---------------------------- |:-------------------------------- |
@foreach($payment->transactions as $transaction)
| {{ $loop->index + 1 }} | {{ $transaction->itemname }} | {{ $transaction->price_format }} | {{ $transaction->quantity }} | {{ $transaction->total_format }} |
@endforeach
@endcomponent

@component('mail::button', ['url' => $url])
Pay Invoice
@endcomponent

If you have any questions about this invoice, simply reply to this email or reach out to our [support team](mailto:$config->email) for help.
<br>

Regards,<br>
{{ $config->name }}

@endcomponent