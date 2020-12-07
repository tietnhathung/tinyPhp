<?php
class postController extends Controller
{
    public function index($req , $res , $par ){
        $title = "Auther";
        $name = "Hưng";
        $fullname ="Tiết Nhật Hưng";
        $old = 23;

        return $res->View("postDetail", compact('title','name','fullname','old'), "layouts/defaultLayout");
    }

    public function show( $req , $res , $par ){

        $title = "Auther";
        $name = "Hưng";
        $fullname ="Tiết Nhật Hưng $par[0]";
        $old = 23;

        return $res->View("postDetail", compact('title','name','fullname','old'), "layouts/defaultLayout");
    }

    public function showDetail( $req , $res , $par ){
        var_dump($par);
    }
}