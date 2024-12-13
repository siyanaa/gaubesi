@extends('frontend.layouts.master')

{{--navbar --}}
@section("content")

{{--bannersection --}}
@include("frontend.include.indexbanner")

{{--explore --}}
@include("frontend.include.explore")

{{--day of deal and product deal --}}
@include("frontend.include.dayofdeal")

{{--day of deal and product deal --}}
@include("frontend.include.productdeal")

{{--advertisement --}}
@include("frontend.include.advertisement")

{{--hotandfeature --}}
@include("frontend.include.hotandfeature")

{{--categories--}}
@include("frontend.include.categories")








@endsection

