$(function(){
	
	var note = $('.note'),
		ts = new Date(2016, 0, 1),
		newYear = true;
	
	if((new Date()) > ts){
		// The new year is here! Count towards something else.
		// Notice the *1000 at the end - time must be in milliseconds
		// ts = (new Date()).getTime() + 10*11*60*60*1000;
		ts = (new Date()).getTime() + 11*60*60*1000;
		newYear = false;
	}
		
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			
			var message = "";
			
			// message += days + " day" + ( days==1 ? '':'s' ) + ", ";
			message += "剩余" ;
			message += hours + "小时" + ( hours==1 ? '':'' ) + "";
			message += minutes + "分钟" + ( minutes==1 ? '':'' ) + "";
			message += seconds + "秒" + ( seconds==1 ? '':'' ) + "";
			
			if(newYear){
				message += "";
			}
			else {
				message += "";
			}
			
			note.html(message);
		}
	});
	
});
