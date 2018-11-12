<?php $body_class = "Feed"; ?>
<?php require_once 'header.php'; ?>

	<header class="header">
		<div class="container-fluid p-0">
			<div class="row no-gutters">
				<div class="col">
					<div class="d-flex">
						<div class=""><a href="#" class="logo"></a></div>
						<div class="">
							<nav class="mainNav">
								<ul class="d-flex">
									<li class="align-self-center"><a href="#">Home</a></li>
									<li class="align-self-center"><a href="#">Feed</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<div class="col justify-content-end">
					<div class="d-flex justify-content-end rightNav">
						<div class="align-self-center mr-5">
							<form action="#" class="searchForm">
								<input type="text" name="q" placeholder="Search..." />
							</form>
						</div>
						<div class="align-self-center">
							<a class="text logout" href="#">Log out</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="mainContent">
		<div class="bgimg img-bg" style="background-image: url(img/treesbg.jpg); background-position: center -440px;"></div>
		<div class="container">
			<div class="row">
				<div class="col-3">
					<div class="Profile-Sidebar">
						<div class="ProfileCanopy-avatar">
							<div class="ProfileAvatar">
								<a href="#" class="ProfileAvatar-container">
									<img src="img/profile-500x500.jpg" alt="Lauren Graham" class="ProfileAvatar-image" />
								</a>
							</div>
						</div>
						<div class="clearfix" style="height: 200px"></div>
						<div class="Profile-HeaderCard">
							<a href="#" class="Profile-name darkgray"><strong>Lauren Heathrow</strong></a>
							<br>
							<a href="#" class="Profile-handle medgray">@laurenh</a>
							<span class="medgray" style="margin-left: 30px;"><small>Follows you</small> </span>
							<p class="Profile-datejoin lgray">Joined Oct 2018</p>
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
										<span class="ProfileStats-value"><strong>29K</strong></span>
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
							<a href="#" class="actionBtn btn gradient gradient-primary FollowBtn align-self-center">Follow</a>
						</div>
						<div class="StreamContainer">
							<h2 class="sectionTitle FeedTitle medgray">Tweets</h2>
							<div class="stream">
								<ol class="stream-items">
									<?php for($i = 0; $i < 6; $i++): ?>
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
									</li>
									<?php endfor; ?>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require_once 'footer.php'; ?>
