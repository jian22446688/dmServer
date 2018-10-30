<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\dm\controller;

use app\dm\model\DmContentModel;
use app\dm\model\DmSolutionModel;
use app\dm\model\DmUserModel;
use cmf\controller\HomeBaseController;
use think\Request;
use think\Route;

class IndexController extends HomeBaseController {
    public function index(){
        $data = DmSolutionModel::all();
        $contents = DmContentModel::where('status', 1)->select();
        $soluTree = get_attr($data, 0);

        $info_file = include(CMF_ROOT . '/app/dm/config.php');
        $info_file = $info_file ? $info_file : array();

        $this->assign('solutree', $soluTree);
        $this->assign('info_file', $info_file);
        $this->assign('contents', $contents);


        if (cmf_is_mobile()){
            // 手机访问
            return $this->fetch('mobile/index');
        }
        return $this->fetch(':index');
//        return $this->fetch(':test');
    }

    /**
     * 弹出层提交用户信息
     */
    public function layerSubmit(){

//        return $this->fetch(':dmvideo/layer-submit/index.html');
        return $this->fetch('layer-submit/index');
    }

    public function test(){
        $info_file = include(CMF_ROOT . '/app/dm/config.base.php');
        $info_file = $info_file ? $info_file : array();



        return json($info_file);
    }


    public function play() {
        $id = $this->request->param('id');
        $dmode = DmContentModel::get($id);
        $this->assign('videoitem', $dmode);
        return $this->fetch('layer-submit/play-page');
    }

    /**
     * 用户提交数据
     */
    public function userSubmit(){
        $reust = $this->request->param();
        $mag = ['status'=> 0, 'mag'=> '信息发送成功', 'data'=> null];
        if ( $reust['reg_name'] == '' || $reust['reg_phone'] == ''){
            $mag['status'] = 1;
            $mag['mag'] = '名称电话不能为空！请填写...';
            return json($mag);
        }
        $data = [];
        $data['name'] = $reust['reg_name'];
        $data['company'] = $reust['reg_company'];
        $data['phone'] = $reust['reg_phone'];
        $data['site'] = $reust['reg_site'];
        $data['description'] = isset($reust['description']) ? $reust['description']: '';
        $da = DmUserModel::create($data);
        if(!$da){
            $mag['status'] = 1;
            $mag['mag'] = '信息发送失败';
            return json($mag);
        }
        $mag['data'] = $da;
        return json($mag);
    }
}
