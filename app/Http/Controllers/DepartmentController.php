<?php

namespace App\Http\Controllers;

use App\Model\Department;
use App\Model\Keyword;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function actionIndex(Request $request)
    {
        $model = Department::all();
        return view("screen.department.index", ["model" => $model]);
    }

    public function actionCreate(Request $request)
    {
        if($request->method() != "POST"){

            return view("screen.department.create");

        }else{

            $model = new Department();
            $model->name_th =  $request->name_th;
            $model->name_eng =  $request->name_eng;
            $model->group_name =  $request->group_name;

            if($model->save()){
                return $this->responseRedirectRoute("department_index_page", "เพิ่มข้อมูลสาขา $model->name_th สำเร็จ !");
            }else{
                return $this->responseRedirectBack("ไม่สามารถสร้างข้อมูล สาขาได้กรุณาลองใหม่อีกครั้ง !");
            }

        }
    }

    public function actionDelete($id)
    {
        $model = Department::find($id);

        $bypass = false;
        $checkKeyword = Keyword::all();

        for ($i=0; $i < count($checkKeyword); $i++) { 
            if(in_array($model->id , json_decode($checkKeyword[$i]->dep_id_all) )){
                $bypass = true;
                break;
            }
        }

        if($bypass){
            return $this->responseRedirectBack("ไม่สามารถลบได้เนื่องจาก '$model->name_th' ถูกใช้งานอยู่  !" , "warning");
        }

        if ($model->delete()) {
            return $this->responseRedirectBack("ลบข้อมูล $model->name_th สำเร็จ !");
        } else {
            return $this->responseRedirectRoute("department_index_page", "ไม่พบข้อมูลที่ต้องการลบ !");
        }
    }

    public function actionUpdate(Request $request)
    {


        if($request->method() != "POST"){

            $model = Department::find($request->id);
            if($model){
                return view("screen.department.update", ["model" => $model]); 
            }else{
                return $this->responseRedirectRoute("department_index_page", "ไม่พบข้อมูลที่ต้องการค้นหา !");
            }
           

        }else{

            $model = Department::find($request->id);

            if ($model) {

                $model->name_th =  $request->name_th;
                $model->name_eng =  $request->name_eng;
                $model->group_name =  $request->group_name;

                if($model->save()){
                    return $this->responseRedirectBack("อัปเดตข้อมูลสำเร็จ !");
                }else{
                    return $this->responseRedirectBack("อัปเดตข้อมูลไม่สำเร็จ !" , "warning");
                }
                
            } else {
                return $this->responseRedirectRoute("department_index_page", "ไม่พบข้อมูลที่ต้องการแก้ไข !");
            }

        }
    }

    protected function responseRedirectBack($message, $status = "success", $alert = true)
    {
        return redirect()->back()->with(["message" => $message, "status" => $status, "alert" => $alert]);
    }

    protected function responseRedirectRoute($route, $message, $status = "success", $alert = true)
    {
        //primary , success , danger , warning
        return redirect()->route($route)->with(["message" => $message, "status" => $status, "alert" => $alert]);
    }

    protected function responseRequest($data, $bypass = true,  $status = "success")
    {
        //danger , warning , success , secondary
        return response()->json(['bypass' => $bypass,  'status' => $status, 'data' => $data], 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header("Access-Control-Allow-Headers", "Authorization, Content-Type")
            ->header('Access-Control-Allow-Credentials', ' true');
    }
}
