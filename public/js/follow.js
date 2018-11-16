// follow.js
$(function() {
	$(".FollowBtn").click(function(e) {
		e.preventDefault();
		$.post('/thunder/follow', {"to_id": $(this).data('toid')}, function(result) {
			if(result && result.success) {
				$('.FollowBtn').html('Following');
			}
			else {
				alert("An error was produced. Please try again later");
			}
		}, 'json')
	});
});

