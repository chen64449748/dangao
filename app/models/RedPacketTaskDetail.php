<?php 

/**
* 
*/
class RedPacketTaskDetail extends Eloquent
{
	protected $table = 'red_packet_task_detail';


	static function getRedPacket($task_id, $user_id)
	{
		// 抢红包
		RedPacketTaskDetail::where('task_id', $task_id)->whereIsNull('user_id')->take(1)->update(array('user_id'=> $user_id));

		$red_packet = RedPacketTaskDetail::where('task_id', $task_id)->where('user_id', $user_id)->first();
		RedPacketTaskDetail::inUser($red_packet, $user_id);

		$count = RedPacketTaskDetail::where('task_id', $task_id)->whereIsNull('user_id')->count();


		if (!$count) {
			RedPacketTask::where('id', $task_id)->update(array('state', 2)); #结束
		}
	}


	static function inUser($red_packet, $user_id)
	{
		$red_packet = array(
			'money' => $red_packet->money,
			'min_money' => $red_packet->min_money,
			'created_at' => date('Y-m-d H:i:s'),
			'user_id' => $user_id,
			'end_time' => $red_packet->end_time,
			'state' => 1,
		);

		RedPacket::insert($red_packet);

	}

}