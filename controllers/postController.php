<?php
class postController extends Controller
{
    public function index(){
        $title = "Auther";
        $name = "Hưng";
        $fullname ="Tiết Nhật Hưng";
        $old = 23;
        $this->View("postDetail", compact('title','name','fullname','old'), "layouts/defaultLayout");
    }

}