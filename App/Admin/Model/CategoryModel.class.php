<?php
/**
 * Created by PhpStorm.
 * User: mangolau
 * Date: 2/9/16
 * Time: 11:55 PM
 */
namespace Admin\Model;
use Think\Model;

class CategoryModel extends Model{
    /**
     * @var array
     * 自动验证
     */
    protected $_validate = array(
        array('name','require','标题必须！', self::MUST_VALIDATE),
        array('name','1,64','类型名长度不能超过64位',self::MUST_VALIDATE,'length',self::MODEL_BOTH),
        array('remark','0,64','备注长度不能超过64位',self::MUST_VALIDATE,'length',self::MODEL_BOTH),
        array('pid','checkPid','父级类型不能是自己和自己的子类',self::MUST_VALIDATE,'callback',self::MODEL_UPDATE),
    );

    /**
     * @var array
     * 自动完成
     */
    protected $_auto = array (
        array('created','datetime',self::MODEL_INSERT,'callback'),
        array('modified','datetime',self::MODEL_UPDATE,'callback'),
    );

    /**
     * @return bool|string
     * 当前时间
     */
    protected function datetime(){
        return date('Y-m-d H:i:s');
    }

    /**
     * @param $id
     * @return mixed
     * 删除$id的类型，并删除这个类型下的所有子类
     */
    public function delCategorys($id) {
        if ( ! is_numeric($id)) return false;
        $idArrs = $this->seleteChilds($id);
        if ($idArrs) {
            $idStr = implode(',', $idArrs);
            $idStr .= ','.$id;
        } else {
            $idStr = $id;
        }
        return $this->delete($idStr);
    }

    /**
     * @param $pid
     * @return array|mixed
     * 查找id下的所有子类id
     */
    protected function seleteChilds($pid) {
        global $idArrs;
        if (is_array($pid)) {
            foreach($pid as $v) {
                $where['pid'] = $v;
                $ids = $this->where($where)->getField('id', true);
                if ($ids) $idArrs[] = $ids;
                self::seleteChilds($ids);
            }
        } elseif (is_numeric($pid)){
            $where['pid'] = $pid;
            $ids = $this->where($where)->getField('id', true);
            if ($ids) $idArrs[] = $ids;
            self::seleteChilds($ids);
        } else {
            return false;
        }

        $temp = array();
        foreach($idArrs as $k => $v) {
            if (is_array($v)) {
                $temp = array_merge($temp, $v);
            } elseif (is_numeric($v)) {
                $temp[] = $v;
            }
        }
        return array_unique($temp);
    }

    /**
     * 检查修改的pid是否是自己或者自己的子类
     * @param $pid
     * @return bool
     */
    protected function checkPid($pid) {
        $ids = self::seleteChilds((int)$_POST['id']);
        $ids[] = (int)$_POST['id'];
        return in_array($pid, $ids) ? false : true;
    }

    public function getCates() {
        $cates = $this->select();
        return indent_merge($cates);
    }

    public function listCates($cid=0) {
        $cates = $this->getCates();
        $str = '<select name="cid">';
        foreach($cates as $v) {
            if ($v['id'] == $cid) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $str .= '<option value="'.$v['id'].'" '.$selected.'>'.$v['pad'].$v['name'].'</option>';
        }
        $str .= '</select>';
        return $str;
    }
}

?>