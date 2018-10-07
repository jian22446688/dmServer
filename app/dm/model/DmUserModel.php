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
namespace app\dm\model;

use think\Model;
use traits\model\SoftDelete;

class DmUserModel extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    // 时间字段取出后的默认时间格式
    protected $dateFormat = 'Y-m-d';

    use SoftDelete;
    protected $deleteTime = 'delete_time';



}