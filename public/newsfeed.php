<?php $body_class = "Newsfeed"; ?>
<?php require_once 'header.php' ?>
	<?php require_once 'nav.php' ?>
	<div class="container Newsfeed-container">
		<div class="row">
			<div class="col-4">
				<div class="Newsfeed-Sidebar">
					<div class="ProfileCard">
						<a href="#" class="ProfileCard-bg img-bg" style="background-image: url(img/treesbg.jpg); background-position: center -50px;"></a>
						<div class="ProfileCard-content">
							<div class="ProfileCanopy-avatar">
								<div class="ProfileAvatar">
									<a href="#" class="ProfileAvatar-container">
										<img src="img/profile-100x100.jpg" alt="Lauren Graham" class="ProfileAvatar-image" />
									</a>
								</div>
							</div>
							<div class="clearfix d-none" style="height: 60px"></div>
							<div class="ProfileCard-userFields">
								<a href="#" class="profileName"><strong><?= $user->name ?></strong></a>
								<br />
								<a href="#" class="handle">@<?= $user->username ?></a>
							</div>
							<div class="ProfileCard-stats ProfileStats">
								<ul class="ProfileStats-list inline">
									<li class="ProfileStats-item tac">
										<a href="#" class="ProfileStats-stat text">
											<span class="ProfileStats-label">Tweets</span>
											<span class="ProfileStats-value"><strong>NA</strong></span>
										</a>
									</li>
									<li class="ProfileStats-item tac">
										<a href="#" class="ProfileStats-stat text">
											<span class="ProfileStats-label">Followers</span>
											<span class="ProfileStats-value"><strong>NA</strong></span>
										</a>
									</li>
									<li class="ProfileStats-item tac">
										<a href="#" class="ProfileStats-stat text">
											<span class="ProfileStats-label">Following </span>
											<span class="ProfileStats-value"><strong><?= count($user->following) ?></strong></span>
										</a>
									</li>
									<li class="ProfileStats-item tac">
										<a href="#" class="ProfileStats-stat text">
											<span class="ProfileStats-label">Likes </span>
											<span class="ProfileStats-value"><strong>NA</strong></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-8">
				<section class="stream">
					<div class="StreamComposer">
						<div class="row">
							<div class="col-1">
								<a href="#" class="avatarLink">
									<img src="img/profile-100x100.jpg" alt="Name" class="avatarImg">
								</a>
							</div>
							<div class="col-11">
								<textarea name="tweetBody" placeholder="Complain about something..." class="TweetBody StreamComposer-composer"></textarea>
								<div class="d-flex justify-content-end">
									<a href="#" class="btn gradient gradient-primary TweetBtn" data-userid="<?= $user->getDbId() ?>" style="height: 40px; font-size: 16px; width: 120px; line-height: 2.4em; margin-top: 15px">Tweet</a>
								</div>
							</div>
						</div>
					</div>
					<ol class="stream-items">
						<?php if(!empty($feed)): ?>
						<?php foreach($feed as $tweet): ?>
						<li class="stream-item">
							<div class="tweet">
								<div class="context">
									<div class="tweet-context medgray d-none">
										<span class="Icon Icon--retweet"></span>
										<span class="context-text">maggs retweeted</span>
									</div>
								</div>
								<div class="content">
									<div class="tweet-header d-flex" style="width: 100%;">
										<a href="#" class="accountlinks-header d-flex" style="flex-grow: 9">
											<img src="img/profile-100x100.jpg" alt="Name" class="avatar">
											<span class="fullName text"><strong><?= $tweet->User->name ?></strong></span>
											<span class="handle text">@<?= $tweet->User->username ?></span>
										</a>
										<div class="d-flex justify-content-end" style="flex-grow: 2"><small class="medgray tweet-timestamp"><?= $tweet->created ?></small></div>
									</div>
									<div class="tweet-content">
										<p><?= $tweet->body ?></p>
									</div>
									<div class="tweet-footer">
										<div class="Tweet-actionList">
											<a href="#" title="Like tweet" class="Tweet-action Tweet-action--like">
												<span class="Icon Icon--like"></span>
												<span class="Tweet-actionCount">0</span>
											</a>
											<a href="#" title="Retweet" class="Tweet-action Tweet-action--retweet">
												<span class="Icon Icon--retweet"></span>
												<span class="Tweet-actionCount">0</span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</li>
						<?php endforeach; ?>
						<?php else: ?>
							<li class="tac notweets" style="margin-top: 8%">Nothing to show here :(</li>
						<?php endif; ?>
					</ol>
				</section>
			</div>
		</div>
	</div>
	<script>
		var currentusername = "<?= $user->name ?>";
		var username = "<?= $user->username ?>";
	</script>
	<script src="http://localhost/thunder/js/tweet.js"></script>
<?php require_once 'footer.php' ?>
