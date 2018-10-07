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
