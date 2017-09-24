<?php

namespace App\Http\Controllers;

use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use Session;

class CaptchaController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function captcha($tmp = '')
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::flash('milkcaptcha', $phrase);
        //生成图片
        ob_end_clean();
//        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    /**
     * 获取验证码
     */
    public function getcaptcha()
    {
        echo Session::get('milkcaptcha');
    }
}
