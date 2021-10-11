<?php
    class TraineeController {
        public function index()
        {
            include_once "Views/Trainee/index.php";
        }
        
        public function login()
        {
            $data = [
                'email'    => postInput("email"),
                'password' => md5(postInput("password"))
            ];

            $error = [];

            if($_SERVER["REQUEST_METHOD"] == "POST") {
                // check dữ liệu người dùng nhập vào
                if($data['email'] == '') 
                {
                    $error['email'] = " Email không được để trống ! ";
                }
        
                // check dữ liệu người dùng nhập vào
                if($data['password'] == '') 
                {
                    $error['password'] = " Mật khẩu không được để trống ! ";
                }

                if(empty($error)) 
                {
                    $trainee = new TraineeModel();

                    // gửi và nhận lại dữ liệu trả về từ database
                    $is_check = $trainee->login($data['email'], $data['password']);

                    if(is_object($is_check) && $is_check->id > 0) 
                    { 
                        $_SESSION['admin_email'] = $is_check->trainee_email;
                        $_SESSION['admin_id'] = $is_check->id;

                        // trả về trang tổng 
                        $domain =  SITE_URL."index.php?controller=base&action=dashboard";
                        header("Location: $domain");
                        exit;
                    }
                    else
                    {
                        $domain =  SITE_URL . "index.php?controller=base&action=error_401";
                        header("Location: $domain");
                        exit;
                    }
                }
            }
        }
    }