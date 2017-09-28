<li><a href="#"><i class="fa fa-list-alt"></i><span>货品</span></a>
	<ul class="sub-menu">
		<li @if ($action == 'goods/list') class="active" @endif><a href="/goods/list" class="goods_nav">货品列表</a></li>
		<li @if ($action == 'goods/add') class="active" @endif><a href="/goods/add">添加货品</a></li>
	</ul>
</li>

<li><a href="#"><i class="fa fa-list-alt"></i><span>属性设置</span></a>
	<ul class="sub-menu">
		<li @if ($action == 'config/list') class="active" @endif><a href="/config/list">所有属性</a></li>
	</ul>
</li>
