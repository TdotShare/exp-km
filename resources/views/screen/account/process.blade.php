@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => route('dashboard_index_page') ],
    [ "name" => "ข้อมูลนักวิจัยทั้งหมด" , "url" => route('researcher_index_page') ],
    [ "name" => $idRes , "url" => route("researcher_view_page" , ["id" => $idRes ])  ],
    [ "name" => "TF-IDF" , "url" => null ],
];


?>


@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "Term Frequency - Raw counts" , "breadcrumb" => $breadcrumb])

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

<p>คำสำคัญที่อยู่ในโครงการทั้งหมดของนักวิจัย ด้วยใช้วิธี TF-IDF เพื่อหาคำสัญ </p>
<p>N  คือ จำนวน`คำ`</p>
<p>T  คือ จำนวน`คำ`ทั้งหมดที่มีในเอกสาร</p>
<p>D  คือ จำนวน`เอกสาร` ที่ใช้ทั้งหมด</p>

<hr>

<style>
    .badge-primary{
        background-color:#9C27B0;/*สีพื้นหลังปุ่ม*/
    }
    
    </style>

<form action="{{route("keyword_savekwd_data")}}" method="post">

    {{ csrf_field() }}

    <input type="hidden" name="count" value="{{count($dataText)}}">

   
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    {{-- <th>ลำดับ</th> --}}
                    <th>อักษร</th>
                    {{-- <th>จำนวนคำ</th> --}}
                    <th>TF (N/T)</th>
                    <th>IDF (log(D/N))</th>
                    <th>TF-IDF (TFxIDF)</th>
                    <th>จัดหมวดหมู่</th>
                    <th>หมวดหมู่ที่พบใกล้เตียง</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataText as $index => $item )

                @php
                    $data = [];
                    $char = \App\Model\Keyword::where('text', '=', $item['text'])->first();
                @endphp
                
                <tr>
                    {{-- <td>{{ $index + 1}}</td> --}}
                    <td><input type="text" class="form-control" name="keyword[]" value="{{$item['text']}}" readonly></td>
                    {{-- <td>{{$item['count']}}</td> --}}
                    <td>{{$item['tf_value']}}</td>
                    <td>{{$item['idf_value']}}</td>
                    <td>{{$item['tfidf_value']}}</td>
                    <td>
                        <select class="selectpicker form-control" name="value{{$index}}[]" data-live-search="true"
                            multiple data-selected-text-format="count">
                            @foreach ($selectItem as $el)
                                @if (in_array( $el["id"] , $char ? json_decode($char->dep_id_all) :  [] ))
                                    <option value={{$el["id"]}} selected>{{$el["name_th"]}}</option>
                                @else
                                    <option value={{$el["id"]}}>{{$el["name_th"]}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>

                    <td>                 
                        @php
                            foreach ($char ? json_decode($char->dep_id_all) : [] as $lav) {
                                array_push($data , $lav);
                            }

                            $storechar = count($data) == 0 ? [] : \App\Model\Department::select('name_th')->whereIn("id" , $data)->get();
                        @endphp
                      
                        @foreach ($storechar as $item)
                            <span class="badge badge-primary" style="font-weight: normal; font-size: 16px;">{{$item["name_th"]}}</span>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    

    <div style="padding-bottom: 1%;"></div>

    <button type="submit" class="btn btn-block btn-success">บันทึก</button>

    <div style="padding-bottom: 1%;"></div>

</form>





@endsection

@section('script_footer')

<script>
    $(function () {
        
    //   $("#dataTable").DataTable({
    //     "responsive": true,
    //     "paging": false,
    //     "autoWidth": true,
    //     "searching": false,
    //   });

      $('.selectpicker').selectpicker();
    });
</script>


@endsection