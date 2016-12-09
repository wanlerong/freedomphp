<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/12/3
 * Time: 上午9:56
 */

namespace App\Model;
use FreedomPHP\Core\Model;

class CommonModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 添加数据
     *
     * @param $data
     * @return int
     */
    public function addInfo($data){
        if(empty($data) || !is_array($data)){
            return false;
        }

        $this->builder->reset();

        return $this->builder->insertGetId($data);
    }
    /**
     * 查询全部数据
     *
     * @param $num
     * @param array $where
     * @param array $order
     * @return array|static[]
     */
    public function getAll($where = array(), $order = array(), $num = null){
        $this->builder->reset();

        $this->builder->select('*');

        if($where){
            $this->formatSqlWhere($where);
        }

        foreach((array)$order as $k => $v){
            $this->builder->orderBy($k, $v);
        }

        if($num){
            $this->builder->limit($num);
        }

        $data = $this->builder->get();

        return $data;
    }

    /**
     * 分页数据
     *
     * @param int $page
     * @param int $page_list
     * @param array $where
     * @param array $order
     * @return array|static[]
     */
    public function getPage($page = 1, $page_list = 10, $where = array(), $order = array()){
        $this->builder->reset();

        $this->builder->select('*');

        if($where){
            $this->formatSqlWhere($where);
        }

        foreach((array)$order as $k => $v){
            $this->builder->orderBy($k, $v);
        }

        $data = $this->builder->pageInfo($page, $page_list);

        return $data;
    }

    /**
     * 查询总和
     *
     * @param array $where
     * @param string $field
     * @return array|static[]
     */
    public function getSum($field,$where = array()){
        $this->builder->reset();

        if($where){
            $this->formatSqlWhere($where);
        }

        $data = $this->builder->sum($field);

        return $data;
    }

    /**
     * 检测插入
     *
     * @param array $data
     * @param array $where
     * @param bool $is_update
     * @return bool|int
     */
    public function checkAddInfo($data = array(), $where = array(), $is_update = false){
        if(empty($data)){
            return false;
        }

        $search_where = $where;

        if(empty($search_where)){
            $search_where = $data;
        }

        $check = $this->getInfo($search_where);

        if(empty($check)){
            $all_data = array_merge($data, $where);

            $ret = $this->addInfo($all_data);

            return $ret ? $ret : false;
        }else{
            if($is_update){
                $is_edit = false;
                $all_data = array_merge($data, $where);

                foreach((array)$all_data as $k => $v){
                    if($v != $check[$k]){
                        $is_edit = true;
                    }
                }

                if($is_edit){
                    $ret = $this->updateInfo($data, $where);

                    return $ret ? true : false;
                }
            }

            return true;
        }
    }

    /**
     * 批量添加数据
     *
     * @param $data
     * @return bool|int
     */
    public function batchAddInfo($data){
        if(empty($data) || !is_array($data)){
            return false;
        }

        $this->builder->reset();

        return $this->builder->insert($data);
    }

    /**
     * 查询数据
     *
     * @param $where
     * @param array $order
     * @return \___PHPSTORM_HELPERS\static|array|bool
     */
    public function getInfo($where, $order = array()){
        if(empty($where) || !is_array($where)){
            return false;
        }

        $this->builder->reset();

        $this->formatSqlWhere($where);

        foreach((array)$order as $k => $v){
            $this->builder->orderBy($k, $v);
        }

        $dataInfo = $this->builder->first();

        return $dataInfo;
    }

    /**
     * 修改数据
     *
     * @param $data
     * @param $where
     * @return array|bool|int|mixed|\PDOStatement|string
     */
    public function updateInfo($data, $where){
        if(empty($where) || !is_array($where) || empty($data) || !is_array($data)){
            return false;
        }

        $this->builder->reset();

        $this->formatSqlWhere($where);

        return $this->builder->update($data);
    }

    /**
     * 删除数据
     *
     * @param $where
     * @return array|bool|int|mixed|\PDOStatement|string
     */
    public function deleteInfo($where){
        if(empty($where) || !is_array($where)){
            return false;
        }

        $this->builder->reset();

        $this->formatSqlWhere($where);

        return $this->builder->delete();
    }

    /**
     * 计数
     *
     * @param array $where
     * @return int
     */
    public function count($where = array())
    {
        $this->builder->reset();
        if($where){
            $this->formatSqlWhere($where);
        }
        return $this->builder->count();
    }

    /**
     * 格式化 where 条件
     *              array('sex'=>'1', 'title' => array('like', 'xyzs'))
     *
     * @param array $where
     */
    private function formatSqlWhere($where = array()){

        foreach((array)$where as $k => $v){

            if(strpos($k, 'group_where') !== false){//组合查询条件
                $this->builder->where($v);
            }else{
                if(is_array($v)){
                    $option = strtolower($v[0]);

                    $value  = $v[1];

                    if($option == 'like'){
                        $this->builder->where($k, $option, '%'.$value.'%');
                    }elseif ($option == 'in'){
                        $this->builder->whereIn($k, $value);
                    }elseif ($option == 'not_in'){
                        $this->builder->whereIn($k, $value, 'and', true);
                    }elseif($option == 'between'){
                        $this->builder->whereBetween($k, $value);
                    }elseif($option == 'or_between'){
                        $this->builder->orWhereBetween($k, $value);
                    }elseif($option == 'or_where'){
                        $this->builder->orWhere($k, $value);
                    }else{
                        $this->builder->where($k, $option, $value);
                    }
                }else{
                    $this->builder->where($k, '=', $v);
                }
            }
        }
    }

}