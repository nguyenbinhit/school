<?php
    class TrainingStaffModel extends Database {
        protected $table = "training_staff";

        public function fetchLogin($email, $password)
        {
            // Câu lệnh SQL
            $sqlLogin = "SELECT * FROM $this->table WHERE training_staff_email = ? AND training_staff_password = ? LIMIT 1";

            // gọi đến DB và truyền vào câu lệnh SQL
            $stmtLogin = $this->conn->prepare($sqlLogin);

            // truyền tham số vào câu lệnh SQL
            $stmtLogin->execute([$email, $password]);

            $resultLogin = $stmtLogin->setFetchMode(PDO::FETCH_OBJ);
            // tổng số bản ghi
            $login = $stmtLogin->fetchObject();

            // trả về bản ghi
            return $login;
        }
    }