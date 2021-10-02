<?php
// no mvc giống là ngôi nhà có rất nhiều cửa ra vào
// mvc thì có 1 cửa chính để ra vào duy nhất
// index.php là file đầu vào của ứng dụng
// mọi tác vụ thêm sửa xóa đăng nhập đăng ký đều chạy file index.php ngoài cùng

// câu lệnh nạp file
// include , require , include_once , require_once 4 câu lệnh nạp file vào file khác

// khai báo hằng số url của ứng dụng
// tên miền của ứng dụng này
define("SITE_URL", "http://localhost/school/");

// nên nạp đầu tiên
include_once "models/Database.php";

// nạp Function
include_once "models/Function.php";

// nạp các controller vào trong index.php
include_once "controllers/LoginController.php";
include_once "controllers/AdminController.php";

// nạp tiếp các model
include_once "models/AdminModel.php";

// nạp tiếp router.php
include_once "router.php";

$router = new Router();
$router->run();