@extends('student.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div>Payments
                        </div>
                    </div>
                </div>
            </div>
            <h5>Payment to be made</h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover bg-table" id="payment_table">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Fees Type</th>
                                        <th>Next Due Date</th>
                                        <th>Total Cost(&#x20B9;)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->due_payment as $dueIndex => $duePayment)
                                        <tr>
                                            <td>{{$duePayment->id}}</td>
                                            <td>
                                                @php
                                                    $feeType = 'Admission Fees';
                                                    switch($duePayment->fee_type){
                                                        case 'admission_fee' : $feeType = 'Admission Fees with 1 month class fee';break;
                                                        case 'course_fee' : $feeType = 'Course Fee';break;
                                                        case 'class_fee' : $feeType = 'Class Fee';break;
                                                    }
                                                    // echo $feeType. ' ('.getNameofClassOrCourse($duePayment).')';
                                                @endphp
                                                <span>{{ $feeType }} <span class="badge badge-info">{{ getNameofClassOrCourse($duePayment) }}</span></span>
                                            </td>
                                            <td>{{date('M d, Y',strtotime($duePayment->due_date))}}</td>
                                            <td>
                                                @php
                                                    if ($duePayment->class_id > 0 && $duePayment->course_id > 0) {
                                                        $extraDate = extraDateFineCalculation($duePayment->class_id,$duePayment->course_id,$duePayment->due_date,Auth::user()->id);
                                                    }
                                                    if ($duePayment->class_id == 0 && $duePayment->course_id > 0) {
                                                        $extraDate = extraDateFineCalculation(0,$duePayment->course_id,$duePayment->due_date,Auth::user()->id);
                                                    }
                                                    if ($duePayment->class_id > 0 && $duePayment->course_id == 0) {
                                                        $extraDate = extraDateFineCalculation($duePayment->class_id,0,$duePayment->due_date,Auth::user()->id);
                                                    }

                                                    if ($extraDate > 0) {
                                                        $fine = $extraDate * 10;
                                                        $amount = $duePayment->amount + $fine;
                                                    }else{
                                                        $amount = $duePayment->amount;
                                                    }
                                                @endphp
                                                <span>{{ $amount }}
                                                    @if (isset($fine))
                                                        <span data-toggle="tooltip" data-placement="top" title="Fine" class="badge badge-warning">+{{ $fine }}</span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{!! route('payment.capture') !!}" method="POST" id="payment_form">
                                                    @csrf
                                                    <input type="hidden" name="redirectURL" value="{{route('user.razorpaypayment',$duePayment->id)}}">
                                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                            data-key="{{ env('RAZORPAY_KEY') }}"
                                                            data-amount="{{($amount) * 100}}"
                                                            data-name="Leading Lights"
                                                            data-description=""
                                                            data-image="{{ asset('img/logo.jpg') }}"
                                                            data-theme.color="#F0FFF0">
                                                    </script>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <h5>Successful Payments</h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover bg-table" id="payment_table1">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Fees Type</th>
                                        <th>Total Cost(&#x20B9;)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->success_payment as $successIndex => $successPayment)
                                        <tr>
                                            <td>{{$successPayment->id}}</td>
                                            <td>
                                                @php
                                                    $feeType = 'Admission Fees';
                                                    switch($successPayment->fee_type){
                                                        case 'admission_fee' : $feeType = 'Admission Fees with 1 month class fee';break;
                                                        case 'course_fee' : $feeType = 'Course Fee';break;
                                                        case 'class_fee' : $feeType = 'Class Fee';break;
                                                    }
                                                    // echo $feeType. ' ('.getNameofClassOrCourse($duePayment).')';
                                                @endphp
                                                <span>{{ $feeType }} <span class="badge badge-info">{{ getNameofClassOrCourse($duePayment) }}</span></span>
                                            </td>
                                            <td>&#x20B9;{{$successPayment->amount}}</td>
                                            <td>
                                                <button class="mb-2 mr-2 btn-pill btn btn-dark btn-lg">Paid Successfully
                                                    <span class="ml-3">
                                                        <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                                    </span>
                                                </button>
                                                <a class="mb-2 mr-2 btn-pill btn btn-info btn-lg" href="{{ route('user.payment_receipt', $successPayment->id) }}"><i class="fa fa-download mr-2"></i>Download Receipt</a>
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
        @include('teacher.layouts.static_footer')
    </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#payment_table').DataTable({
                order : [],
                // responsive: true
            });
            $('#payment_table1').DataTable({
                responsive: true,
                order : [],
            });
        });
        $('.razorpay-payment-button').addClass('mb-2 mr-2 btn-pill btn btn-primary btn-lg');
        $('.razorpay-payment-button').on('click',function() {
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "To make payment!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, SURE!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('payment_form').submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your payment is declined :)',
                        'error'
                    )
                }
            })
        })
    </script>
@endsection
