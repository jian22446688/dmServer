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

use cmf\controller\HomeBaseController;

class IndexController extends HomeBaseController
{
    public function index(){
        if (cmf_is_mobile()){
            // 手机访问
            return $this->fetch('mobile/index');
        }
        return $this->fetch(':index');
    }

    /**
     * 弹出层提交用户信息
     */
    public function layerSubmit(){

//        return $this->fetch(':dmvideo/layer-submit/index.html');
        return $this->fetch('layer-submit/index');
    }

    public function test(){

        return 'cary';
    }

}
