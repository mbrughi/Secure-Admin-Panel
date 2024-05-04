<?php 
	require_once 'inc/utils.php';
    $pagename = 'Reset Password';
    require_once 'assets/head.php';	
?>
<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <?php if(empty($_GET['id']) && empty($_GET['hash'])) { ?>	
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Password Recovery</h4>
                </div>
                <div id="errs" class="errorcontainer"></div>
                <div class="card-body">
                  <form role="form" id="resetPasswordForm">
                    <div class="mb-3">
                      <input id="email" name="email" type="email" autocomplete="email" class="form-control form-control-lg" required placeholder="Enter your email" aria-label="Email" onkeydown="if(event.key === 'Enter'){event.preventDefault();passwordResetRequest();}" >
                    </div>
                    <div class="text-center">
                      <button type="button" onclick="passwordResetRequest();" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Send Password Reset Request</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Remembered your password?
                    <a href="./login.php" class="text-primary text-gradient font-weight-bold">Login</a>
                  </p>                
                </div>
              </div>
            </div>
            <?php } else { ?>
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Password Recovery</h4>
                </div>
                <div id="errs" class="errorcontainer"></div>
                <div class="card-body">
                  <form role="form" id="changePasswordForm">
                    <div class="mb-3">
                      <input id="password" name="password" type="password" autocomplete="email" required placeholder="Enter your new password" onkeydown="if(event.key === 'Enter'){event.preventDefault();changePassword();}"/>
                    </div>
                    <div class="mb-3">
                      <input id="confirm-password" name="confirm-password" type="password" autocomplete="email" required placeholder="Confirm your password" onkeydown="if(event.key === 'Enter'){event.preventDefault();changePassword();}"/>
                    </div>
       				<input id="id" name="id" type="hidden" value="<?php echo htmlspecialchars($_GET['id']); ?>" />
		    		<input id="hash" name="hash" type="hidden" value="<?php echo htmlspecialchars($_GET['hash']); ?>" />
                    <div class="text-center">
                      <button type="button" onclick="changePassword();" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Change Password</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    <a href="./login.php" class="text-primary text-gradient font-weight-bold">Go back to log in</a>
                  </p>                
                </div>
              </div>
            </div>
			<?php } ?>



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