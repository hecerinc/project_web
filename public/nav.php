<header class="header">
	<div class="container-fluid p-0">
		<div class="row no-gutters">
			<div class="col">
				<div class="d-flex">
					<div class=""><a href="#" class="logo"></a></div>
					<div class="">
						<nav class="mainNav">
							<ul class="d-flex">
								<?php if(isLoggedIn()): ?>
									<li class="align-self-center"><a href="/thunder/home">Home</a></li>
								<?php else: ?>
									<li class="align-self-center"><a href="/thunder">Home</a></li>
								<?php endif; ?>
								<?php if(isLoggedIn()): ?>
									<li class="align-self-center"><a href="/thunder/feed">Feed</a></li>
								<?php else: ?>
									<li class="align-self-center"><a href="/thunder">Feed</a></li>
								<?php endif; ?>
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
						<?php if(isLoggedIn()): ?>
							<a class="text logout" href="/thunder/users/logout">Log out</a>
						<?php else: ?>
							<a class="text logout" href="/thunder">Log in</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
