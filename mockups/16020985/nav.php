<nav id="navibar" class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-dark">
		<a class="navbar-brand" href="https://uet.vnu.edu.vn/">
			<img src="img/logo_c9.svg" width="30" height="30" class="d-inline-block align-top" alt="">
			UET graduate forum
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
		 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a href="C001.php" class="nav-link active ml-4">
						<i class="fas fa-home mr-2"></i>
						Trang chủ
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link ml-4" data-toggle="popover" data-trigger="focus" data-placement="bottom"
					 data-container="#navibar" data-html="true" title="">
						<i class="fas fa-bell mr-2"></i>
						Thông báo
					</a>
				</li>
				<li class="nav-item">
					<a href="profile.php" class="nav-link ml-4">
						<i class="fas fa-user mr-2"></i>
						<?php
							if(isset($_SESSION['username'])) {
								echo $_SESSION['username'];
							}
						?>
					</a>
				</li>
			</ul>
		</div>
	</nav>