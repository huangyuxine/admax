<?php
namespace app\common\model;
use think\Model;

class Article extends Model
{
	public function category()
    {
        return $this->hasOne('Category','id','cid');
    }

    public static function getArticleList($limited = 0, $limit = 10, $keyword = '')
    {
        $where = [];
        if ($keyword) {
            $where[] = ['title|content|introduction', 'like', "%{$keyword}%"];
        }
    	$data = self::with(['category'])
                    ->order('id desc')
                    ->where($where)
                    ->limit("$limited, $limit")
                    ->select();

        $count = self::with(['category'])->where($where)->count();
        
        $data->visible(['category' => ['title']])->toArray();


    	return  [
                    'code'  => 0,
                    'msg'   => '',
                    'count' => $count,
                    'data'  => $data
                ];
    }
}