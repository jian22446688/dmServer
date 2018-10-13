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

use app\admin\model\RouteModel;
use cmf\controller\AdminBaseController;
use app\portal\model\PortalPostModel;
use app\portal\service\PostService;
use app\admin\model\ThemeModel;

class AdminPageController extends AdminBaseController
{

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
        return $this->fetch();
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
