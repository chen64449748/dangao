<?php 


/**
* 
*/
class Active extends Eloquent
{
	protected $table = 'active';

    private $active = null;

	public function getList($type = array(), $order = array(), $offset = 0, $limit = 0) 
	{
		$select = $this->select(array('active.*'));

        $this->_where($select, $type);
        $this->_order($select, $order);

        if ($limit > 0) {
            $select->skip($offset)->take($limit);
        }

        return $select->get();

	}

    function getListPage($type = array(), $size = 15, $fetch = array())
    {
        $select = $this->select($fetch ? $fetch : array('active.*'));

        $this->_where($select, $type);

        return $select->paginate($size);
    }

    function getPrice($price)
    {
        $active = false;

        if (is_null($this->active)) {
            $actives = $this->getList(array('now'=> date('Y-m-d H:i:s')), array('created_at', 'desc'));
            if (count($actives)) {
                $this->active = $actives[0];
            } else {
                $this->active = array(); 
            }
        }


        if (!$this->active) {
            $r_price = $price;
        } else {

            // 有活动
            if ($this->active->type == 1) {
                $r_price = $this->active->discount * $price * 0.01;
            } elseif ($this->active->type == 2) {
                $r_price = $price - $this->active->money;
                if ($r_price < 0) {
                    $r_price = $price;
                }
            }

        }


        return number_format($r_price, 2);
    }   

    // 首页用
    function getFine()
    {
        $type = array('now'=> date('Y-m-d H:i:s'), 'is_fine'=> 1);
        $order = array('created_at', 'desc');
        
        $fines = $this->getList($type, $order);
        if (count($fines) == 0) {
            unset($type['is_fine']);
            $fines = $this->getList($type, $order, 0, 1);
        }

        return $fines;
    }

	private function _where(&$select, $type) {
        foreach ($type as $key => $value) {
            switch ($key) {
                case 'id':
                    $select->where('active.id', (int)$value);
                    break;
                case 'now':
                	$select->where('active.begin_time', '<=', $value)->where('active.end_time', '>=', $value);
                    break;
                case 'is_fine':
                    $select->where('active.is_fine', (int)$value);
                    break;
                case 'active_title':
                    $select->where('active.active_title', $value);
                    break;
                case 'begin_time':
                    $select->where('active.begin_time', '<=', $value);
                    break;
                case 'end_time':
                    $select->where('active.end_time', '>=', $value);
                    break;
                case 'type':
                    $select->where('active.type', (int)$value);
                    break;
              
            }
        }

    }

    private function _order(&$select, $order) {

        foreach ($order as $key => $value) {
            switch ($key) {
                case 'created_at':
                    $select->orderBy('active.created_at', $value);
                    break;
            }
        }

    }
}