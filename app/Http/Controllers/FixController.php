<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\studenonline;
use Intervention\Image\Facades\Image;
/**
 * Class HomeController
 * @package App\Http\Controllers
 * 实现费用的查询
 *
 */
class FixController extends Controller
{
    /**
     * Create a new controller instance.
     *路由中间件，请复制该构造方法
     * 实现用户认证
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

//   // $SearchOption    0 提交报修界面
    public function fix()
    {   $SearchOption=['SearchOption' => 0];
        return view("fix")->with($SearchOption);;
    }

    public function text(Request $request)
    {
//         echo $request['remarks'];
//         echo time();
//         echo date("Y-m-d H:i:s", time()) ; //当前时间的格式化
//        $xq = $request['xq'];
//        $xh = $request['xh'];
//        $name = $request['name'];
//        $phone = $request['phone'];
//        $lfh = $request['lfh'];
//        $mph = $request['room'];
//        $phone = $request['phone'];
//        $kind = $request['kind'];
        $f_avatars = '';//若没有图片则为空；
        if ($request->hasFile('avatar')) {
            //获取头像文件
            $avatar = $request->file('avatar');
            //生成文件名称   getClientOriginalExtension()得到图像的后缀名称
            $file_name = time() . '.' . $avatar->getClientOriginalExtension();
            //修改头像文件的尺寸   并进行本地存储    注意需要先  use Intervention\Image\Facades\Image;
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/p_avatars/' . $file_name));
            //在数据库中保存文件的存储地址      数据库中只保存地址，不存储图像数据
            $f_avatars = 'uploads/p_avatars/' . $file_name; //生成图片文件
            //echo  $f_avatars;

            //存储结束
        }


        $studenonline = new studenonline();
        $studenonline->addarecord_repair( $request['xh'], $request['name'], $request['phone'], $request['xq'], date("Y-m-d H:i:s", time()), $request['kind'], $request['lfh'], $request['room'], $request['remarks'], '待处理');
        $id = $studenonline->id_max();
        $studenonline->addarecord_avatars($id,$f_avatars);//存入报修照片
        echo '您的保修请求已经提交成功！请等待工作人员的处理';
    }




}
