<?php 
	require_once 'inc/utils.php'; 
	$pagename = 'Email Verification';
  	require_once 'assets/head.php';
?>
<body>
	<?php
		if(isset($_GET['id']) && $_GET['id'] !== '' && isset($_GET['hash']) && $_GET['hash'] !== '') {
			echo '<div class="message">';
			$C = connect();
			if($C) {
				$res = sqlSelect($C, 'SELECT user,hash,timestamp FROM requests WHERE id=? AND type=0', 'i', $_GET['id']);
				if($res && $res->num_rows === 1) {
					$request = $res->fetch_assoc();
					if($request['timestamp'] > time() - 60*60*24) {
						if(password_verify(urlSafeDecode($_GET['hash']), $request['hash'])) {
							if(sqlUpdate($C, 'UPDATE users SET verified=1 WHERE id=?', 'i', $request['user'])) {
								sqlUpdate($C, 'DELETE FROM requests WHERE user=? AND type=0', 'i', $request['user']);
								echo '<h2>Email Verified</h2>';
							}
							else {
								echo '<h2>Failed to Update Database</h2>';
							}
						}
						else {
							echo '<h2>Invalid Verification Request</h2>';
						}
					}
					else {
						echo '<h2>Verification Request Expired</h2><a href="./validateEmail.php">Click here to send another one</a>';
					}
					$res->free_result();
				}
				else {
					echo '<h2>Invalid Verification Request</h2>';
				}
				$C->close();
			}
			else {
				echo '<h2>Failed to Connect to Database</h2>';
			}
			echo '</div>';
		}
		else {
			?>
			<body class="">
			  <main class="main-content  mt-0">
			    <section>
			      <div class="page-header min-vh-100">
			        <div class="container">
			          <div class="row">
			            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
			              <div class="card card-plain">
			                <div class="card-header pb-0 text-start">
			                  <h4 class="font-weight-bolder">Email Verification Request</h4>
			                </div>
			                <div id="errs" class="errorcontainer"></div>
			                <div class="card-body">
			                  <form role="form" id="validateEmailForm">
			                    <div class="mb-3">
									<input id="validateEmail" name="validateEmail" type="email" autocomplete="email" class="form-control form-control-lg" required placeholder="Enter your email" onkeydown="if(event.key === 'Enter'){event.preventDefault();sendValidateEmailRequest();}"/>                      
			                    </div>
			                    <div class="text-center">
			                      <button type="button" onclick="sendValidateEmailRequest();" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Send Verification Request</button>
			                    </div>
			                  </form>
			                </div>
			                <div class="card-footer text-center pt-0 px-lg-2 px-1">
			                  <p class="mb-4 text-sm mx-auto">
			                    Already Verified?
			                    <a href="./login.php" class="text-primary text-gradient font-weight-bold">Login</a>
			                  </p>                  
			                </div>
			              </div>
			            </div>
			            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
			              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
			          background-size: cover;">
			                <span class="mask bg-gradient-primary opacity-6"></span>
			                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
			                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
			              </div>
			            </div>
			          </div>
			        </div>
			      </div>
			    </section>
			  </main>


			<?php
		}
	?>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="<?php echo dirname($_SERVER['PHP_SELF']) . 'assets/js/script.js' ?>"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>