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
                                    <h4 class="mb-4 mb-sm-0 card-title">Sub Category</h4>
                                    <button type="button" class="btn bg-primary-subtle text-primary"
                                        data-bs-toggle="modal" data-bs-target="#create">
                                        <span class="fs-4 me-1">+</span>
                                        Add New Sub Category
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
                                                    <input type="text" class="form-control" id="subcatinput"
                                                        placeholder="Category Here" name="subCatName">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="inputcom" class="form-label">Growth
                                                        Percentage (In %)</label>
                                                    <input type="text" class="form-control" id="growthPercentage"
                                                        placeholder="Percentage Here" name="growthPercentage"
                                                        oninput="this.value = this.value.match(/^\d*\.?\d*/)[0]">
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
                                                                name="subCatImg" onchange="showImage(this, 'img_url');">
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
                                                const data = JSON.parse(localStorage.getItem('subcatid'));
                                                console.log(data.subcatid);
                                                const formData = new FormData();//It is optional but recommended when including files in a request 
                                                //When dealing with file uploads (<input type="file">), you cannot directly store the file in a plain JavaScript object. The .files property of a file input is a File object, which needs to be properly encoded for transmission. FormData handles this encoding for you.
                                                const a = document.getElementById('inputGroupFile01').files[0];
                                                console.log(a);
                                                formData.append('subcatid',data.subcatid);
                                                formData.append('subCatName', document.getElementById('subcatinput').value);
                                                formData.append('subCatImg', document.getElementById('inputGroupFile01').files[0]); // Actual file
                                                formData.append('growthPercentage', document.getElementById('growthPercentage').value);
                                                formData.append('action','create');
                                                const addPostResponse = await axios.post("http://stock.swiftmore.in/mobileApis/TestCURD_subcategory.php", formData
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
                    <div class="row" id="subcategories"> </div>
                    <script>
                        const fetchData = async () => {
                            try {
                                const data = JSON.parse(localStorage.getItem('catId'));
                                const response = await axios.get(`http://stock.swiftmore.in/mobileApis/TestCURD_subcategory.php?catId=${data.catId}`);
                                console.log(response.data);
                                const rowcontainer = document.getElementById('subcategories');
                                const { subCat } = response.data;
                                const subCats = subCat;
                                // console.log(subCats);
                                try {
                                subCats.forEach(subcat => {
                                    //here we have to give += if given equal to it will iterate and will show only last card if given += it will append all the cards inside row container
                                    rowcontainer.innerHTML += `<div class="col-md-6 col-lg-3 delete${subcat.subCatId}">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="d-flex align-items-start">
                                                                            <div class="bg-warning-subtle text-warning d-inline-block px-4 py-3 rounded " >
                                                                                <img src="${subcat.subCatImg}" class="rounded img-fluid">
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
                                                                                                data-bs-target="#view${subcat.subCatId}">Edit</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a class="dropdown-item sa-confirm" href="javascript:void(0)"
                                                                                                onClick="handleDelete('${subcat.subCatId}','${subcat.subCatName}')">Delete</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mt-5">
                                                                            <h4 class="card-title">${subcat.subCatName}</h4>
                                                                            <h6 class="text-muted">${subcat.growthPercentage} %</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="view${subcat.subCatId}" class="modal fade" tabindex="-1" aria-modal="true" role="dialog">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="text-center mt-2 mb-4">
                                                                                Edit Category
                                                                            </div>
                                                                            <form id="editform" onSubmit="handleFormEdit(event,${subcat.subCatId})" method="post" enctype="multipart/form-data"
                                                                                class="ps-3 pr-3">
                                                                                <input type="text" name="action" id="editaction" value="update" hidden>
                                                                                <input type="text"  id="editsubcatid${subcat.subCatId}" name="subcatid" value="${subcat.subCatId}" hidden>
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="inputcom" class="form-label">Name</label>
                                                                                            <input type="text" class="form-control" id="editinputcom${subcat.subCatId}"
                                                                                                placeholder="Category Here" name="catName"
                                                                                                value="${subcat.subCatName}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="inputcom" class="form-label">Growth
                                                                                                Percentage (In %)</label>
                                                                                            <input type="text" class="form-control" id="editpercentinputcom${subcat.subCatId}"
                                                                                                placeholder="Percentage Here" name="growthPercentage"
                                                                                                value="${subcat.growthPercentage}" oninput="handleInput(${subcat.subCatId})""
                                                                                                >
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
                                                                                                        id="editinputGroupFile01${subcat.subCatId}" 
                                                                                                        accept=".png, .jpg,.jpeg,image/*" name="catImg"
                                                                                                        onchange="showImage(this, 'edit_img_url${subcat.subCatId}',${subcat.subCatId});">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-xxl-4">
                                                                                        <div class="mb-3">
                                                                                            <div class="mb-3 d-flex justify-content-center">
                                                                                                <div class="mb-3 d-flex justify-content-center">
                                                                                                    <img style="height: 150px; width: 3.5cm; display:none;" id="edit_img_url${subcat.subCatId}"  />
                                                                                                    <img style="height: 150px; width: 3.5cm; display:block;" src="${subcat.subCatImg}" id="hideimage${subcat.subCatId}" />
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
                                const addsubcategories = document.getElementById('subcategories');
                                addsubcategories.innerHTML=`<h1 class="fw-10 fs-7 text-center">No sub categories added</h1>`;
                                } 
                            } catch (error) {
                                console.error("Error fetching data", error.response?.data || error.message);
                            }
                        }
                        fetchData();
                        const handleInput=(subcatid)=>{
                            const inputElement = document.getElementById(`editpercentinputcom${subcatid}`);
                            inputElement.addEventListener('input', (event) => {
                            const value = event.target.value.match(/^\d*\.?\d*/)[0];
                            event.target.value = value;//input value must follow  the required rule
                        
                        });
                      }
                       
                        const handleFormEdit = async (e,subcatid) => {//during update we have to pass some thing unique so that the function will get to know 
                            //specifcally which form to update 
                                    try {
                                        console.log(subcatid);
                                        e.preventDefault();
                                        const data = JSON.parse(localStorage.getItem('catId'));
                                        const formData = new FormData();//It is optional but recommended when including files in a request 
                                        //When dealing with file uploads (<input type="file">), you cannot directly store the file in a plain JavaScript object. The .files property of a file input is a File object, which needs to be properly encoded for transmission. FormData handles this encoding for you.
                                        const a = document.getElementById(`editinputGroupFile01${subcatid}`).files[0];
                                        console.log(a);
                                        formData.append('action', 'update');
                                        formData.append('catId',data.catId)
                                        formData.append('subCatId', document.getElementById(`editsubcatid${subcatid}`).value);
                                        formData.append('growthPercentage', document.getElementById(`editpercentinputcom${subcatid}`).value);
                                        formData.append('subCatName', document.getElementById(`editinputcom${subcatid}`).value);
                                        const name = document.getElementById(`editinputcom${subcatid}`).value;
                                        console.log(name);
                                        formData.append('subCatImg', document.getElementById(`editinputGroupFile01${subcatid}`).files[0]); // Actual file
                                        const editPostResponse = await axios.post("http://stock.swiftmore.in/mobileApis/TestCURD_subcategory.php", formData
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
               }
            } else {
                imgUrl.style.display = "none";
            }
            if (hideimgId != 0) {
                const hideImage = document.getElementById(`hideimage${hideimgId}`);
                hideImage.style.display = "none";
            }
        }
        const handleDelete=async (subcatid,subCatName)=>{
            console.log(subcatid,subCatName);
            const result = await Swal.fire({//wait for promise to resolve
                title: "Are you sure?",
                text: `You want to delete '${subCatName}' category!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            });
            if (result.isConfirmed) {
                try {
                    const formData = new FormData();
                    formData.append("action","delete");
                    formData.append("subCatId",subcatid);
                    // const deletedata={subcatid,action:'delete'}
                    const deleteresponse = await axios.post("http://stock.swiftmore.in/mobileApis/TestCURD_subcategory.php", formData);
                    if (deleteresponse.data.success === 1) {
                        console.log(deleteresponse.data);
                        await Swal.fire("Deleted!", "Category has been deleted.", "success");
                        // Remove the deleted category from the DOM
                        // $(`.sa-confirm[data-id='${subcatid}']`).closest(".col-md-6.col-lg-3").remove();
                        const accessdeleteelement = document.querySelector(`.delete${subcatid}`);
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
