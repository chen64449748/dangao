<li><a href="#"><i class="fa fa-list-alt"></i><span>管理员</span></a>
    <ul class="sub-menu">
        <li @if ($action == 'admin') class="active" @endif><a href="/admin" class="goods_nav">管理列表</a></li>
        <li @if ($action == 'admin/add') class="active" @endif><a href="/admin/add">添加管理员</a></li>
    </ul>
</li>
<li><a href="#"><i class="fa fa-list-alt"></i><span>订单列表</span></a>
    <ul class="sub-menu">
        <li @if ($action == 'admin/orders') class="active" @endif><a href="/admin/orders" class="goods_nav">订单列表</a></li>
    </ul>
</li>
<li><a href="#"><i class="fa fa-list-alt"></i><span>货品</span></a>
	<ul class="sub-menu">
		<li @if ($action == 'goods/list') class="active" @endif><a href="/goods/list" class="goods_nav">货品列表</a></li>
		<li @if ($action == 'goods/add') class="active" @endif><a href="/goods/add">添加货品</a></li>
	</ul>
</li>

<li><a href="#"><i class="fa fa-list-alt"></i><span>活动</span></a>
	<ul class="sub-menu">
		<li @if ($action == 'active/list') class="active" @endif><a href="/active/list" class="active_nav">活动列表</a></li>
		<li @if ($action == 'active/admin/detail') class="active" @endif><a href="/active/admin/detail">添加活动</a></li>
	</ul>
</li>

<li><a href="#"><i class="fa fa-list-alt"></i><span>属性设置</span></a>
	<ul class="sub-menu">
		<li @if ($action == 'config/list') class="active" @endif><a href="/config/list">所有属性</a></li>
	</ul>
</li>
