<?php
	include('server.php');
	$msv = $_SESSION['msv'];
	$sql_info_like_baidang = "SELECT * FROM like_baidang WHERE idcuusinhvien='$msv'";
	$result5 = mysqli_query($db, $sql_info_like_baidang);
	$idbaidang = $_SESSION['idbaidang'];
	$like_idbaidang = "like_baidang" .$idbaidang;
	$dislike_idbaidang = "dislike_baidang" .$idbaidang;
	$arr_info_like_baidang = mysqli_fetch_array($result5);
	$like_baidang = $arr_info_like_baidang[$like_idbaidang];
	$dislike_baidang = $arr_info_like_baidang[$dislike_idbaidang];
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Post User</title>
	<!-- Bootstrap's dependcies -->
	<script src="js/jquery-3.3.1.js"></script>
	<script src="js/popper-1.14.3.js"></script>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="js/bootstrap.js"></script>
	<!-- Roboto Font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
	<!-- Awesome Icon -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns"
	 crossorigin="anonymous">
	<link rel="stylesheet" href="post.css">
</head>

<body>
	<?php include('nav.php') ?>
	<div class="container-fluid">
		<div class="row">
			<div id="left-content" class="col-3 d-flex">
				<div id="left" class="ml-auto">
					<ul class="list-unstyled mr-5">
						<li id="tanglike"><i class="fas fa-caret-up fa-2x"></i></li>
						<li id="like"></li>
						<li id="giamlike"><i class="fas fa-caret-down fa-2x"></i></li>
						<li><a onclick="focus_cmt()"><i style="color: rgb(84, 84, 84)" class="fas fa-comment fa-lg"></i></a></li>
						<li>
						<?php
							if(isset($_SESSION['cmt_baidang'])) {
								echo $_SESSION['cmt_baidang'];
							}
						?>
						</li>
					</ul>
				</div>
			</div>
			<div id="middle-content" class="col-6 mt-3" style="padding: 20px;">
				<div class="media">
					<img src="<?php 
						if(isset($_SESSION['anh'])) { 
							echo 'image/' .$_SESSION['anh'];
						}
						else {
							echo 'image/fiora.jpg';
						}
					?>"
					alt="Image_User" class="mr-2 rounded-circle" width="60px" height="60px">
					<div class="media-body">
						<h5>
						<?php
							if(isset($_SESSION['username'])) {
								echo $_SESSION['username'];
							}
						?>
						</h5>
						<p>Đăng vào ngày
						<span style="color: gray">
							<?php
								if(isset($_SESSION['thoigian_dangbai'])) {
									echo substr($_SESSION['thoigian_dangbai'], 11, 8). " " 
                                        .substr($_SESSION['thoigian_dangbai'], 8, 2). "/" .substr($_SESSION['thoigian_dangbai'], 5, 2). "/" 
                                        .substr($_SESSION['thoigian_dangbai'], 0, 4);
								}
							?>
						</span>
						</p>
					</div>
				</div>
				<h3 class="mt-3">
					<?php
						if(isset($_SESSION['tieude'])) {
							echo $_SESSION['tieude'];
						}
					?>
				</h3>
				<img class="img-fluid mt-3" 
				src="<?php
					if(isset($_SESSION['hinhanh'])) {
						echo "image/" .$_SESSION['hinhanh']; 
					}
					else {
						echo "image/fiora.jpg";
					}
				?>"
				alt="Image_Post">
				<div id="content-post" class="mt-4">
					<p style="word-spacing: 2px; letter-spacing: 0.5px">
						<?php
							if(isset($_SESSION['noidung'])) {
								echo $_SESSION['noidung'];
							}
						?>
					</p>
				</div>
				<div class="ml-4 mb-3 mt-4" style="font-weight: 500">
					<?php
						if(isset($_SESSION['cmt_baidang'])) {
							echo $_SESSION['cmt_baidang'];
						}
					?> bình luận
				</div>
				<div class="mt-0 p-4 border" style="border-radius: 7px; box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1), 0 2px 6px 0 rgba(0, 0, 0, 0.19);">
					<form method="post" action="post.php">
						<div class="mt-3 input-group">
							<input id="comment" name="comment" type="text" class="form-control" placeholder="Chia sẻ cảm nghĩ của bạn về bài viết">
							<div class="input-group-append">
								<button style="z-index: 0" class="btn btn-outline-primary" type="submit" name="submit_comment">Gửi</button>
							</div>
						</div>
					</form>
					<hr>
					<?php
						$idbaidang = $_SESSION['idbaidang'];
						$sql_info_cmt = "SELECT * FROM binhluan WHERE idbaidang='$idbaidang'";
						$result = mysqli_query($db, $sql_info_cmt);
						if(mysqli_num_rows($result) > 0) {
							while($arr_info_cmt = mysqli_fetch_assoc($result)) {
								$msv_cmt = $arr_info_cmt['idcuusinhvien'];
								$thoigian_cmt = $arr_info_cmt['thoigian'];
								$comment = $arr_info_cmt['comment'];
								$sql_info_sv = "SELECT hoten, anh FROM cuusinhvien WHERE idcuusinhvien='$msv_cmt'";
								$result2 = mysqli_query($db, $sql_info_sv);
								$arr_info_sv = mysqli_fetch_array($result2);
								$hoten = $arr_info_sv['hoten'];
								$anh = $arr_info_sv['anh'];
								$count_like_cmt = $arr_info_cmt['like_cmt'];
								$idbinhluan = $arr_info_cmt['idbinhluan'];
								$sql_info_rep_cmt = "SELECT * FROM traloi WHERE idbinhluan='$idbinhluan'";
								$result3 = mysqli_query($db, $sql_info_rep_cmt);
								echo "<div class='media mb-4'>
										<div class='ml-auto small mr-3'>
											<ul class='list-unstyled'>
												<li><a href='server4.php?tanglike=like_cmt" .$idbinhluan. "' style='color: rgb(84, 84, 84);'><i id='like_cmt" .$idbinhluan. "' class='fas fa-caret-up fa-2x'></i></a></li>
												<li>" .$count_like_cmt. "</li>
												<li><a href='server4.php?giamlike=dislike_cmt" .$idbinhluan. "' style='color: rgb(84, 84, 84);'><i id='dislike_cmt" .$idbinhluan. "' class='fas fa-caret-down fa-2x'></i></a></li>
											</ul>
										</div>
										<img src='image/" .$anh. "' alt='Image_User' class='mr-2 mt-2 rounded-circle' width='40px'>
										<div class='media-body'>
											<p class='mt-1' style='font-weight: 500'>" .$hoten. "</p>
											<small style='position: relative; top: -15px; color: gray;'>" .substr($thoigian_cmt, 11, 8). " " 
											.substr($thoigian_cmt, 8, 2). "/" .substr($thoigian_cmt, 5, 2). "/" 
											.substr($thoigian_cmt, 0, 4). "</small>
											<p style='position: relative; left: -45px;'>" .$comment. "</p>
											<a onclick='input_rep_cmt(this)' style='position: relative; left: -45px; top: -10px; color: #2582be;'>Trả lời</a>";
											if(mysqli_num_rows($result3) > 0) {
												while($arr_info_rep_cmt = mysqli_fetch_assoc($result3)) {
													$idtraloi = $arr_info_rep_cmt['idtraloi'];
													$rep_cmt = $arr_info_rep_cmt['rep_cmt'];
													$like_rep_cmt = $arr_info_rep_cmt['like_rep_cmt'];
													$idcuusinhvien = $arr_info_rep_cmt['idcuusinhvien'];
													$thoigian_rep_cmt = $arr_info_rep_cmt['thoigian'];
													$sql_info_sv_rep_cmt = "SELECT hoten, anh FROM cuusinhvien WHERE idcuusinhvien='$idcuusinhvien'";
													$result4 = mysqli_query($db, $sql_info_sv_rep_cmt);
													$arr_info_sv_rep_cmt = mysqli_fetch_array($result4);
													$hoten_sv = $arr_info_sv_rep_cmt['hoten'];
													$anh_sv = $arr_info_sv_rep_cmt['anh'];
													echo "<div class='media border-left' style='position: relative; left: -20px'>
															<div class='ml-auto small mr-3 pl-2'>
																<ul class='list-unstyled'>
																	<li><a href='server4.php?tanglike1=like_rep_cmt" .$idtraloi. "' style='color: rgb(84, 84, 84);'><i class='fas fa-caret-up fa-2x'></i></a></li>
																	<li>" .$like_rep_cmt. "</li>
																	<li><a href='server4.php?giamlike1=dislike_rep_cmt" .$idtraloi. "' style='color: rgb(84, 84, 84);'><i class='fas fa-caret-down fa-2x'></i></a></li>
																</ul>
															</div>
															<img src='image/" .$anh_sv. "' alt='Image_User' class='mr-2 mt-2 rounded-circle' width='40px' height='40px'>
															<div class='media-body'>
																<p class='mt-1' style='font-weight: 500'>" .$hoten_sv. "</p>
																<small style='position: relative; top: -15px; color: gray;'>" .substr($thoigian_rep_cmt, 11, 8). " " 
																.substr($thoigian_rep_cmt, 8, 2). "/" .substr($thoigian_rep_cmt, 5, 2). "/" 
																.substr($thoigian_rep_cmt, 0, 4). "</small>
																<p style='position: relative; left: -45px;'>" .$rep_cmt. "</p>
																<a onclick='input_rep_cmt2(this)' style='position: relative; left: -45px; top: -10px; color: #2582be;'>Trả lời</a>
															</div>
														</div>";
												}
											}
									echo  "</div>	
											</div>
											<div style='display: none'>
												<form method='post' action='post.php' class='ml-5'>
													<div class='input-group ml-5' style='width: 80%'>
														<input name='idbinhluan' value='" .$idbinhluan. "' readonly style='display: none;'>
														<input name='rep_comment' style='width: 20px; border-top-left-radius: 4px; border-bottom-left-radius: 4px;' type='text' class='form-control'>
														<div class='input-group-append'>
															<button class='btn btn-outline-primary' type='submit' name='submit_rep_cmt'>Gửi</button>
														</div>
													</div>
												</form>
												<img style='position: relative; top: -48px; left: 40px;' src='image/" .$_SESSION['anh']. "' alt='Image_User' class='mr-2 mt-2 rounded-circle' width='40px' height='40px'>
											</div>";
							}
						}
					?>
				</div>
			</div>
			<div id="right-content" class="col-3">

			</div>
		</div>
	</div>
	<script src="post.js"></script>
	<script>
		$(function () {
            $('[data-toggle="popover"]').popover()
        });
        $(document).ready(function() {
            setInterval(function() {
                $("#load_thongbao").load("load_thongbao.php").fadeIn();
            }, 500)
            setInterval(function() {
                $("#count_thongbao").load("load_count_thongbao.php").fadeIn();
            }, 500)
        })
        $(document).ready(function() {
            $("#an_hien_thongbao").on("click", function() {
                check = 1;
                $.ajax({
                    type: "POST",
                    url: "load_count_thongbao.php",
                    data: {
                        'check': check
                    }, 
                    success: function(data) {
                        return ;
                    }
                })
            })    
        })
        $('body').on('click', function (e) {
            if ($(e.target).data('toggle') !== 'popover'
            && $(e.target).parents('.popover.in').length === 0) { 
                $('[data-toggle="popover"]').popover('hide');
            }
        });
		$(document).ready(function() {
			var check1 = <?php echo json_encode($like_baidang)?>;
			var check2 = <?php echo json_encode($dislike_baidang)?>;
			var content = "";
			var message = "";
			if(check1 == 1) {
				$("#tanglike").css("color", "#4CD964");
			}
			if(check2 == 1) {
				$("#giamlike").css("color", "#ea2858");
			}
			$("#tanglike").click(function(){
				if(check1 == 0){
					$(this).css("color","#4CD964");
					$("#giamlike").css("color","rgb(84, 84, 84)");
					if(check2 == 0) $("#like").html(parseInt($("#like").text()) + 1);
					else $("#like").html(parseInt($("#like").text()) + 2);
					check1 = 1;
					check2 = 0;
					content = "Bạn đã like";
					message = " đã like";
				}
				else{
					$(this).css("color","rgb(84, 84, 84)");
					$("#like").html(parseInt($("#like").text()) - 1);
					check1 = 0;
					content = "Bạn đã bỏ like";
					message = " đã bỏ like";
				}
				var luot_like = parseInt($("#like").text());
				$.ajax({
					url: "server2.php",
					method: "POST",
					data: {
						'luot_like': luot_like,
						'check1': check1,
						'check2': check2,
						'content': content,
						'message': message
					},
					dataType: "text",
					success: function(data) {
						retun ;
					}
				})
			});
			$("#giamlike").click(function(){
				if(check2 == 0){
					$(this).css("color","#ea2858");
					$("#tanglike").css("color","rgb(84, 84, 84)");
					if(check1 == 0) $("#like").html(parseInt($("#like").text()) - 1);
					else $("#like").html(parseInt($("#like").text()) - 2);
					check1 = 0;
					check2 = 1;
					content = "Bạn đã dislike";
					message = " đã dislike";
				}
				else{
					$(this).css("color","rgb(84, 84, 84)");
					$("#like").html(parseInt($("#like").text()) + 1);
					check2 = 0;
					content = "Bạn đã bỏ dislike";
					message = " đã bỏ dislike";
				}
				var luot_like = parseInt($("#like").text());
				$.ajax({
					url: "server2.php",
					method: "POST",
					data: {
						'luot_like': luot_like,
						'check1': check1,
						'check2': check2,
						'content': content,
						'message': message
					},
					dataType: "text",
					success: function(data) {
						retun ;
					}
				})
			})
			setInterval(function(){
				$("#like").load("server3.php").fadeIn("slow");
			}, 100)
		})
	</script>
</body>

</html>