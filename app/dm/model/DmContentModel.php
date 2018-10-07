<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:kane < chengjin005@163.com>
// +----------------------------------------------------------------------
namespace app\dm\model;

use think\Model;
use traits\model\SoftDelete;

class DmContentModel extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    // 时间字段取出后的默认时间格式
    protected $dateFormat = 'Y-m-d';

    use SoftDelete;
    protected $deleteTime = 'delete_time';

    /**
     * 关联 分类表
     * @return \think\model\relation\BelongsToMany
     */
    public function categories() {

        return $this->belongsToMany('DmCategoryModel', 'dm_category', 'category_id', 'id');
    }

    /**
     * 关联 分类表 获取分类名称
     */
    public function categorname() {
        return $this->belongsTo('DmCategoryModel', 'category_id', 'id');
    }


    /**
     * post_content 自动转化
     * @param $value
     * @return string
     */
    public function getDescriptionAttr($value)
    {
        return cmf_replace_content_file_url(htmlspecialchars_decode($value));
    }

    /**
     * post_content 自动转化
     * @param $value
     * @return string
     */
    public function setDescriptionAttr($value)
    {
        return htmlspecialchars(cmf_replace_content_file_url(htmlspecialchars_decode($value), true));
    }

}