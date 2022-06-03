<?php 
session_start();
# require $_SERVER['DOCUMENT_ROOT'].'crud/config.php';
$db=mysqli_connect("localhost", "Krisadell", "Kr1s4nd1_03", "nofly");
if( !$db )
{
  die("Gagal terhubung dengan database: " . mysqli_connect_error());
}
// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
  $id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
	$result = mysqli_query($db, "SELECT email FROM customer WHERE cust_id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan email
	if( $key === hash('sha256', $row['email']) ) {
		$_SESSION['login'] = true;
	}


}

if( isset($_SESSION["login"]) ) {
	header("Location: http:\\localhost\RPL\dashboard.php");
	exit;
}


if( isset($_POST["login"]) ) {

	$email = $_POST["email"];
	$password = $_POST["password"];

	$result = mysqli_query($db, "SELECT * FROM customer WHERE email = '$email'");

	// cek username
	if( mysqli_num_rows($result) === 1 ) 
  {
		// cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {
			// set session
			$_SESSION["login"] = true;

			// cek remember me
			if( isset($_POST['remember']) ) 
      {
				// buat cookie
				setcookie('id', $row['id'], time()+60);
				setcookie('key', hash('sha256', $row['email']), time()+60);
			}

			header("Location: dashboard.php");
			exit;
		}
	}

	$error = true;

}

?>

<!DOCTYPE html>
<html lang="zxx">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>log In NT</title>
    <link rel="icon" href="img/thrift.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.css" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <!-- font kursi belajar CSS -->
    <link rel="stylesheet" href="css/all.css" />
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <!-- font kursi belajar CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css" />
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>
<!--::header part start::-->
</header>
    </nav>
    <!-- Header part end-->

    <!-- breadcrumb start-->
    <section class="breadcrumb2 breadcrumb2_bg2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="breadcrumb2_iner2">
                        <div class="breadcrumb2_iner2_item2">
                            <header class="ex-header">
                                <div class="container">
                                    <div class="row">
                                    <div class="col-xl-10 offset-xl-1">
                        
                                      <h1 class="text-center">welcome back!</h1>
                                    </div>
                                  </div>
                                  <!-- end of col -->
                                </div>
                                <!-- end of row -->
                          
                                <!-- end of container -->
                              </header>
                              <!-- end of ex-header -->
                              <!-- end of header -->
                          
                              <!-- Basic -->
                          
                              <div class="ex-form-1 pt-3 pb-6">
                                <div class="container">
                                  <div class="row">
                                    <div class="col-xl-8 offset-xl-2">
                                     
                                        <!-- Log In Form -->
                                        <form action = "" method = "POST">
                                          <div class="mb-4 form-floating">
                        
                                            <input type="email" class="form-control" id="email" placeholder="Emailaddress@example.com" required/>
                                           
                                          </div>
                                          <div class="mb-4 form-floating">
                                       
                                            <input type="password" class="form-control" id="password" placeholder="Password" required/>
                                            
                                          </div>
                                          <div class="mb-4 form-check">
                                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                            <label class="form-check-label" for="remember">Remember me</label>
                                          </div>
                                          
                                          <button type = "submit" name = "login" class="btn_3">Log in</button>
                                        </form>
                                        <div class="text-box mt-2 mb-2">
                                            <p class="mb-1">You don't have a account? Then please <a class="blue" href="http://localhost/RPL/RPLori/signup.php">Sign Up</a></p>
                              
                                        <!-- end of log in form -->
                                      </div>
                                      <!-- end of text-box -->
                                    </div>
                                    <!-- end of col -->
                                  </div>
                                  <!-- end of row -->
                                </div>
                                <!-- end of container -->
                              </div>
                              <!-- end of ex-basic-1 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->



    <!-- jquery plugins here-->
    <script src="js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- easing js -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- swiper js -->
    <script src="js/swiper.min.js"></script>
    <!-- swiper js -->
    <script src="js/masonry.pkgd.js"></script>
    <!-- particles js -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- slick js -->
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
  </body>
</html>
