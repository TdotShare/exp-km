@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => route('dashboard_index_page') ],
    [ "name" => "ประมวลผลความเชี่ยวชาญ" , "url" => null ],
];


?>

@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "ประมวลผลความเชี่ยวชาญ" , "breadcrumb" => $breadcrumb])

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

<div style="padding-bottom: 1%;"></div>


<table id="dataTable" class="table table-bordered table-striped" width=100%>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>รหัสนักวิจัย</th>
            <th>ชื่อจริง</th>
            <th>นามสกุล</th>
            <th>email</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($model as $index => $item)
        <tr>
            <td>{{$index + 1}}</td>
            <td>{{$item->user_id}}</td>
            <td>{{$item->user_first_name_th}}</td>
            <td>{{$item->user_last_name_th}}</td>
            <td>{{$item->user_mail}}</td>
            <td><a href={{route("researcher_view_page" , ["id" => $item->user_id ])}} ><button class="btn btn-primary btn-block"><i class="fas fa-edit"></i> ดึงข้อมูลประมวลผล</button></a></td>
            <td><a href={{route("researcher_exp_page" , ["id" => $item->user_id ])}} ><button class="btn btn-primary btn-block"><i class="fas fa-edit"></i> ความเชี่ยวชาญที่บันทึก</button></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('script_footer')

<script>
    $(function () {
      $("#dataTable").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
</script>


@endsection