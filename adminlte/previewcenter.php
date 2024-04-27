<?php
include('includes/header.php');
include('includes/navbar.php');

require_once 'config/db.php';

if (!isset($_SESSION['seller'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header("location: ../login.php");
}
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">หน้าร้านของฉัน</h1>

            </div>


            <section">
                <div class="container-fluid pb-5">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="img/logo.png" class="rounded-circle img-fluid" style="width: 150px;">
                                    <h5 class="my-3">ชื่อร้าน</h5>
                                    <p class="text-muted mb-1">หมายเลขสมาชิก</p>
                                    <p class="text-muted mb-4">เข้าร่วมเมื่อ xx/xx/xxxx</p>

                                </div>
                            </div>
                            <div class="card mb-4 mb-lg-0">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush rounded-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <p class="mb-0">ช่องทางการจัดส่ง</p>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <img src="img/icon-kerry-express.png" style="width: 50px;">
                                            <p class="mb-0">Kerry Express</p>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <img src="img/jtexpress.jpg" style="width: 50px;">
                                            <p class="mb-0">J&T Express</p>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <img src="img/Flash-express.jpg" style="width: 50px;">
                                            <p class="mb-0">Flash Express</p>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <img src="img/ThailandPost_Logo.png" style="width: 50px;">
                                            <p class="mb-0">ไปรษณีย์ไทย</p>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <img src="img/other.png" style="width: 30px;">
                                            <p class="mb-0">อื่นๆ</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">ช่องทางการติดต่อ</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">ชื่อ</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">example</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">อีเมล์</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">example@example.com</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">เบอร์โทรศัพท์</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">xxx-xxxxxxx</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">ที่อยู่</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">example</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="card mb-4 mb-md-0">
                                        <div class="card-body">
                                            <section>
                                                <div>
                                                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                                                        <div class="col mb-5">
                                                            <div class="card h-100">
                                                                <!-- Product image-->
                                                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                                                <!-- Product details-->
                                                                <div class="card-body p-4">
                                                                    <div class="text-center">
                                                                        <!-- Product name-->
                                                                        <h5 class="fw-bolder">Product Name</h5>
                                                                        <!-- Product price-->
                                                                        ราคาต่อหน่วย บาท/กก.
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col mb-5">
                                                            <div class="card h-100">
                                                                <!-- Sale badge-->
                                                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                                                <!-- Product image-->
                                                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                                                <!-- Product details-->
                                                                <div class="card-body p-4">
                                                                    <div class="text-center">
                                                                        <!-- Product name-->
                                                                        <h5 class="fw-bolder">Product Name</h5>
                                                                        <!-- Product reviews-->
                                                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                        </div>
                                                                        <!-- Product price-->
                                                                        <span class="text-muted text-decoration-line-through">ราคาต่อหน่วย
                                                                            บาท/กก.</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col mb-5">
                                                            <div class="card h-100">
                                                                <!-- Sale badge-->
                                                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                                                <!-- Product image-->
                                                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                                                <!-- Product details-->
                                                                <div class="card-body p-4">
                                                                    <div class="text-center">
                                                                        <!-- Product name-->
                                                                        <h5 class="fw-bolder">Product Name</h5>
                                                                        <!-- Product price-->
                                                                        <span class="text-muted text-decoration-line-through">ราคาต่อหน่วย
                                                                            บาท/กก.</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col mb-5">
                                                            <div class="card h-100">
                                                                <!-- Product image-->
                                                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                                                <!-- Product details-->
                                                                <div class="card-body p-4">
                                                                    <div class="text-center">
                                                                        <!-- Product name-->
                                                                        <h5 class="fw-bolder">Product Name</h5>
                                                                        <!-- Product reviews-->
                                                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                        </div>
                                                                        <!-- Product price-->
                                                                        ราคาต่อหน่วย บาท/กก.
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col mb-5">
                                                            <div class="card h-100">
                                                                <!-- Sale badge-->
                                                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                                                <!-- Product image-->
                                                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                                                <!-- Product details-->
                                                                <div class="card-body p-4">
                                                                    <div class="text-center">
                                                                        <!-- Product name-->
                                                                        <h5 class="fw-bolder">Product Name</h5>
                                                                        <!-- Product price-->
                                                                        <span class="text-muted text-decoration-line-through">ราคาต่อหน่วย
                                                                            บาท/กก.</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col mb-5">
                                                            <div class="card h-100">
                                                                <!-- Product image-->
                                                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                                                <!-- Product details-->
                                                                <div class="card-body p-4">
                                                                    <div class="text-center">
                                                                        <!-- Product name-->
                                                                        <h5 class="fw-bolder">Product Name</h5>
                                                                        <!-- Product price-->
                                                                        ราคาต่อหน่วย บาท/กก.
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col mb-5">
                                                            <div class="card h-100">
                                                                <!-- Sale badge-->
                                                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                                                <!-- Product image-->
                                                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                                                <!-- Product details-->
                                                                <div class="card-body p-4">
                                                                    <div class="text-center">
                                                                        <!-- Product name-->
                                                                        <h5 class="fw-bolder">Product Name</h5>
                                                                        <!-- Product reviews-->
                                                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                        </div>
                                                                        <!-- Product price-->
                                                                        <span class="text-muted text-decoration-line-through">ราคาต่อหน่วย
                                                                            บาท/กก.</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col mb-5">
                                                            <div class="card h-100">
                                                                <!-- Product image-->
                                                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                                                <!-- Product details-->
                                                                <div class="card-body p-4">
                                                                    <div class="text-center">
                                                                        <!-- Product name-->
                                                                        <h5 class="fw-bolder">Product Name</h5>
                                                                        <!-- Product reviews-->
                                                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                            <div class="bi-star-fill"></div>
                                                                        </div>
                                                                        <!-- Product price-->
                                                                        ราคาต่อหน่วย บาท/กก.
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </section>

        </div>
    </div>
    <!-- End of Page Wrapper -->


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>