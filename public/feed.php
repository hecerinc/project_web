<?php $body_class = "Feed"; ?>
<?php require_once 'header.php'; ?>
<?php
function isSameUser($user) {
	if(isset($_SESSION)) {
		return $_SESSION['User']->username == $user->username;
	}
	return false;
}
?>
	<?php require_once 'nav.php' ?>
	<div class="mainContent">
		<div class="bgimg img-bg" style="background-image: url('/thunder/img/treesbg.jpg'); background-position: center -440px;"></div>
		<div class="container">
			<div class="row">
				<div class="col-3">
					<div class="Profile-Sidebar">
						<div class="ProfileCanopy-avatar">
							<div class="ProfileAvatar">
								<a href="#" class="ProfileAvatar-container">
									<img src="/thunder/img/profile-500x500.jpg" alt="Lauren Graham" class="ProfileAvatar-image" />
								</a>
							</div>
						</div>
						<div class="clearfix" style="height: 200px"></div>
						<div class="Profile-HeaderCard">
							<a href="#" class="Profile-name darkgray"><strong><?= $feedUser->name ?></strong></a>
							<br>
							<a href="#" class="Profile-handle medgray">@<?= $feedUser->username  ?></a>
							<?php if(isLoggedIn() && !isSameUser($feedUser)): ?>
								<span class="medgray" style="margin-left: 30px;"><small>Follows you</small> </span>
							<?php endif ?>
							<p class="Profile-datejoin lgray">Joined <?= date("F Y", strtotime($feedUser->created)) ?></p>
						</div>
					</div>
				</div>
				<div class="col-9">
					<div class="Feed-Content">
						<div class="ProfileStats d-flex">
							<ul class="ProfileStats-list inline">
								<li class="ProfileStats-item tac">
									<a href="#" class="ProfileStats-stat text active">
										<span class="ProfileStats-label">Tweets</span>
										<span class="ProfileStats-value"><strong><?= count($feedUser->tweets) ?></strong></span>
									</a>
								</li>
								<li class="ProfileStats-item tac">
									<a href="#" class="ProfileStats-stat text">
										<span class="ProfileStats-label">Followers</span>
										<span class="ProfileStats-value"><strong>14.5K</strong></span>
									</a>
								</li>
								<li class="ProfileStats-item tac">
									<a href="#" class="ProfileStats-stat text">
										<span class="ProfileStats-label">Following </span>
										<span class="ProfileStats-value"><strong>389</strong></span>
									</a>
								</li>
								<li class="ProfileStats-item tac">
									<a href="#" class="ProfileStats-stat text">
										<span class="ProfileStats-label">Likes </span>
										<span class="ProfileStats-value"><strong>18K</strong></span>
									</a>
								</li>
							</ul>
							<?php if(isLoggedIn() && !isSameUser($feedUser)): ?>
								<a href="#" data-toid="<?= $feedUser->getDbId() ?>" class="actionBtn btn gradient gradient-primary FollowBtn align-self-center">Follow</a>
							<?php elseif(!isLoggedIn()): ?>
								<a href="/thunder" class="actionBtn btn gradient gradient-primary align-self-center">Follow</a>
							<?php endif; ?>
						</div>
						<div class="StreamContainer">
							<h2 class="sectionTitle FeedTitle medgray">Tweets</h2>
							<div class="stream">
								<?php if(count($feedUser->tweets) > 0): ?>
								<ol class="stream-items">
									<?php foreach($feedUser->tweets as $tweet): ?>
									<li class="stream-item">
										<div class="tweet">
											<div class="context">
												<div class="tweet-context d-none medgray">
													<span class="Icon Icon--retweet"></span>
													<span class="context-text">maggs retweeted</span>
												</div>
											</div>
											<div class="content">
												<div class="tweet-header d-flex" style="width: 100%;">
													<a href="#" class="accountlinks-header d-flex" style="flex-grow: 9">
														<img src="/thunder/img/profile-100x100.jpg" alt="Name" class="avatar">
														<span class="fullName text"><strong><?= $feedUser->name ?></strong></span>
														<span class="handle text">@<?= $feedUser->username ?></span>
													</a>
													<div class="d-flex justify-content-end" style="flex-grow: 2"><small class="medgray tweet-timestamp"><?= $tweet->created ?></small></div>
												</div>
												<div class="tweet-content">
													<p><?= $tweet->body; ?></p>
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
								</ol>
								<?php else: ?>
									<p class="tac light" style="font-size: 22px; margin-top: 8%"><?= isLoggedIn() && isSameUser($feedUser) ? "You haven't" : "User hasn't" ?> tweeted anything yet</p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require_once 'footer.php'; ?>
<script src="/thunder/js/follow.js"></script>
