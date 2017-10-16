<?php 

/**
* 
*/
class RedPacketTask extends Eloquent
{
	protected $table = 'red_packet_task';

	static function createTask($count, $min, $max, $end_time, $min_money)
	{	
		if ($min >= $max) {
			throw new Exception("最小金额不可大于最大金额");
		}
		$now_date = date('Y-m-d H:i:s');
		$task_id = RedPacketTask::insertGetId(array('created_at'=> $now_date)); # 获取活动id 只为了与user_id 组成唯一

		$task_detail = array();

		for ($i=0; $i < $count; $i++) { 
			$tmp_arr = array(
				'task_id' => $task_id,
				'money' => round(mt_rand($min * 100, $max * 100) * 0.01, 2),
				'min_money' => $min_money,
				'created_at' => $now_date,
				'end_time' => $end_time,
			);
			$task_detail[] = $tmp_arr;
		}
		
		RedPacketTaskDetail::insert($task_detail);

	}
}