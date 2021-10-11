<?php
class TrainingStaffController
{
    public function index()
    {
        // Gọi tới model
        $trainingStaff = new TrainingStaffModel();

        // Gọi hàm
        $users = $trainingStaff->getAll();

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
                    $domain =  SITE_URL."index.php?controller=base&action=dashboard";
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
}
