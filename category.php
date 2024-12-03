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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script><!-- using axios -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><!--Using sweet alert-->
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
                                    <form id="createform" onSubmit="handleFormSubmit(event)" method="post"
                                        enctype="multipart/form-data" class="ps-3 pr-3">
                                        <!-- create modal -->
                                        <input type="text" id="action" name="action" value="create" hidden>
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
                                    <script>
                                        const handleFormSubmit = async (e) => {
                                            try {
                                                e.preventDefault();
                                                const formData = new FormData();//It is optional but recommended when including files in a request 
                                                //When dealing with file uploads (<input type="file">), you cannot directly store the file in a plain JavaScript object. The .files property of a file input is a File object, which needs to be properly encoded for transmission. FormData handles this encoding for you.
                                                const a = document.getElementById('inputGroupFile01').files[0];
                                                console.log(a);
                                                formData.append('catName', document.getElementById('catinput').value);
                                                formData.append('catImg', document.getElementById('inputGroupFile01').files[0]); // Actual file
                                                formData.append('action', document.getElementById('action').value);
                                                const addPostResponse = await axios.post("http://stock.swiftmore.in/mobileApis/TestCURD_category.php", formData
                                                );
                                                if (addPostResponse.data) {
                                                    console.log(addPostResponse.data);
                                                    location.reload();
                                                }
                                            } catch (error) {
                                                console.error("Error fetching data", error.response?.data || error.message);
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="categories"> </div>
                    <script>
                        const fetchData = async () => {
                            try {
                                const response = await axios.get('http://stock.swiftmore.in/mobileApis/TestCURD_category.php');
                                // console.log(response.data);
                                const rowcontainer = document.getElementById('categories');
                                const { Cat } = response.data;
                                Cat.forEach(cat => {
                                    //here we have to give += if given equal to it will iterate and will show only last card if given += it will append all the cards inside row container
                                    rowcontainer.innerHTML += `<div class="col-md-6 col-lg-3 delete${cat.catId}">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="d-flex align-items-start">
                                                                            <div class="bg-warning-subtle text-warning d-inline-block px-4 py-3 rounded  viewSub">
                                                                                <img src="${cat.catImg}" class="rounded img-fluid">
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
                                                                                            <a  class="dropdown-item" href="javascript:void(0)"
                                                                                                data-bs-toggle="modal"
                                                                                                data-bs-target="#view${cat.catId}">Edit</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a class="dropdown-item sa-confirm" href="javascript:void(0)"
                                                                                                onClick="handleDelete('${cat.catId}','${cat.catName}')">Delete</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mt-5">
                                                                            <h4 class="card-title">${cat.catName}</h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="view${cat.catId}" class="modal fade" tabindex="-1" aria-modal="true" role="dialog">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="text-center mt-2 mb-4">
                                                                                Edit Category
                                                                            </div>
                                                                            <form id="editform" onSubmit="handleFormEdit(event,${cat.catId})" method="post" enctype="multipart/form-data"
                                                                                class="ps-3 pr-3">
                                                                                <input type="text" name="action" id="editaction" value="update" hidden>
                                                                                <input type="text"  id="editcatId${cat.catId}" name="catId" value="${cat.catId}" hidden>
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="inputcom" class="form-label">Name</label>
                                                                                            <input type="text" class="form-control" id="editinputcom${cat.catId}"
                                                                                                placeholder="Category Here" name="catName"
                                                                                                value="${cat.catName}">
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
                                                                                                        id="editinputGroupFile01${cat.catId}" 
                                                                                                        accept=".png, .jpg,.jpeg,image/*" name="catImg"
                                                                                                        onchange="showImage(this, 'edit_img_url${cat.catId}',${cat.catId});">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-xxl-4">
                                                                                        <div class="mb-3">
                                                                                            <div class="mb-3 d-flex justify-content-center">
                                                                                                <div class="mb-3 d-flex justify-content-center">
                                                                                                    <img style="height: 150px; width: 3.5cm; display:none;" id="edit_img_url${cat.catId}"  />
                                                                                                    <img style="height: 150px; width: 3.5cm; display:block;" src="${cat.catImg}" id="hideimage${cat.catId}" />
                                                                                                </div>
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
                                                            </div>`
                                });   
                            } catch (error) {
                                console.error("Error fetching data", error.response?.data || error.message);
                            }
                        }
                        fetchData();
                        const handleFormEdit = async (e,catId) => {//during update we have to pass some thing unique so that the function will get to know 
                            //specifcally which form to update 
                                    try {
                                        e.preventDefault();
                                        const formData = new FormData();//It is optional but recommended when including files in a request 
                                        //When dealing with file uploads (<input type="file">), you cannot directly store the file in a plain JavaScript object. The .files property of a file input is a File object, which needs to be properly encoded for transmission. FormData handles this encoding for you.
                                        const a = document.getElementById(`editinputGroupFile01${catId}`).files[0];
                                        console.log(a);
                                        formData.append('catName', document.getElementById(`editinputcom${catId}`).value);
                                        const name = document.getElementById(`editinputcom${catId}`).value;
                                        console.log(name);
                                        formData.append('catImg', document.getElementById(`editinputGroupFile01${catId}`).files[0]); // Actual file
                                        formData.append('action', document.getElementById('editaction').value);
                                        formData.append('catId', document.getElementById(`editcatId${catId}`).value);
                                        const editPostResponse = await axios.post("http://stock.swiftmore.in/mobileApis/TestCURD_category.php", formData
                                        );
                                        if (editPostResponse.data) {
                                            console.log(editPostResponse.data);
                                            location.reload();
                                        }
                                    } catch (error) {
                                        console.error("Error fetching data", error.response?.data || error.message);
                                    }
                                }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <script>
        const showImage = (imginputelement, imgElementid, hideimgId = 0) => {
            // console.log(imginputelement.files);
            //imginputelement.files .files is required to get the img information in object
            const imgUrl = document.getElementById(imgElementid);
            if (imginputelement.files && imginputelement.files[0]) {
                const filereader = new FileReader();
                filereader.readAsDataURL(imginputelement.files[0]);//It starts reading the selected file asynchronously.This is used to convert the file to base 64 url for  required if you want to display the selected file (image) in the browser as a preview
                filereader.onload = (e) => {//When the file is successfully read:
                    imgUrl.style.display = "block";
                    imgUrl.src = e.target.result;
                    // console.log(e.target.result);
                }
            } else {
                imgUrl.style.display = "none";
            }
            if (hideimgId != 0) {
                const hideImage = document.getElementById(`hideimage${hideimgId}`);
                hideImage.style.display = "none";
            }
        }
        const handleDelete=async (catId,catName)=>{
            console.log(catId,catName);
            const result = await Swal.fire({//wait for promise to resolve
                title: "Are you sure?",
                text: `You want to delete '${catName}' category!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            });
            if (result.isConfirmed) {
                try {
                    const formData = new FormData();
                    formData.append("catId",catId);
                    formData.append("action","delete");
                    // const deletedata={catId,action:'delete'}
                    const response = await axios.post("http://stock.swiftmore.in/mobileApis/TestCURD_category.php", formData);
                    if (response.data.success === 1) {
                        await Swal.fire("Deleted!", "Category has been deleted.", "success");
                        // Remove the deleted category from the DOM
                        // $(`.sa-confirm[data-id='${catId}']`).closest(".col-md-6.col-lg-3").remove();
                        const accessdeleteelement = document.querySelector(`.delete${catId}`);
                        if (accessdeleteelement) {
                        accessdeleteelement.remove();
                        }
                    } else {
                        await Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                    }
                } catch (error) {
                    console.error("Error fetching data", error.response?.data || error.message);
                    await Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                }
            }
        }
    </script>
    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/sidebarmenu.js"></script>
    <script src="./assets/js/app.min.js"></script>
    <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>
</html>