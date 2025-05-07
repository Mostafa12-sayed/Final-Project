@extends('dashboard::layouts.master')
@section('title', 'Invoice')
@section('content')
    <div class="page-header p-3">
        <a href="{{route('admin.orders.index')}}" class="btn btn-primary float-end">Back</a>
    </div>
        <div class="page-content mt-2">
            <div class="container-xxl">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <!-- Logo & title -->
                                <div class="clearfix pb-3 bg-info-subtle p-lg-3 p-2 m-n2 rounded position-relative">
                                    <div class="float-sm-start">
                                        <div class="auth-logo">
                                            <h2 class="text-black  ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 64 64" style=" enable-background:new 0 0 24 24" xml:space="preserve"><style>.st0{display:none}.st1{display:inline}.st2{fill:#f1f2f2}.st3{fill:#36d7b7}.st4{fill:none;stroke:#414042;stroke-miterlimit:10}.st5,.st6,.st7{display:inline;fill:#d1d3d4}.st6,.st7{fill:#414042}.st7{fill:none;stroke:#414042;stroke-miterlimit:10}.st8{fill:#fff}.st9{fill:#f5ab35}.st10{fill:#f9cd86}.st11,.st12{display:inline;fill:#36d7b7}.st12{fill:#fff}.st13,.st14,.st16{display:inline;fill:#e6e7e8}.st14,.st16{fill:#5edfc5}.st16{fill:#f7bc5d}.st17,.st18,.st19{display:inline;fill:#f5ab35}.st18,.st19{fill:#b88028}.st19{fill:#29a189}.st20{fill:#e6e7e8}.st21{fill:#bcbec0}.st22{fill:#58595b}.st23{fill:#29a189}.st24{fill:#414042}.st25{fill:#d1d3d4}.st26{display:inline;fill:#bcbec0}.st27{fill:#f1f2f2}.st27,.st28,.st34{display:inline}.st28{fill:none;stroke:#414042;stroke-linecap:round;stroke-miterlimit:10}.st34{fill:#afefe2}</style><g id="icons"><g id="XMLID_803_"><path id="XMLID_785_" class="st3" d="M53.4 22.1H21.7L26 36.4h24.9z"/><path id="XMLID_793_" class="st4" d="m13.2 20.5 7.8.6 6.8 21.1h21.7"/><path id="XMLID_791_" class="st4" d="M24.5 25.2h27.4"/><path id="XMLID_795_" class="st4" d="M25.6 28.5h25.5"/><path id="XMLID_796_" class="st4" d="M26.7 31.8h23.8"/><path id="XMLID_790_" class="st4" d="M26 36.4h24.9"/><circle id="XMLID_794_" class="st9" cx="32.7" cy="42.2" r="2.6"/><circle id="XMLID_792_" class="st24" cx="32.7" cy="42.2" r="1"/><circle id="XMLID_788_" class="st4" cx="32.7" cy="42.2" r="2.6"/><circle id="XMLID_787_" class="st9" cx="45.2" cy="42.2" r="2.6"/><circle id="XMLID_786_" class="st24" cx="45.2" cy="42.2" r="1"/><circle id="XMLID_784_" class="st4" cx="45.2" cy="42.2" r="2.6"/><path id="XMLID_789_" transform="matrix(.9972 .07536 -.07536 .9972 1.597 -1.083)" class="st9" d="M11.2 19.5h7.9v2.3h-7.9z"/><path id="XMLID_801_" class="st4" d="M20.7 27.2H10.6"/><path id="XMLID_800_" class="st4" d="M21.8 30.9h-8.4"/><path id="XMLID_802_" class="st4" d="M23.1 34.6h-5.7"/></g></g></svg>
                                                Medion
                                            </h2>                                        </div>
                                        <div class="mt-4">
                                            <h4>{{$order->store->name}}</h4>
                                            <address class="mt-3 mb-0">
                                                {{optional(optional($order->store)->admin)->address}}
                                                <br>
                                                <abbr title="Phone">Phone:</abbr>  {{optional(optional($order->store)->admin)->phone}}
                                            </address>
                                        </div>
                                    </div>
                                    <div class="float-sm-end">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td class="p-0 pe-5 py-1">
                                                            <p class="mb-0 text-dark fw-semibold"> Order ID : </p>
                                                        </td>
                                                        <td class="text-end text-dark fw-semibold px-0 py-1">#{{$order->number}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-0 pe-5 py-1">
                                                            <p class="mb-0">Creation Date: </p>
                                                        </td>
                                                        <td class="text-end text-dark fw-medium px-0 py-1">{{$order->created_at->format('d M Y')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-0 pe-5 py-1">
                                                            <p class="mb-0">Amount : </p>
                                                        </td>
                                                        <td class="text-end text-dark fw-medium px-0 py-1">${{$order->total}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-0 pe-5 py-1">
                                                            <p class="mb-0">Status : </p>
                                                        </td>
                                                        <td class="text-end px-0 py-1"><span class="badge bg-success text-white  px-2 py-1 fs-13">{{$order->payment_status=='paid' ? 'Paid' : 'Unpaid'}}</span></td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="position-absolute top-100 start-50 translate-middle">
                                        <img src="assets/images/check-2.png" alt="" class="img-fluid">
                                    </div>
                                </div>

                                <div class="clearfix pb-3 mt-4">
                                    <div class="float-sm-start">
                                        <div class="">
                                            <h4 class="card-title">Customer Details :</h4>
                                            <div class="mt-3">
                                                <h4>{{optional($order->address)->first_name }} {{optional($order->address)->last_name}}</h4>
                                                <p>{{optional($order->address)->country }},{{optional($order->address)->city}},{{optional($order->address)->street_addresses}} ,{{optional($order->address)->state}}</p>
                                                <p class="mb-2">{{optional($order->address)->name}}</p>
                                                <p class="mb-2"><span class="text-decoration-underline">Phone :</span>{{optional($order->address)->phone_number }}</p>
                                                <p class="mb-2"><span class="text-decoration-underline">Email :</span> {{optional($order->address)->email }}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive table-borderless text-nowrap table-centered">
                                            <table class="table mb-0">
                                                <thead class="bg-light bg-opacity-50">
                                                    <tr>
                                                        <th class="border-0 py-2">Product Name</th>
                                                        <th class="border-0 py-2">Quantity</th>
                                                        <th class="border-0 py-2">Price</th>
                                                        <th class="text-end border-0 py-2">Total</th>
                                                    </tr>
                                                </thead> <!-- end thead -->
                                                <tbody>
                                                    @foreach($order->items as $item)
                                                    <tr>

                                                        <td>
                                                            <div class="d-flex align-items-center gap-3">
                                                                <div class="rounded bg-light avatar d-flex align-items-center justify-content-center">
                                                                    <img src="{{asset(optional($item->product)->image)}}" alt="" class="avatar">
                                                                </div>
                                                                <div>

                                                                    <a data-href="{{route('admin.products.show', ['product'=>$item->product_id])}}" style="cursor: pointer;" data-container="#hr-table-modal" class="text-dark fw-medium fs-15 btn-modal">{{$item->product_name}}</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$item->quantity}}</td>
                                                        <td>${{$item->price}}</td>
                                                        <td class="text-end">
                                                            ${{ number_format($item->price * $item->quantity, 2) }}
                                                        </td>                                                    </tr>
                                                    @endforeach
                                                </tbody> <!-- end tbody -->
                                            </table> <!-- end table -->
                                        </div> <!-- end table responsive -->
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="row justify-content-end">
                                    <div class="col-lg-5 col-6">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                <tr class="border-top">
                                                    <td class="text-end p-0 pe-5 py-2">
                                                        <p class="mb-0 text-dark fw-semibold">Tex : </p>
                                                    </td>
                                                    <td class="text-end text-dark fw-semibold  py-2">${{$order->tax}}</td>
                                                </tr>
                                                <tr class="border-top">
                                                    <td class="text-end p-0 pe-5 py-2">
                                                        <p class="mb-0 text-dark fw-semibold">Tex : </p>
                                                    </td>
                                                    <td class="text-end text-dark fw-semibold  py-2">${{$order->shipping}}</td>
                                                </tr>
                                                <tr class="border-top">
                                                    <td class="text-end p-0 pe-5 py-2">
                                                        <p class="mb-0 text-dark fw-semibold">Discount : </p>
                                                    </td>
                                                    <td class="text-end text-dark fw-semibold  py-2">-${{$order->discount}}</td>
                                                </tr>
                                                <tr class="border-top">
                                                    <td class="text-end p-0 pe-5 py-2">
                                                        <p class="mb-0 text-dark fw-semibold">Grand Amount : </p>
                                                    </td>
                                                    <td class="text-end text-dark fw-semibold  py-2">${{$order->total}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="mt-3 mb-1">
                                    <div class="text-end d-print-none">
                                        <a href="javascript:window.print()" class="btn btn-info width-xl">Print</a>
                                    </div>
                                </div>

                            </div> <!-- end card body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div>

        </div>


@endsection
