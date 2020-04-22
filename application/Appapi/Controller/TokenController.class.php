<?php
/**
 * 个人主页
 */
namespace Appapi\Controller;
use Common\Controller\HomebaseController;

class TokenController extends HomebaseController {

    private $TokenKey = "28ksasdasdasdasiuiouqwmbsm2Xa";
    private $jwt;

    public function __construct()
    {
        include 'simplewind/Lib/Util/Jwt/src/JWT.php';
        $this->jwt= new \JWT();
    }

    /**
     * @param  $user
     * @return string
     */
    function getToken($user)
    {
        if(empty($user)){
            return false;
        }

        $data['user_id'] = $user['id'];
        $data['nickname'] = $user['user_nicename'];
        $data['user_email'] = $user['user_email'];
        $data['username'] = $user['user_login'];
        $nowtime = time();
        $token = [
            'iat' => $nowtime, //签发时间
            'nbf' => $nowtime, //生效时间（马上生效）
            'exp' => $nowtime + 3600, // 过期时间1小时
            'data' => $data
        ];

        $token = $this->jwt->encode($token, $this->TokenKey);    // 通过JWT获取token
        return $token;

    }

    function checkToken($token)
    {
        try {
            $decoded = $this->jwt->decode($token, $this->TokenKey, array('HS256'));
            $data = json_decode(json_encode($decoded), true);        // 解密数据
            return $data['data']; //返回信息
        }catch (\Exception $e){
            return [];
        }



    }




}