<?php

namespace App\Http\Controllers;

use App\Model\Department;
use App\Model\Keyword;
use Illuminate\Http\Request;

class StorecharController extends Controller
{

    public function actionIndex()
    {
        $model = Keyword::all();
        return view("screen.storechar.index", ["model" => $model]);
    }


    public function actionCreate(Request $request)
    {
        if ($request->method() != "POST") {

            $selectItem = Department::all();

            return view("screen.storechar.create" , ["selectItem" => $selectItem]);
        } else {

            $model = new Keyword();
            $model->text = $request->text;
            $model->dep_id_all = json_encode($request->dep_all);

            if ($model->save()) {
                return $this->responseRedirectRoute("storechar_index_page", "เพิ่มคำอ่าน $model->text สำเร็จ !");
            } else {
                return $this->responseRedirectBack("ไม่สามารถสร้างข้อมูล ได้กรุณาลองใหม่อีกครั้ง !");
            }
        }
    }

    public function actionDelete($id){

        $model = Keyword::find($id);

        if($model->delete()){
            return $this->responseRedirectRoute("storechar_index_page", "ลบคำอ่าน $model->text สำเร็จ !");
        }else{
            return $this->responseRedirectBack("ไม่สามารถลบข้อมูล ได้กรุณาลองใหม่อีกครั้ง !");
        }
    }

    public function actionView($id)
    {
        $model = Keyword::find($id);
        $selectItem = Department::all();

        if($model){
            return view("screen.storechar.view", ["model" => $model , "selectItem" => $selectItem]);
        }else{
            return $this->responseRedirectRoute("storechar_index_page", "ไม่พบข้อมูลที่ค้นหา" , "warning");
        }
    }

    public function actionUpdate(Request $request)
    {
        $model = Keyword::find($request->id);

        if($model){

            if(!isset($request->dep_all)){
                return $this->responseRedirectBack("ไม่สามารถแก้ไขข้อมูล กรุณาเพื่มสาขาวิชาให้คำคำที่เลือก อย่างน้อย 1 คำ !" , "warning");
            }

            $model->text = $request->text;
            $model->dep_id_all = json_encode($request->dep_all);

            if($model->save()){

                return $this->responseRedirectRoute("storechar_index_page", "แก้ไขข้อมูลเรียบร้อยสำเร็จ !");

            }else{
                return $this->responseRedirectBack("ไม่สามารถแก้ไขข้อมูล ได้กรุณาลองใหม่อีกครั้ง !");
            }

        }else{
            return $this->responseRedirectRoute("storechar_index_page", "ไม่พบข้อมูลที่ค้นหา" , "warning");
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
        return response()->json(['bypass' => $bypass,  'status' => $status, 'data' => $data], 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header("Access-Control-Allow-Headers", "Authorization, Content-Type")
            ->header('Access-Control-Allow-Credentials', ' true');
    }
}
