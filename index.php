<?php
session_start();
require_once('controller/dbconnection.php');

$sql_get_data = "SELECT * FROM contest";
$result = $con->query($sql_get_data)->fetch_all();

if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Photogram - Photo Contest</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="images/logo.png" />
        <!-- Core theme CSS (includes Bootstrap)-->

        <link href="css/style-index.css?v=<?php echo time(); ?>" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="font-awesome/css/all.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <nav id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-danger">
                <div class="container">
                    <a class="navbar-brand" href="index.php" style="font-weight:bold;">PHOTOGRAM</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="nav-link" href="about.php"><i class="fas fa-address-card fa-lg"></i>&ensp; Về chúng tôi </a></li>
                            <li class="nav-item"><a class="nav-link" href="#contestN"><i class="fas fa-camera fa-lg"></i>&ensp; Cuộc thi </a></li>
                            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-newspaper fa-lg"></i>&ensp; Tin tức </a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle fa-lg"></i>
                                    &nbsp; <?php echo ($_SESSION['name']) ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Trang cá nhân</a>
                                    <a class="dropdown-item" href="#">Sửa thông tin</a>
                                    <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- navbar-collapse.// -->
                </div> <!-- container-fluid.// -->
            </nav>
        </header>
        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <!-- Heading Row-->
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="images/background.jpg" alt="Intro" /></div>
                <div class="col-lg-5">
                    <h1 class="font-weight-light">Photogram - Chinh phục những thử thách</h1>
                    <p>Trong cuộc sống, có rất nhiều khoảnh khắc đặc biệt mà chúng ta muốn lưu giữ. Đơn giản chỉ là 1 tách cà phê buổi sáng đậm đà hơn hàng ngày hay một chiếc lá vàng khẽ rơi nghiêng qua khung cửa… Nhưng đặc biệt hơn cả là những điều đó gợi cho chúng ta một cảm giác thi vị cùng 1 chút sâu lắng. Mỗi người với những suy nghĩ và cảm nhận khác nhau lại làm nên sắc màu đa dạng của cuộc sống.</p>
                    <a class="btn btn-danger" href="#">Tìm hiểu</a>
                </div>
            </div>
            <!-- Call to Action-->
            <div id="contestN" class="card text-white bg-danger my-2 py-1 text-center">
                <div class="card-body">
                    <p class="text-white m-0" style="font-size:xx-large;">Cuộc thi đang diễn ra</p>
                </div>
            </div>
            <!-- Content Row-->
            <div class="row gx-4 gx-lg-5">
                <?php foreach ($result as $item) : ?>
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <?php echo '<img class="card-img-top" src="data:image/jpeg;base64,' . base64_encode($item[8]) . '"/>'; ?>
                            <div class="card-body">
                                <h2 class="card-title"><?php echo $item[1]; ?></h2>
                                <p class="card-text"><?php echo $item[2]; ?></p>
                            </div>
                            <div class="card-footer"><a class="btn btn-danger btn-sm" href="#!">Tham gia</a></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Call to Action-->
            <div class="card text-white bg-danger my-2 py-1 text-center">
                <div class="card-body">
                    <p class="text-white m-0" style="font-size:xx-large;">Bức ảnh tiêu biểu</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="gal">
                        <a class="nhat" href="images/1.jpg"><img src="images/1.jpg" alt="" srcset=""></a>
                        <a class="nhat" href="images/2.jpg"><img src="images/2.jpg" alt="" srcset=""></a>
                        <a class="nhat" href="images/3.jpg"><img src="images/3.jpg" alt="" srcset=""></a>
                        <a class="nhat" href="images/4.jpg"><img src="images/4.jpg" alt="" srcset=""></a>
                        <a class="nhat" href="images/5.jpg"><img src="images/5.jpg" alt="" srcset=""></a>
                        <a class="nhi" href="images/6.jpg"><img src="images/6.jpg" alt="" srcset=""></a>
                        <a class="nhi" href="images/7.jpg"><img src="images/7.jpg" alt="" srcset=""></a>
                        <a class="nhi" href="images/8.jpg"><img src="images/8.jpg" alt="" srcset=""></a>
                    </div>

                </div>
            </div>
        </div>
        </div>


        <script src="js/navbar.js"></script>
    </body>
    <footer class="py-5 bg-danger">
        <div class="container px-4 px-lg-5">
            <p class="m-0 text-center text-white">Copyright &copy; Photogram 2021</p>
        </div>
    </footer>

    </html>
<?php } ?>