@extends('layouts.master')

@section('content')
<!-- Page title -->
<!-- <section id="page-title" class="page-title-center text-light" style="background-image:url({{ asset('polo-5/images/parallax/2.jpg') }});">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="page-title">
            <span class="post-meta-category"><a href="">Tutoya</a></span>
            <h1>Welcome {{ auth()->user()->name }}</h1>
            <div class="small m-b-20">{{ date('d F Y') }} | <a href="#">{{ date('H:i:s') }}</a></div>
        </div>
    </div>
</section> -->
<!-- end: Page title -->
<!-- Page Content -->
<section id="page-content" class="">
    <div class="container">
        <!-- Page title -->
        <div class="page-title">
            <h1>Pembelian Pribadi</h1>
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Riwayat Transaksi</a></li>
                    <li class="breadcrumb-item active"><a href="#">Pembelian Pribadi</a></li>
                </ul>
            </div>
        </div>
        <!-- end: Page title -->
        <!-- DataTable -->
        <div class="row mb-3">
            <!-- <div class="col-lg-6">
                <h4>DataTables</h4>
                <p>Add advanced interaction controls to your HTML tables</p>
            </div> -->
            <!-- <div class="col-lg-6 text-right">
                <button type="button" class="btn btn-light"><i class="icon-plus"></i> Add Record</button>
                <div class="p-dropdown ml-3 float-right">
                    <a class="title btn btn-light"><i class="icon-sliders"></i> Options</a>
                    <div class="p-dropdown-content">
                        <ul>
                            <li><a href="#"><i class="icon-refresh-cw"></i>Update Records</a></li>
                            <li><a href="#"><i class="icon-edit"></i>Edit</a></li>
                            <li><a href="#"><i class="icon-x"></i>Delete</a></li>
                            <li>
                                <hr>
                            </li>
                            <li><a href="#"><i class="icon-life-buoy"></i>Documentation</a></li>
                            <li><a href="#"><i class="icon-mail"></i>Email Support Team</a></li>
                            <li><a href="#"><i class="icon-alert-triangle"></i>Report an issue</a></li>
                        </ul>
                    </div>
                </div>
                <div id="export_buttons" class="mt-2"></div>
            </div> -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="datatable" class="table table-bordered table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Invoice Date</th>
                            <th>Due Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <!-- <th>Shipment</th> -->
                            <th class="noExport">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                        <tr>
                            <td><a href="{{ route('dashboard.invoice', $payment) }}">{{ $payment->transactionno }}</a></td>
                            <td>{{ $payment->invoice_date_format }}</td>
                            <td>{{ $payment->invoice_duedate_format }}</td>
                            <td>{{ $payment->total_format }}</td>
                            <td><span class="badge badge-pill badge-{{ $payment->status_desc['color'] }}">{{ $payment->status_desc['text'] }}</span></td>
                            <!-- <td>{{ $payment->shipping_receipt }}</td> -->
                            <td>
                                <!-- <a class="ml-2" href="{{ route('checkout.index', $payment) }}" data-toggle="tooltip" data-original-title="Pay"><i class="icon-shopping-bag"></i></a> -->
                                <!-- <a class="ml-2" href="#" data-toggle="tooltip" data-original-title="Delete"><i class="icon-trash-2"></i></a>
                                <a class="ml-2" href="#" data-toggle="tooltip" data-original-title="Settings"><i class="icon-settings"></i></a> -->
                                @if($payment->status == 3)
                                    <!-- <div class="rateit" data-rateit-mode="font" data-productid="0"></div> -->
                                    <a href="{{ route('review.index', ['transactionno' => $payment]) }}" class="btn btn-outline btn-sm">Give Review</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No orders found</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Invoice #</th>
                            <th>Invoice Date</th>
                            <th>Due Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <!-- <th>Shipment</th> -->
                            <th class="noExport">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- end: DataTable -->
    </div>
</section>
<!-- end: Page Content -->
@endsection