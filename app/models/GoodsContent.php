<?php 

class GoodsContent extends Eloquent
{
	protected $table = 'goods_content';

	public function goods()
	{
		return $this->belongsTo('Goods', 'goods_id', 'id');
	}

}