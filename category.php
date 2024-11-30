<?php include "db_Connect.php"

$select_category="SELECT * FROM mstcategory WHERE isVisible='Y'";
$select_category_result = sqlsrv_query($conn,$select_category);



?>
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
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <?php include "sidebar.php"?>
    <div class="body-wrapper">
      <?php include "header.php"?>
      <div class="body-wrapper-inner">
        <div class="container-fluid">
            <div class="card card-body py-3">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-4 mb-sm-0 card-title">Category</h4>
                            <button type="button" class="btn bg-primary-subtle text-primary"
                                data-bs-toggle="modal" data-bs-target="#create">
                                <span class="fs-4 me-1">+</span>
                                Add New Category
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="create" class="modal fade" tabindex="-1" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-center mt-2 mb-4">
                                Create Category
                            </div>
                            <form action="http://stock.swiftmore.in/mobileApis/TestCURD_category.php" method="post" enctype="multipart/form-data"
                                class="ps-3 pr-3">
                                <!-- create modal -->
                                <input type="text" name="action" value="create" hidden> 
                                <!-- create modal -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="inputcom" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="catinput"
                                                placeholder="Category Here" name="catName">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Select File</label>
                                            <div class="input-group flex-nowrap">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="form-control"
                                                        id="inputGroupFile01" accept=".png, .jpg,.jpeg,image/*"
                                                        name="catImg" onchange="showImage(this, 'img_url');">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xxl-4">
                                        <div class="mb-3">
                                            <div class="mb-3 d-flex justify-content-center">
                                                <img style="height: 150px; width: 3.5cm; display:none"
                                                    id="img_url" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-center">
                                    <button class="btn btn-rounded bg-info-subtle text-info " type="submit">
                                        Sumbit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($response["Cat"] as $Cat): ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="bg-warning-subtle text-warning d-inline-block px-4 py-3 rounded  viewSub"
                                        data-cat-id="<?= $Cat['catId'] ?>">
                                        <!-- <i class="ti ti-brand-google-drive display-6"></i> -->
                                        <img src="<?= $Cat['catImg'] ?>" class="rounded img-fluid">
                                    </div>
                                    <div class="ms-auto">
                                        <div class="dropdown dropstart">
                                            <a href="javascript:void(0)" class="link text-dark"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="ti ti-dots fs-7"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#view<?= $Cat['catId'] ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item sa-confirm" href="javascript:void(0)"
                                                        data-id="<?= $Cat['catId'] ?>"
                                                        data-catname="<?= $Cat['catName'] ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <h4 class="card-title"><?= $Cat['catName'] ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="view<?= $Cat['catId'] ?>" class="modal fade" tabindex="-1" aria-modal="true"
                        role="dialog">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="text-center mt-2 mb-4">
                                        Edit Category
                                    </div>
                                    <form action="CURD_category.php" method="post" enctype="multipart/form-data"
                                        class="ps-3 pr-3">
                                        <input type="text" name="action" value="update" hidden>
                                        <input type="text" name="catId" value="<?= $Cat['catId'] ?>" hidden>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="inputcom" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="inputcom"
                                                        placeholder="Category Here" name="catName"
                                                        value="<?= $Cat['catName'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Select File</label>
                                                    <div class="input-group flex-nowrap">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="form-control"
                                                                id="inputGroupFile01" value="<?= $Cat['catImg'] ?>"
                                                                accept=".png, .jpg,.jpeg,image/*" name="catImg"
                                                                onchange="img_pathUrl(this, 'img_url1<?= $Cat['catId'] ?>');">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xxl-4">
                                                <div class="mb-3">
                                                    <div class="mb-3 d-flex justify-content-center">
                                                        <?php if (!empty($Cat['catImg'])) { ?>
                                                            <img src="<?= $Cat['catImg'] ?>"
                                                                style="height: 150px; width: 3.5cm;" alt="..."
                                                                id="img_url1<?= $Cat['catId'] ?>">
                                                        <?php } else { ?>
                                                            <img style="height: 150px; width: 3.5cm; display:none"
                                                                id="img_url1<?= $Cat['catId'] ?>" />
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 text-center">
                                            <button class="btn btn-rounded bg-info-subtle text-info" type="submit">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    const showImage=(imginputelement,Id)=>{
        // console.log(imginputelement.files);
        //imginputelement.files .files is required to get the img information in object
        const imgUrl=document.getElementById('img_url');
        if (imginputelement.files && imginputelement.files[0]) {
            const filereader = new FileReader();
            filereader.readAsDataURL(imginputelement.files[0]);//It starts reading the selected file asynchronously.This is used to convert the file to base 64 url for  required if you want to display the selected file (image) in the browser as a preview
            filereader.onload=(e)=>{//When the file is successfully read:
                imgUrl.style.display="block";
                imgUrl.src = e.target.result;
                // console.log(e.target.result);
            }
        }else{
            imgUrl.style.display="none";
        }
    }
    const getResponse = ""

  </script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script><!-- using axios -->
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>