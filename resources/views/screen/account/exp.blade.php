@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => route('dashboard_index_page') ],
    [ "name" => "ข้อมูลนักวิจัยทั้งหมด" , "url" => route('researcher_index_page') ],
    [ "name" => $model->user_id , "url" => null ],
];


?>


@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "ความเชี่ยวชาญที่บันทึก ($model->user_first_name_th $model->user_last_name_th)" , "breadcrumb" => $breadcrumb])

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

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">ความเชี่ยวชาญ</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expworkData as $index => $item )                
                    <tr>
                        <td scope="row">{{ $index + 1}}</td>
                        <td>{{$item['name_th']}}</td>
                        <td><a href={{route("researcher_exp_delete_data" , ["id" => $item->id ])}}><button class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> ลบข้อมูล</button></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

@section('script_footer')

<script>
    $(function () {


    });
</script>


@endsection