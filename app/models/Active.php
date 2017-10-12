<?php 


/**
* 
*/
class Active extends Eloquent
{
	protected $table = 'active';

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

    // 首页用
    function getFine()
    {
        $type = array('now'=> 1, 'is_fine'=> 1);
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
                	$now_date = date('Y-m-d H:i:s');
                	$select->where('active.begin_time', '<=', $now_date)->where('active.end_time', '>=', $now_date);
                    break;
                case 'is_fine':
                    $select->where('active.is_fine', (int)$value);
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