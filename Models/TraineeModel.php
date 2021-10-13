<?php
class TraineeModel extends Database
{
    protected $table = "trainee";

    public function login($email, $password)
    {
        $sqlLogin = "SELECT * FROM $this->table WHERE trainee_email = ? AND trainee_password = ? LIMIT 1";

        $stmtLogin = $this->conn->prepare($sqlLogin);

        $stmtLogin->execute([$email, $password]);

        $resultLogin = $stmtLogin->setFetchMode(PDO::FETCH_OBJ);
        // tổng số bản ghi
        $login = $stmtLogin->fetchObject();

        return $login;
    }

    // check trùng email
    public function fetchEmail($email)
    {
        $sql = "SELECT * FROM $this->table WHERE trainee_email = ? LIMIT 1";

        $stmtEmail = $this->conn->prepare($sql);

        $stmtEmail->execute([$email]);

        $result = $stmtEmail->setFetchMode(PDO::FETCH_OBJ);

        $email = $stmtEmail->fetchObject();

        return $email;
    }

    // Lấy ra tất cả các bản ghi
    public function fetchAll()
    {
        $sqlSelect = "SELECT * FROM $this->table ORDER BY id DESC";

        $stmt = $this->conn->prepare($sqlSelect);

        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_OBJ);

        $users = $stmt->fetchAll();

        return $users;
    }

    // lưu mới 1 bản ghi
    // hàm là tập hợp các câu lệnh để thực hiện 1 chức năng
    // hàm có input và output
    // input là tham số
    // output là return cuối hàm
    public function fetchStore(array $data)
    {
        $sqlInsert = "INSERT INTO $this->table ( `trainee_name`, `trainee_email`, `trainee_password`, `trainee_sex`, `trainee_phone`, `age`) 
                        VALUES ( ?, ?, ?, ?, ?, ?)";

        $stmtInsert = $this->conn->prepare($sqlInsert);

        $resultInsert = $stmtInsert->execute($data);

        // kết quả thực thi câu sql insert
        return $resultInsert;
    }

    // tìm kiếm
    public function fetchSearch($name)
    {
        $sql = " SELECT * FROM $this->table WHERE trainee_name LIKE '%$name%' OR age LIKE '%$name%' ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_OBJ);

        $users = $stmt->fetchAll();

        return $users;
    }

    // detail
    public function fetchOne($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = ? LIMIT 1";

        $stmtUser = $this->conn->prepare($sql);

        $stmtUser->execute([$id]);

        $result = $stmtUser->setFetchMode(PDO::FETCH_OBJ);

        $user = $stmtUser->fetchObject();

        return $user;
    }

    // Delete
    public function fetchDelete($id)
    {
        $sqlDelete = "DELETE FROM $this->table WHERE `id` = ?";

        $stmtDelete = $this->conn->prepare($sqlDelete);

        $resultDelete = $stmtDelete->execute([$id]);

        // output
        return $resultDelete;
    }
}
