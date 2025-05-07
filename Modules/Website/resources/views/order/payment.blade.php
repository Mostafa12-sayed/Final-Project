@extends('website::layouts.master')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="mb-3">Order #{{ $order->id }}</h2>
                <p class="mb-4">Total: {{ number_format($order->total, 2) }} EGP</p>

                <div class="iframe-wrapper">
                    <iframe src="{{ $iframeUrl }}" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <style>
        .iframe-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */

            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: #f9f9f9;
            overflow: hidden;
            height: 800px !important;
        }

        .iframe-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 12px;
        }
    </style>
@endsection
