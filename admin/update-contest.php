<?php
session_start();
include 'dbconnection.php';

//Checking session is valid or not
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {

    // for updating contest info    
    if (isset($_POST['Submit'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $rule = $_POST['rule'];
        // $thumbnail = addslashes(file_get_contents($_FILES['thumbnail']['tmp_name']));
        $cid = intval($_GET['cid']);
        $query = mysqli_query($con, "update contest set title='$title' ,content='$content' , start_date='$start_date' , end_date='$end_date' , rule='$rule' where id='$cid'");
        $_SESSION['msg'] = "Cập nhật thành công";
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title>Admin | Cập nhật cuộc thi</title>
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="assets/img/logo.png" />
    </head>

    <body>

        <section id="container">
            <header class="header black-bg">
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
                </div>
                <a href="#" class="logo"><b>Admin Dashboard</b></a>
                <div class="nav notify-row" id="top_menu">



                    </ul>
                </div>
                <div class="top-menu">
                    <ul class="nav pull-right top-menu">
                        <li><a class="logout" href="logout.php">Đăng xuất</a></li>
                    </ul>
                </div>
            </header>
            <aside>
                <div id="sidebar" class="nav-collapse ">
                    <ul class="sidebar-menu" id="nav-accordion">

                        <p class="centered"><a href="#"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                        <h5 class="centered"><?php echo $_SESSION['login']; ?></h5>

                        <li class="mt">
                            <a href="change-password.php">
                                <i class="fa fa-file"></i>
                                <span>Đổi mật khẩu</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="manage-users.php">
                                <i class="fa fa-users"></i>
                                <span>Quản lý người dùng</span>
                            </a>

                        </li>

                        <li class="sub-menu">
                            <a href="manage-contests.php">
                                <i class="fa fa-flag"></i>
                                <span>Quản lý cuộc thi</span>
                            </a>

                        </li>


                    </ul>
                </div>
            </aside>
            <?php $ret = mysqli_query($con, "select * from contest where id='" . $_GET['cid'] . "'");
            while ($row = mysqli_fetch_array($ret)) { ?>
                <section id="main-content">
                    <section class="wrapper">
                        <h3><i class="fa fa-angle-right"></i><?php echo $row['title']; ?></h3>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="content-panel">
                                    <p align="center" style="color:#F00;"><?php echo $_SESSION['msg']; ?><?php echo $_SESSION['msg'] = ""; ?></p>
                                    <form class="form-horizontal style-form" name="form1" method="post" action="" onSubmit="return valid();">
                                        <p style="color:#F00"><?php echo $_SESSION['msg']; ?><?php echo $_SESSION['msg'] = ""; ?></p>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Tiêu đề </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Nội dung</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="content" rows="6"><?php echo $row['content']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Ngày bắt đầu </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="start_date" value="<?php echo $row['start_date']; ?> ">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Ngày kết thúc </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="end_date" value="<?php echo $row['end_date']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Thể lệ </label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="rule" rows="10"><?php echo $row['rule']; ?></textarea>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Thumbnail </label>
                                            <div class="col-sm-10">
                                                <form method="post" enctype="multipart/form-data">
                                                    <?php echo '<img id="preimage" src="data:image/jpeg;base64,' . base64_encode($row[8]) . '" width="210px" height="200px" />'; ?>
                                                    <br><br>
                                                    <input type="file" name="thumbnail" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload" onchange="loadFile(event)">
                                                </form>
                                            </div>
                                        </div> -->

                                        <div style="margin-left:100px;">
                                            <input type="submit" name="Submit" value="Cập nhật" class="btn btn-theme">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php } ?>
                </section>
        </section>

        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="assets/js/common-scripts.js"></script>
        <script>
            $(function() {
                $('select.styled').customSelect();
            });

            function loadFile(event) {
                var output = document.getElementById('preimage');
                output.src = URL.createObjectURL(event.target.files[0]);
            }
        </script>
    </body>

    </html>
<?php } ?>