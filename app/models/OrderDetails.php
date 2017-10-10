<?php 

/**
* 
*/
class OrderDetails extends Eloquent
{
	protected $table = 'orders_detail';

	public function goods()
	{
		return $this->belongsTo('Goods', 'goods_id', 'id');
	}

	public function p()
	{
		return $this->belongsTo('Price', 'price_id', 'id');
	}

	function getList($type = array(), $fetch = array())
    {
        $select = $this->select($fetch ? $fetch : array('orders_detail.*'));

        $this->_where($select, $type);

        return $select->get();

    }

	private function _where(&$select, $type) {

        foreach ($type as $key => $value) {
            switch ($key) {
                case 'id':
                    $select->where('orders_detail.id', (int)$value);
                    break;
                case 'order_id':
                    $select->where('orders_detail.order_id', (int)$value);
                    break;
              
            }
        }

    }
}