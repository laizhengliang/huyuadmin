<?php

class Domain_Login {

    public function userLogin($user_login,$user_pass) {
        $rs = array();

        $model = new Model_Login();
        $rs = $model->userLogin($user_login,$user_pass);

        return $rs;
    }

    public function userReg($user_login,$user_pass,$source) {
        $rs = array();
        $model = new Model_Login();
        $rs = $model->userReg($user_login,$user_pass,$source);

        return $rs;
    }	
	
    public function userFindPass($user_login,$user_pass) {
        $rs = array();
        $model = new Model_Login();
        $rs = $model->userFindPass($user_login,$user_pass);

        return $rs;
    }	

    public function userLoginByThird($openid,$type,$nickname,$avatar,$source) {
        $rs = array();

        $model = new Model_Login();
        $rs = $model->userLoginByThird($openid,$type,$nickname,$avatar,$source);

        return $rs;
    }

    public function upUserPush($uid,$pushid) {
        $rs = array();

        $model = new Model_Login();
        $rs = $model->upUserPush($uid,$pushid);

        return $rs;
    }			

}
