<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Matdash Free</title>
  <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>

<body>
  <script>
    const handleSubmit = async (event)=>{ 
      event.preventDefault();
      const mobileNo = document.getElementById("mobileNo").value;
      const password = document.getElementById("password").value;
      const formData = {mobileNo,password};
      // console.log(formData);
      const convertedtonumData = Number(mobileNo);
      if(isNaN(convertedtonumData)){
        console.log("Please enter a valid number");
        return;
      }
      if(mobileNo.length > 10 || mobileNo.length < 10 ){
        console.log("Mobile number must be of  10 digit");
        return;
      }
      try {
        const postresponse = await axios.post("http://stock.swiftmore.in/mobileApis/userLogin.php",formData,{
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // Ensuring it's form data
          }
        });
        console.log(postresponse.data);
        const {userName,mobileNo,success} = postresponse.data;
        if(success){
          localStorage.setItem("userCreds",JSON.stringify({userName , mobileNo}));
          window.location.replace("/PHPDASHBOARD/dashboard.php");
        }else{
          console.log("User is not authenticated");
        }
      } catch (error) {
        console.error("Error posting form data",error.response?.data || error.message);
      }
    }
  </script>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="/PHPDASHBOARD/dashboard.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="./assets/images/logos/logo.svg" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form onSubmit="handleSubmit(event)" method="post">
                  <div class="mb-3">
                    <label for="MobileNo" class="form-label">Mobile No</label>
                    <input type="text" class="form-control" id="mobileNo" name="mobileNo" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <a class="text-primary fw-bold" href="/PHPDASHBOARD/dashboard.php">Forgot Password ?</a>
                  </div>
                  <input type="submit"  class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Sign In">
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to Matdash?</p>
                    <a class="text-primary fw-bold ms-2" href="/PHPDASHBOARD/register.php">Create an account</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script><!-- using axios -->
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>