<?php
// session_start();
class TrainingStaffController
{
    public function index()
    {
        // Gọi tới model
        $trainingStaffModel = new TrainingStaffModel();

        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];

            $users = $trainingStaffModel->search($keyword);
        } else {
            // Gọi hàm
            $users = $trainingStaffModel->getAll();
        }

        // Trả về view
        include_once "Views/TrainingStaff/index.php";
    }

    public function login()
    {
        $data = [
            'email'    => postInput("email"),
            'password' => md5(postInput("password"))
        ];

        $error = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // check dữ liệu người dùng nhập vào
            if ($data['email'] == '') {
                $error['email'] = " Email không được để trống ! ";
            }

            // check dữ liệu người dùng nhập vào
            if ($data['password'] == '') {
                $error['password'] = " Mật khẩu không được để trống ! ";
            }

            if (empty($error)) {
                $training = new TrainingStaffModel();

                // gửi và nhận lại dữ liệu trả về từ database
                $is_check = $training->fetchLogin($data['email'], $data['password']);

                if (is_object($is_check) && $is_check->id > 0) {

                    $_SESSION['admin_email'] = $is_check->training_staff_email;
                    $_SESSION['admin_id'] = $is_check->id;
                    $_SESSION['level'] = $is_check->level;

                    // trả về trang tổng 
                    $domain =  SITE_URL . "index.php?controller=base&action=dashboard";
                    header("Location: $domain");
                    exit;
                } else {
                    $domain =  SITE_URL . "index.php?controller=base&action=error_401";
                    header("Location: $domain");
                    exit;
                }
            }
        }
    }

    public function create()
    {
        include_once "Views/TrainingStaff/create.php";
    }

    // lưu data khi thêm mới
    public function store()
    {
        $trainingStaffModel = new TrainingStaffModel();

        $data = [];

        $data[] = postInput('name');
        $data[] = md5(postInput('password'));
        $data[] = postInput('email');
        $data[] = postInput('phone');
        $data[] = postInput('levelRadio');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $error = [];

            if (postInput('name') == '') {
                $_SESSION['error_name'] = $error['name'] = "Mời bạn nhập đầy đủ họ và tên ";

                $domain =  SITE_URL . "index.php?controller=trainingStaff&action=create";
                header("Location: $domain");
                exit;
            }

            if (postInput('email') == '') {
                $_SESSION['error_email'] = $error['email'] = "Mời bạn nhập email ";

                $domain =  SITE_URL . "index.php?controller=trainingStaff&action=create";
                header("Location: $domain");
                exit;
            } else {
                $is_check = $trainingStaffModel->fetchEmail($data['email']);
                if ($is_check != NULL) {
                    $_SESSION['error_email'] = $error['email'] = " Đã tồn tại đại chỉ email ! ";

                    $domain =  SITE_URL . "index.php?controller=trainingStaff&action=create";
                    header("Location: $domain");
                    exit;
                }
            }

            if (postInput('phone') == '') {
                $_SESSION['error_phone'] = $error['phone'] = "Mời bạn nhập số điện thoại ";

                $domain =  SITE_URL . "index.php?controller=trainingStaff&action=create";
                header("Location: $domain");
                exit;
            }

            if (postInput('password') == '') {
                $_SESSION['error_password'] = $error['password'] = "Mời bạn nhập mật khẩu ";

                $domain =  SITE_URL . "index.php?controller=trainingStaff&action=create";
                header("Location: $domain");
                exit;
            }

            //error trống có nghĩa ko có lỗi
            if (empty($error)) {

                $trainingStaffModel->store($data);

                if ($trainingStaffModel) {
                    $_SESSION['success'] = " Successfully added new ";

                    $domain =  SITE_URL . "index.php?controller=trainingStaff&action=index";
                    header("Location: $domain");
                    exit;
                } else {
                    $_SESSION['error'] = " Add new failure ";

                    $domain =  SITE_URL . "index.php?controller=trainingStaff&action=index";
                    header("Location: $domain");
                    exit;
                }
            }
        }
    }

    public function detail()
    {
        $id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

        $trainingStaffModel = new TrainingStaffModel();

        $user = $trainingStaffModel->fetchOne($id);

        include_once "Views/TrainingStaff/detail.php";
    }

    public function edit()
    {
        $id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
        // khởi tạo model
        $trainingStaffModel = new TrainingStaffModel();
        // lấy data từ model
        $user = $trainingStaffModel->fetchOne($id);

        include_once "Views/TrainingStaff/edit.php";
    }

    public function update()
    {
        $trainingStaffModel = new TrainingStaffModel();

        $data = [];

        $data[] = postInput('name');
        $data[] = md5(postInput('password'));
        $data[] = postInput('email');
        $data[] = postInput('phone');
        $data[] = postInput('levelRadio');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $error = [];

            if (postInput('name') == '') {
                $_SESSION['error_name'] = $error['name'] = "Mời bạn nhập đầy đủ họ và tên ";

                $domain =  SITE_URL . "index.php?controller=trainingStaff&action=edit";
                header("Location: $domain");
                exit;
            }

            if (postInput('email') == '') {
                $_SESSION['error_email'] = $error['email'] = "Mời bạn nhập email ";

                $domain =  SITE_URL . "index.php?controller=trainingStaff&action=edit";
                header("Location: $domain");
                exit;
            } else {
                $is_check = $trainingStaffModel->fetchEmail($data['email']);
                if ($is_check != NULL) {
                    $_SESSION['error_email'] = $error['email'] = " Đã tồn tại đại chỉ email ! ";

                    $domain =  SITE_URL . "index.php?controller=trainingStaff&action=edit";
                    header("Location: $domain");
                    exit;
                }
            }

            if (postInput('phone') == '') {
                $_SESSION['error_phone'] = $error['phone'] = "Mời bạn nhập số điện thoại ";

                $domain =  SITE_URL . "index.php?controller=trainingStaff&action=edit";
                header("Location: $domain");
                exit;
            }

            if (postInput('password') == '') {
                $_SESSION['error_password'] = $error['password'] = "Mời bạn nhập mật khẩu ";

                $domain =  SITE_URL . "index.php?controller=trainingStaff&action=edit";
                header("Location: $domain");
                exit;
            }

            //error trống có nghĩa ko có lỗi
            if (empty($error)) {

                $trainingStaffModel->fetchUpdate($data);

                if ($trainingStaffModel) {
                    $_SESSION['success'] = " Update successful ";

                    $domain =  SITE_URL . "index.php?controller=trainingStaff&action=index";
                    header("Location: $domain");
                    exit;
                } else {
                    $_SESSION['error'] = " Update failed ";

                    $domain =  SITE_URL . "index.php?controller=trainingStaff&action=index";
                    header("Location: $domain");
                    exit;
                }
            }
        }
    }
}
