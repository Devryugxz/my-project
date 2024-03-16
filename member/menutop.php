<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="../Image/logo-2.png" style="width: 100%; height: 50px;">
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="index.php" aria-current="page">หน้าแรก</a></li>
            <li class="nav-item"><button class="btn btn-outline-dark" type="submit">
                    <form class="d-flex">
                        <a class="nav-link" href="cart.php">
                            <i class="bi bi-basket"></i>
                            ตะกร้าสินค้า
                            <span class="badge bg-dark text-white ms-1 rounded-pill">
                                <?php
                                // ตรวจสอบว่ามีตะกร้าสินค้าหรือไม่
                                if (isset($_SESSION["cart_item"])) {
                                    // นับจำนวนรายการทั้งหมดในตะกร้า
                                    $cart_count = count($_SESSION["cart_item"]);
                                    echo $cart_count;
                                } else {
                                    // ถ้าไม่มีรายการในตะกร้า
                                    echo '0';
                                }
                                ?>
                            </span>
                        </a>
                    </form>
                </button>
            </li>
        </ul>
        <div class="nav-wrapper">
            <div class="container">
                <div class="d-flex bd-highlight">
                    <?php

                    if (isset($_SESSION['customer'])) {
                        $c_id = $_SESSION['customer'];
                    }
                    try {
                        $stmt = $conn->query("SELECT * FROM tb_customer WHERE c_id = $c_id");
                        $stmt->execute();
                        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
                        // $m_img = $userData['m_img'];
                    } catch (PDOException $e) {
                        echo "error: " . $e->getMessage();
                    }

                    ?>

                    <div class="d-flex bd-highlight mx-4" style="align-items: center;">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../m_img/<?php echo $m_img ?>" alt="" width="32" height="32" class="rounded-circle">
                            <?php echo $userData['username'] ?>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="profile.php">ข้อมูลส่วนตัว</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="my_purchase.php">การซื้อของฉัน</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="logout.php" class="dropdown-item">ออกจากระบบ</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </header>
</div>