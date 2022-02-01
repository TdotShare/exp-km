@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => null ],
    [ "name" => "รายงานผล" , "url" => null ],
]

?>


@section('script_header')

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

@endsection

@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "ภาพรวมระบบ" , "breadcrumb" => $breadcrumb])

@endcomponent

@endsection


<!-- CONTENT -->

@section('content')

@if (session('alert'))


<div class="alert alert-{{session('status')}} alert-dismissible fade show" role="alert">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif


<div class="row">

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-font"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">คำอ่านที่ถูกจัดหมวด</span>
                <span class="info-box-number">{{$itemChar}} คำ</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-graduate"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">สาขาความเชี่ยวชาญ</span>
                <span class="info-box-number">{{$itemDep}} สาขา</span>
            </div>
        </div>
    </div>

</div>


@endsection



@section('script_footer')

@endsection