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

use app\dm\model\DmSolutionModel;
use cmf\controller\AdminBaseController;


class AdminPageController extends AdminBaseController {

    /**
     * 视频网站页面管理
     * @adminMenu(
     *     'name'   => '页面管理',
     *     'parent' => 'dm/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '页面管理',
     *     'param'  => ''
     * )
     */
    public function index() {
        $info_file = include(CMF_ROOT . '/app/dm/config.php');
        $info_file = $info_file ? $info_file : array();


        $this->assign('conf', $info_file);
        $this->assign('solution', $info_file['dm_solution']);

        return $this->fetch();
    }


    /**
     * 配置首页 logo
     * @adminMenu(
     *     'name'   => '配置首页 logo',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '配置首页 logo',
     *     'param'  => ''
     * )
     */
    public function confLogo() {
        $confPath = CMF_ROOT . '/app/dm/config.php';
        $info_file = include(CMF_ROOT . '/app/dm/config.base.php');
        $info_file = $info_file ? $info_file : array();
        if ($this->request->isPost()){
            $data = $this->request->param()['post'];
            if ($data['file_logo'] != '' && $data['file_one_bg'] != ''
                && $data['file_two_bg'] != '' && $data['file_service_bg'] != '') {
                $info_file['dm_home_logo']      = $data['file_logo'];
                $info_file['dm_home_nav_1']     = $data['file_one_bg'];
                $info_file['dm_home_nav_2']     = $data['file_two_bg'];
                $info_file['dm_home_service']   = $data['file_service_bg'];
                $info_file['dm_solution']       = $data['dm_solution'];
                $info_file['dm_caseshow']       = $data['dm_caseshow'];
                $info_file['dm_productshow']    = $data['dm_productshow'];
                $info_file['dm_service']        = $data['dm_service'];
                if(file_exists($confPath)){
                    // 写入文件，这里是关键
                    $result = file_put_contents($confPath, "<?php\nreturn " . var_export($info_file, true).';');
                    if($result){
                        $this -> success('保存成功');
                    }else{
                        $this -> error('保存失败');
                    }
                } else {
                    $this -> error('配置文件不存在！');
                }
            }else{
                $this->error('请上传图片');
            }
            $this->success('保存成功');
            die;
        }
    }

    /**
     * 配置首页 解决方案
     * @adminMenu(
     *     'name'   => '配置首页 解决方案',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '配置首页 解决方案',
     *     'param'  => ''
     * )
     */
    public function confSolution() {
        $soluMode = DmSolutionModel::paginate(20);;
//        d_dd($soluMode);





        $this->assign('solulist', $soluMode);
        $this->assign('page', $soluMode->render());
        return $this->fetch();
    }

    /**
     * 解决方案 删除内容列表
     */
    public function solutionDel() {
        $id = $this->request->param('id');
        $de = DmSolutionModel::destroy($id);
        if ($de){
            $this->success('删除成功!');
        }else{
            $this->error('删除失败');
        }
    }

    /**
     * 解决方案 编辑内容列表
     */
    public function solutionEdit() {
        if ($this->request->isPost()){
            $data = $this->request->param()['post'];
            $up = DmSolutionModel::update($data);
            if ($up){
                $this->success('更新成功!', url('confSolution'));
            }else{
                $this->error('更新失败');
            }
        }else{
            $id = $this->request->param('id');
            if ($id >= 0) {
                $sulos = DmSolutionModel::get($id);
                $this->assign('sulo', $sulos);
                $this->assign('sulos', DmSolutionModel::all());
                return $this->fetch();
            }
        }
    }

    /**
     * 解决方案 添加内容列表
     */
    public function solutionAdd() {
        if ($this->request->isPost()){
            $data = $this->request->param()['post'];
            $up = DmSolutionModel::create($data);
            if ($up){
                $this->success('添加成功!', url('confSolution'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->assign('sulos', DmSolutionModel::all());
            return $this->fetch();
        }
    }

    public function test() {
        $data = DmSolutionModel::all();
        $tree = $data;
        $tree = get_attr($data, 0);
        d_dd($tree);

        return ;
    }



    /**
     * 添加页面
     * @adminMenu(
     *     'name'   => '添加页面',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加页面',
     *     'param'  => ''
     * )
     */
    public function add() {

    }

    /**
     * 添加页面提交
     * @adminMenu(
     *     'name'   => '添加页面提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加页面提交',
     *     'param'  => ''
     * )
     */
    public function addPost() {


    }

    /**
     * 编辑页面
     * @adminMenu(
     *     'name'   => '编辑页面',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑页面',
     *     'param'  => ''
     * )
     */
    public function edit() {

    }

    /**
     * 编辑页面提交
     * @adminMenu(
     *     'name'   => '编辑页面提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑页面提交',
     *     'param'  => ''
     * )
     */
    public function editPost() {
        $confPath = CMF_ROOT . '/app/front/config.php';
        $info_file = include(CMF_ROOT . '/app/front/config.php');
        $info_file = $info_file ? $info_file : array();
        $web_name = 'frontweb_about';
        if($this->request->isPost()){
            $data = $this->request->param()['post'];
            $b = ['title'    => $data['title'],
                'content1'  => htmlspecialchars_decode($data['content1']),
                'content2'  => htmlspecialchars_decode($data['content2']),
                'content3'  => htmlspecialchars_decode($data['content3']),
                'content4'  => htmlspecialchars_decode($data['content4']),
                'img1' => $data['img1'],
                'img2' => $data['img2'],
                'img3' => $data['img3'],
                'img4' => $data['img4'],
                'img5' => $data['img5'],
                'img6' => $data['img6'],
            ];
            $info_file[$web_name] = $b;
            if(file_exists($confPath)){
                // 写入文件，这里是关键
                $result = file_put_contents($confPath, "<?php\nreturn " . var_export($info_file, true).';');
                if($result){
                    $this -> success('保存成功');
                }else{
                    $this -> error('保存失败');
                }
            }else{
                $this -> error('配置文件不存在！');
            }
        }
        $webdata = $info_file[$web_name];

//        dump($webdata); die;

        $this->assign('webdata', $webdata);
        return $this->fetch('base_about');

    }

    /**
     * 删除页面
     * @author    iyting@foxmail.com
     * @adminMenu(
     *     'name'   => '删除页面',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除页面',
     *     'param'  => ''
     * )
     */
    public function delete() {


    }

}
