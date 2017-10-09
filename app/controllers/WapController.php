<?php

class WapController extends BaseController
{
	function __construct()
	{
		Session::put('user_id', 1);
	}
}