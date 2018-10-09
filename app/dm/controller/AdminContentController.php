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

use app\dm\model\DmCategoryModel;
use app\dm\model\DmContentModel;
use cmf\controller\AdminBaseController;
use think\Db;
use app\admin\model\ThemeModel;

class AdminContentController extends AdminBaseController
{
    /**
     * 内容列表
     * @adminMenu(
     *     'name'   => '内容管理',
     *     'parent' => 'dm/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '内容列表',
     *     'param'  => ''
     * )
     */
    public function index() {
        $catena = DmContentModel::with('categorname')->paginate(20);
        $this->assign('page', $catena->render());
        $this->assign('datalist', $catena);
        return $this->fetch();
    }

    /**
     * 添加内容
     * @adminMenu(
     *     'name'   => '添加内容',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加文章',
     *     'param'  => ''
     * )
     */
    public function add() {
        $category = DmCategoryModel::where('status', 1)->select();
        $this->assign('catagory', $category);
        return $this->fetch();
    }

    /**
     * 添加内容提交
     * @adminMenu(
     *     'name'   => '添加内容提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加文章提交',
     *     'param'  => ''
     * )
     */
    public function addPost() {
        if ($this->request->isPost()) {
            $data = $this->request->param()['post'];
            $data['author'] = cmf_get_current_admin_id();
            if($data['type'] == '2'){
                if($data['videopath'] == '' || $data['file'] == ''){
                    $this->error('在视频文件或者图片文件必须选择');
                }
            }elseif ($data['type'] == '1') {
                if(!$data['file']){
                    $this->error('图片文件必须选择');
                }
            }
            $content = DmContentModel::create($data);
            if($content){
                $this->success('添加成功!', url('Index'));
            }else {
                $this->error('添加失败');
            }
        }else{
            $this->error('添加失败');
        }
    }

    /**
     * 编辑内容
     * @adminMenu(
     *     'name'   => '编辑内容',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑文章',
     *     'param'  => ''
     * )
     */
    public function edit() {
        $param = $this->request->param();
        if(!isset($param['id'])){
            $this->error('无效的id');
        }
        $cont = DmContentModel::get($param['id']);
        $category = DmCategoryModel::where('status', 1)->select();
        $this->assign('catagory', $category);
        $this->assign('content', $cont);
        return $this->fetch();
    }

    /**
     * 编辑内容提交
     * @adminMenu(
     *     'name'   => '编辑内容提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑文章提交',
     *     'param'  => ''
     * )
     */
    public function editPost() {
        if ($this->request->isPost()) {
            $data = $this->request->param()['post'];
            $data['author'] = cmf_get_current_admin_id();
            if($data['type'] == '2'){
                if($data['videopath'] == '' || $data['file'] == ''){
                    $this->error('在视频文件或者图片文件必须选择');
                }
            }elseif ($data['type'] == '1') {
                if(!$data['file']){
                    $this->error('图片文件必须选择');
                }
            }
            $content = DmContentModel::update($data);
            if($content){
                $this->success('保存成功!', url('Index'));
            }else {
                $this->error('保存失败');
            }
        }else{
            $this->error('保存失败');
        }
    }

    /**
     * 内容删除
     * @adminMenu(
     *     'name'   => '内容删除',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '文章删除',
     *     'param'  => ''
     * )
     */
    public function delete() {
        $param  = $this->request->param();
        if (isset($param['id'])) {
            $id  = $param['id'];
            $del =  DmContentModel::destroy($id);
            if ($del){
                $this->success("删除成功！", 'Index');
            }else{
                $this->error("删除失败！ 无效的id");
            }
        }else{
            $this->error("删除失败! 请填写内容id");
        }
    }


}


    // server
    // {
    //     listen 80;
    //     server_name dm.pyge.top;
    //     index index.php index.html index.htm default.php default.htm default.html;
    //     root /www/wwwroot/dm.pyge.top/public;
    //
    //     #SSL-START SSL相关配置，请勿删除或修改下一行带注释的404规则
    //     #error_page 404/404.html;
    //     #SSL-END
    //
    //     #ERROR-PAGE-START  错误页配置，可以注释、删除或修改
    //     error_page 404 /404.html;
    //     error_page 502 /502.html;
    //     #ERROR-PAGE-END
    //
    //     #PHP-INFO-START  PHP引用配置，可以注释或修改
    //     include enable-php-56.conf;
    //     #PHP-INFO-END
    //
    //     #REWRITE-START URL重写规则引用,修改后将导致面板设置的伪静态规则失效
    //     include /www/server/panel/vhost/rewrite/dm.pyge.top.conf;
    //     #REWRITE-END
    //
    //     #禁止访问的文件或目录
    //     location ~ ^/(\.user.ini|\.htaccess|\.git|\.svn|\.project|LICENSE|README.md)
    //     {
    //         return 404;
    //     }
    //
    //     location / {
    //         if (!-e $request_filename) {
    //     rewrite ^/(.*) /index.php?s=/$1 last;
    //         #rewrite ^(.*) index.php?s=$1 last;
    // }
    // }
    //     error_page  404                 /404.html;
    //     error_page  500 502 503 504  /50x.html;
    //     location = /50x.html {
    //     root   /usr/share/nginx/html;
    // }
    //
    // #一键申请SSL证书验证目录相关设置
    // location ~ \.well-known{
    //     allow all;
    // }
    //
    // location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
    // {
    //     expires      30d;
    //     error_log off;
    //     access_log off;
    // }
    //
    // location ~ .*\.(js|css)?$
    //     {
    //         expires      12h;
    // error_log off;
    // access_log off;
    // }
    // access_log  /www/wwwlogs/dm.pyge.top.log;
    // error_log  /www/wwwlogs/dm.pyge.top.error.log;
    // }









