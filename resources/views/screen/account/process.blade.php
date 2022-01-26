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

<p>คำสำคัญที่อยู่ในโครงการทั้งหมดของนักวิจัย ด้วยใช้วิธี Term Frequency - Raw counts เพื่อหาคำสัญ </p>
<p><b style="color: #ffdd59">สีเหลือง</b> คือ ไม่สำคัญ , มีจำนวนคำนี้อยู่น้อย </p>
<p><b style="color: #0be881">สีเขียว</b> คือ ค่อนข้างสำคัญ , มีจำนวนคำนี้อยู่ระดับปานกลาง </p>
<p><b style="color: #f53b57">สีแดง</b> คือ สำคัญมาก หรือ ไม่สำคัญ , มีจำนวนคำนี้อยู่เยอะและเป็นค่าโดด </p>

<hr>

<style>
    .badge-primary{
        background-color:#9C27B0;/*สีพื้นหลังปุ่ม*/
    }
    
    </style>

<form action="{{route("keyword_savekwd_data")}}" method="post">

    {{ csrf_field() }}

    <input type="hidden" name="count" value="{{count($dataText)}}">

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>อักษร</th>
                    <th>จำนวนที่ปรากฏ</th>
                    <th>ระดับความสำคัญ</th>
                    <th>จัดหมวดหมู่</th>
                    <th>หมวดหมู่ที่พบใกล้เตียง</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataText as $index => $item )
                <tr>
                    <td>{{ $index + 1}}</td>
                    <td><input type="text" class="form-control" name="keyword[]" value="{{$item['text']}}" readonly>
                    </td>
                    <td>{{$item['count']}}</td>

                    @if ($item['count'] >= $maxNumber)
                    <td style="background-color: #f53b57;"></td>
                    @else
                    @if ($item['count'] != 1)
                    <td style="background-color: #0be881;"></td>
                    @else
                    <td style="background-color: #ffdd59;"></td>

                    @endif
                    @endif

                    <td>
                        <select class="selectpicker form-control" name="value{{$index}}[]" data-live-search="true"
                            multiple data-selected-text-format="count">
                            @foreach ($selectItem as $el)
                            <option value="{{$el["id"]}}">{{$el["name_th"]}}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>

                        @php
                        $data = [];
                        $char = \App\Model\Keyword::where('text', '=', $item['text'])->get();

                        if(count($char) != 0){
                            foreach ($char as $val) {
                                foreach (json_decode($val["dep_id_all"]) as $lav) {
                                    array_push($data , $lav);
                                }
                            }
                        }else{
                            $data = [];
                        }

                        @endphp

                        @if (count($data) != 0)

                        @foreach ($data as $elm)

                        @php
                             $storechar = \App\Model\Department::find($elm);
                        @endphp

                        @if ($storechar)

                        <span class="badge badge-primary" style="font-weight: normal; font-size: 16px;">{{$storechar["name_th"]}}</span>
                            
                        @endif
            
                        @endforeach
                        @endif

                    </td>


                  

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="padding-bottom: 1%;"></div>

    <button type="submit" class="btn btn-block btn-success">บันทึก</button>

</form>





@endsection

@section('script_footer')

<script>
    $(function () {
      $("#dataTable").DataTable({
        "responsive": true,
        "paging": false,
        "autoWidth": true,
        "searching": false,
      });

      $('.selectpicker').selectpicker();
    });
</script>


@endsection