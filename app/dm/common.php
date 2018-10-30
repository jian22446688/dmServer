<?php
/**
 * Created by PhpStorm.
 * User: cary
 * Date: 2018/10/7
 * Time: 上午8:10
 */

function d_dd($param){
    dump(json_decode(json_encode($param)));
}

/**
 * 递归实现无限极分类
 * @param $a
 * @param $pid
 * @return array
 */
function get_attr($a,$pid = 0){
    $tree = array();                                //每次都声明一个新数组用来放子元素
    foreach($a as $v){
        if($v['parent_id'] == $pid){                      //匹配子记录
            $v['children'] = get_attr($a,$v['id']); //递归获取子记录
            if($v['children'] == null){
                unset($v['children']);             //如果子元素为空则unset()进行删除，说明已经到该分支的最后一个元素了（可选）
            }
            $tree[] = $v;                           //将记录存入新数组
        }
    }
    return $tree;                                  //返回新数组
}