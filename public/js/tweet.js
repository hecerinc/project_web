let tweetid = `
<li class="stream-item">
	<div class="tweet">
		<div class="context">
			<div class="tweet-context medgray">
				<span class="Icon Icon--retweet"></span>
				<span class="context-text">maggs retweeted</span>
			</div>
		</div>
		<div class="content">
			<div class="tweet-header d-flex" style="width: 100%;">
				<a href="#" class="accountlinks-header d-flex" style="flex-grow: 9">
					<img src="img/profile-100x100.jpg" alt="Name" class="avatar">
					<span class="fullName text"><strong>Magdalena Martinez</strong></span>
					<span class="handle text">@maggs</span>
				</a>
				<div class="d-flex justify-content-end" style="flex-grow: 2"><small class="medgray tweet-timestamp">8 hours ago</small></div>
			</div>
			<div class="tweet-content">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam deleniti reiciendis laborum nam reprehenderit odio debitis consectetur voluptates, dolore commodi sit voluptas, libero adipisci sapiente modi obcaecati nesciunt ut nobis!</p>
			</div>
			<div class="tweet-footer">
				<div class="Tweet-actionList">
					<a href="#" title="Like tweet" class="Tweet-action Tweet-action--like">
						<span class="Icon Icon--like"></span>
						<span class="Tweet-actionCount">2.1K</span>
					</a>
					<a href="#" title="Retweet" class="Tweet-action Tweet-action--retweet">
						<span class="Icon Icon--retweet"></span>
						<span class="Tweet-actionCount">2.1K</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</li>`;
$(function() {
	$('.TweetBtn').click(function(e) {
		e.preventDefault();
		var userid = $(this).data('userid');
		var body = $('.TweetBody').val();
		$.post('http://localhost/thunder/tweet', {body: body, "user_id": userid}, function(result) {
			if(result && result.success){
				// Update feed
				var $newtweet = $(tweetid);
				console.log($newtweet);
				$newtweet.find('.tweet-content').html("<p>"+body+"</p>");
				$newtweet.find('.Tweet-actionCount').html(0);
				$newtweet.find('.fullName').html(`<strong>${currentusername}</strong>`);
				$newtweet.find('.handle').html("@"+username);
				$('.notweets').hide();
				$('.stream-items').prepend($newtweet);
				console.log('Done');
			}

		}, 'json');
	});
});