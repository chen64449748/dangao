<?php 



class Goods extends Eloquent
{
	protected $table = 'goods';

	public function stocks()
    {
        return $this->hasMany('Stock', 'goods_id', 'id');
    }

    public function prices()
    {
    	return $this->hasMany('Price', 'goods_id', 'id');
    }

    public function goodsSkus()
    {
    	return $this->hasMany('GoodsSku', 'goods_id', 'id');
    }

    public function content()
    {
    	return $this->hasOne('GoodsContent', 'goods_id', 'id');
    }

    public function category()
    {
    	return $this->belongsTo('Category', 'category_id', 'id');
    }

	function getList($type = array(), $fetch = array())
	{
		$select = $this->select($fetch ? $fetch : array('goods.*'));

		$this->_where($select, $type);

		return $select->get();
	}

	function getListPage($type = array(), $size = 15, $fetch = array())
	{
		$select = $this->select($fetch ? $fetch : array('goods.*'));

		$this->_where($select, $type);

		return $select->paginate($size);
	}

	function getGoods($type = array(), $order = array(), $offset = 0, $limit = 20)
	{
		$select = $this->select(array('goods.*'));

		$this->_where($select, $type);

		$this->_order($select, $order);
	
		$select->skip($offset)->take($limit);

		return $select->get();
	}

	function fetch($type = array(), $fetch = array())
	{
		$select = $this->select($fetch ? $fetch : array('goods.*', 'content'));

		$select->leftJoin('goods_content', 'goods_content.goods_id', '=', 'goods.id');

		$this->_where($select, $type);

		return $select->first();
	}

	// 获取推荐
	function getHot()
	{
		return $this->where('is_hot', 1)->get();
	}

	function add($goods_data)
	{
		$now_date = date('Y-m-d H:i:s');

		$result = array();

		foreach ($goods_data as $key => $goods) {
			$now_index = $key + 1;

			// 新增
			$goods_sku = $goods['goods_sku']; // 对应关联的sku
			$sku_price = $goods['sku_price']; // 里面有 价格 库存  价格库存对照属性
			$content = $goods['content']; //  详情
			unset($goods['goods_sku'], $goods['sku_price'], $goods['content']);
			$goods['created_at'] = $now_date;
	
			$goods_id = $this->insertGetId($goods);

			if (!$goods_id) {
				throw new Exception("系统错误 添加货品失败");
			}

			// 添加详情页
			GoodsContent::insert(array(
				'goods_id' => (int)$goods_id,
				'content' => $content,
			));

			// 添加goods sku关联  这张表用于读取 价格库存sku
			GoodsSku::add($goods_sku, $goods_id);

			foreach ($sku_price as $sku_pv) {
				
				if (!isset($sku_pv['stock'])) {
					throw new Exception('没填库存');
				}

				if (!isset($sku_pv['price'])) {
					throw new Exception('没填价格');
					//$sku_pv['price'] = '';
				}

				if (!is_numeric($sku_pv['stock'])) {
					throw new Exception('库存非数字');
				}

				// 插入价格 和 库存
				SkuPrice::add($sku_pv, $goods_id);

			}


			$result[] = $goods_id;

			return $result;

		}
	}

	// 修改商品
	public function goodsUpdate($goods_data, $goods_id)
	{


		$goods_sku = isset($goods_data['goods_sku']) ? $goods_data['goods_sku'] : array();
		$sku_price = isset($goods_data['sku_price']) ? $goods_data['sku_price'] : array();
		$content = $goods_data['content'];
		unset($goods_data['goods_sku'], $goods_data['content'], $goods_data['sku_price']);

		$this->where('id', $goods_id)->update($goods_data);
		GoodsContent::where('goods_id', $goods_id)->update(array('content'=> $content));

		if (!$goods_sku) {
			throw new Exception("至少勾选一个 价格库存关联");
		}

		if (!$sku_price) {
			throw new Exception("至少填写一个 库存");
		}


		// 添加goods sku关联  这张表用于读取 价格库存sku
		// 判断是否存在  如存在 修改为不显示 add函数里以判断
		GoodsSku::add($goods_sku, $goods_id);

		// sku_price
		$price_ids = Price::where('goods_id', $goods_id)->lists('id');

		foreach ($sku_price as $key => $sku_pv) {

			if (!is_numeric($sku_pv['price'])) {
				throw new Exception("价格必须是数字");
			}

			if (isset($sku_pv['price_id'])) {
				// 如果有price_id 则为修改
				$price_key = array_search($sku_pv['price_id'], $price_ids);
				if ($price_key === false) {
					throw new Exception("页面数据出错");
				}
				unset($price_ids[$price_key]);
				SkuPrice::add($sku_pv, $goods_id, $sku_pv['price_id']);
			} else {
				// 没有添加 里面包含添加 价格
				SkuPrice::add($sku_pv, $goods_id);
			}
			
		}

		// 将原有的价格设置 没填的 改为不显示
		if ($price_ids) {
			Price::whereIn('id', $price_ids)->update(array('is_show'=> 0));
			Stock::whereIn('price_id', $price_ids)->update(array('is_show'=> 0));
		}
			



	}


	private function _order(&$select, $order) {

		foreach ($order as $key => $value) {
			switch ($key) {
				case 'created_at':
					$select->orderBy('goods.created_at', $value);
					break;
				case 'sale_num':
					$select->orderBy('goods.sale_num', $value);
					break;
				case 'show_price':
					$select->orderBy('goods.show_price', $value);
					break;
			}
		}

	}

	private function _where(&$select, $type) {

		foreach ($type as $key => $value) {
			switch ($key) {
				case 'id':
					$select->where('goods.id', (int)$value);
					break;
				case 'goods_title':
					$select->where('goods.goods_title', 'like', '%'.(string)$value.'%');
					break;
				case 'category_id':
					$select->where('goods.category_id', (int)$value);
					break;
			}
		}

	}
}