<?php 
	require_once 'inc/utils.php'; 
  $pagename = 'Login';
  require_once 'assets/head.php';
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
                  <h4 class="font-weight-bolder">Login</h4>
                  <p class="mb-0">Enter your email and password to login</p>
                </div>
                <div id="errs" class="errorcontainer"></div>
                <div class="card-body">
                  <form role="form" id="loginForm">
                    <div class="mb-3">
                      <input id="email" name="email" type="email" autocomplete="email" class="form-control form-control-lg" required placeholder="Enter your email" aria-label="Email" onkeydown="if(event.key === 'Enter'){event.preventDefault();login();}" >
                    </div>
                    <div class="mb-3">
                      <input id="password" name="password" type="password" autocomplete="current-password" required class="form-control form-control-lg" placeholder="Enter your password" aria-label="Password" onkeydown="if(event.key === 'Enter'){event.preventDefault();login();}">
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button type="button" onclick="login();" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Login</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="./register.php" class="text-primary text-gradient font-weight-bold">Register</a>
                  </p>
                  <p class="mb-4 text-sm mx-auto">
                    Forgot your password? 
                    <a href="./resetPassword.php" class="text-primary text-gradient font-weight-bold">Reset Password</a>
                  </p>                  
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');
          background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"The harder I work, the luckier I get"</h4>
                <p class="text-white position-relative">Don' t judge each day by the harvest you reap but by the seeds that you plant.</p>
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
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>