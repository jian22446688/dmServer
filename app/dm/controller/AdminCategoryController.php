<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\dm\controller;

use cmf\controller\AdminBaseController;
use app\dm\model\DmCategoryModel;


class AdminCategoryController extends AdminBaseController {
    /**
     * 视频分类列表
     * @adminMenu(
     *     'name'   => '内容分类管理',
     *     'parent' => 'dm/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '视频分类列表',
     *     'param'  => ''
     * )
     */
    public function index() {
        if($this->request->isPost()){
            $keyw = $this->request->param()['keyword'];
            if($keyw == ''){
                $catagorys = DmCategoryModel::select();
                $this->assign('catagorys', $catagorys);
                return $this->fetch();
            }
        }
        $catagorys = DmCategoryModel::select();
        $this->assign('catagorys', $catagorys);
        return $this->fetch();
    }

    /**
     * 添加内容分类
     * @adminMenu(
     *     'name'   => '添加内容分类',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加内容分类',
     *     'param'  => ''
     * )
     */
    public function add() {

        return $this->fetch();
    }

    /**
     * 添加内容分类提交
     * @adminMenu(
     *     'name'   => '添加内容分类提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加内容分类提交',
     *     'param'  => ''
     * )
     */
    public function addPost() {

        if ($this->request->isPost()) {
            $data = $this->request->param()['post'];
            $data['parent_id'] = 0;
            $cata = DmCategoryModel::create($data);
            if ($cata) {
                $this->success('添加成功!', url('AdminCategory/index'));
            }else{
                $this->error('添加失败!');
            }
        }else{
            $this->error('添加失败!');
        }
    }

    /**
     * 编辑内容分类
     * @adminMenu(
     *     'name'   => '编辑内容分类',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑文章分类',
     *     'param'  => ''
     * )
     */
    public function edit() {
        $id = $this->request->param('id', 0, 'intval');
        if ($id) {
            $catagory = DmCategoryModel::get($id);
            if($catagory){
                d_dd($catagory);
                $this->assign('category',$catagory);
                return $this->fetch();
            }else{
                $this->error('操作错误!');
            }
        } else {
            $this->error('操作错误!');
        }
    }

    /**
     * 编辑内容分类提交
     * @adminMenu(
     *     'name'   => '编辑内容分类提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑文章分类提交',
     *     'param'  => ''
     * )
     */
    public function editPost() {
        $data = $this->request->param()['post'];
        if($data['name'] == ''){
            $this->error('分类名称不能为空!');
        }
        $upcata = DmCategoryModel::update($data);
        if ($upcata) {
            $this->success('保存成功!', url('Index'));
        }
        $this->error('保存错误');
    }

    /**
     * 删除内容分类
     * @adminMenu(
     *     'name'   => '删除内容分类',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除文章分类',
     *     'param'  => ''
     * )
     */
    public function delete() {
        $id  = $this->request->param('id');
        $de = DmCategoryModel::destroy($id);
        if ($de){
            $this->success('删除成功!');
        }else{
            $this->error('删除失败');
        }
    }






}
