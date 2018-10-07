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

use app\dm\model\DmUserModel;
use cmf\controller\AdminBaseController;
use think\Loader;


class AdminUserInfoController extends AdminBaseController
{
    /**
     * 用户信息列表
     * @adminMenu(
     *     'name'   => '用户信息',
     *     'parent' => 'dm/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户信息列表',
     *     'param'  => ''
     * )
     */
    public function index() {
        $userinfo = new DmUserModel();
        $pag = $userinfo->order('create_time', 'DESC')->paginate(20);
        $res = $userinfo->where('status', 0)->select();
        $this->assign('unreadcount', $res->count());
        $this->assign('userinfo', $pag);
        $this->assign('page', $pag->render());
        return $this->fetch();
    }

    /**
     * 未读用户信息
     * @adminMenu(
     *     'name'   => '未读信息',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '未读信息',
     *     'param'  => ''
     * )
     */
    public function unread() {

        $userinfo = new DmUserModel();
        $pag = $userinfo->where('status', 0)->order('create_time', 'DESC')->paginate(20);
        $res = $userinfo->where('status', 0)->select();
        $this->assign('unreadcount', $res->count());
        $this->assign('userinfo', $pag);
        $this->assign('page', $pag->render());
        return $this->fetch();
    }

    /**
     * 删除用户信息
     * @adminMenu(
     *     'name'   => '删除信息',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除信息',
     *     'param'  => ''
     * )
     */
    public function delete() {
        $id = $this->request->param('id');
        if ($id){
            $da = DmUserModel::destroy($id);
            if ($da) {
                $this->success('删除成功', url('AdminUserInfo/index')); die;
            }
        }
        $this->error('删除出错');
    }

    /**
     * 查看用户信息
     * @adminMenu(
     *     'name'   => '查看信息',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '查看信息',
     *     'param'  => ''
     * )
     */
    public function check() {
        $userinfo = new DmUserModel();
        $res = $userinfo->where('status', 0)->select();
        $this->assign('unreadcount', $res->count());
        $id = $this->request->param('id');
        $da = DmUserModel::get($id);
        $this->assign('info', $da);
        return $this->fetch();
    }


    /**
     * 取消未读用户信息
     * @adminMenu(
     *     'name'   => '取消未读信息',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '取消未读信息',
     *     'param'  => ''
     * )
     */
    public function cancelUnread() {
        if($this->request->isPost()){
            $res = DmUserModel::where('status', 0)->update(['status' => 1]);
            if($res != 0){
                $this->success('标记成功', url('AdminUserInfo/index')); die;
            }
        }
        $this->error('更新错误');
    }

    /**
     * 下载用户数据
     */
    public function downloadexcel() {
        if ($this->request->isPost()){
            // 保存的文件名;
            $excelname = $this->request->param('excelname');
            $excelname = $excelname ? $excelname: date('Y-m-d H:i:s');
            Loader::import('PHPExcel.PHPExcel');
            Loader::import('PHPExcel.PHPExcel.IOFactory.PHPExcel_IOFactory');
            Loader::import('PHPExcel.PHPExcel.Reader.Excel2007');
            $objPHPExcel = new \PHPExcel();
            //设置每列的标题
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ID')
                ->setCellValue('B1', '客户名称')
                ->setCellValue('C1', '公司')
                ->setCellValue('D1', '手机')
                ->setCellValue('E1', '地址')
                ->setCellValue('F1', '内容')
                ->setCellValue('G1', '创建时间');
            $data = DmUserModel::all();
            //存取数据  这边是关键
            foreach ($data as $k => $v) {
                $num = $k + 2;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $num, $v['id'])
                    ->setCellValue('B' . $num, $v['name'])
                    ->setCellValue('C' . $num, $v['company'])
                    ->setCellValue('D' . $num, $v['phone'])
                    ->setCellValue('E' . $num, $v['site'])
                    ->setCellValue('F' . $num, $v['description'])
                    ->setCellValue('G' . $num, $v['create_time']);
            }
            //设置工作表标题
            $objPHPExcel->getActiveSheet()->setTitle('我的客户信息文档');

            //设置列的宽度
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

            $objPHPExcel->setActiveSheetIndex(0);
            $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename=" . $excelname . '.xlsx');//设置文件标题
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            return ;
        }
        return ;
    }

    /**
     * 用户提交数据
     */
    public function usersubmit() {

        $data = [];
        $data['name'] = 'dddd';
        $data['company'] = 'ddd';
        $data['phone'] = 'ddd';
        $data['site'] = 'ssss';
        $data['description'] = 'description';

        $da = DmUserModel::create($data);

//        if ($da){
//            $this->success('提交信息成功');
//        }else{
//            $this->error('提交错误');
//        }



        return ;
    }


}
