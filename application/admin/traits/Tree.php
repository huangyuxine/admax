<?php
namespace app\admin\traits;

trait Tree
{
    private function buildMenuLevel($array, $pid = 0, $level = 1)
    {
        static $list = [];
        foreach ($array as $v) {
            if ($v['pid'] == $pid) {
                $v['level'] = $level;
                $list[]     = $v;
                $this->buildMenuLevel($array, $v['id'], $level + 1);
            }
        }
        return $list;
    }

    private function buildMenuTree(array $array)
    {
        foreach ($array as $key => $vo) {
            if ($vo['level'] > 1) {
                $repeatString = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                $markString   = str_repeat("{$repeatString}├{$repeatString}", $vo['level'] - 1);
                $array[$key]['title']  = $markString . $vo['title'];
            }
        }

        return $array;
    }
}