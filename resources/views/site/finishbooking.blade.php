@extends('site.layouts.site')
@section('content')
<link href="{{ dsAsset('site/css/custom/website-booking.css') }}" rel="stylesheet" />
<script src="{{ dsAsset('site/js/custom/website-booking.js') }}"></script>

<!--start banner section -->
<section class="banner-area position-relative" style="background:url({{$appearance->background_image}}) no-repeat;">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative text-center">
                    <h1 class="text-capitalize mb-3 text-white">Su cita fue agendada con éxito. <br> Un mail fue enviado como respaldo.</h1>
                    {{-- <a class="text-white" href="{{route('site.home')}}">{{translate('Home')}} </a>
                    <i class="icofont-long-arrow-right text-white"></i>
                    <a class="text-white" href="{{route('site.appoinment.booking')}}"> {{translate('Appointment Booking')}}</a> --}}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end banner section -->

<!-- Start booking Area -->

<!-- End booking Area -->

@endsection