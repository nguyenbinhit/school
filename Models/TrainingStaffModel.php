<?php
class TrainingStaffModel extends Database
{
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

    // Lấy ra tất cả các bản ghi
    public function getAll()
    {
        $sqlSelect = "SELECT * FROM $this->table";

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
    public function store(array $dataBind)
    {
        $sqlInsert = "INSERT INTO $this->table ( `training_staff_name`, `training_staff_password`, `training_staff_email `, `training_staff_phone`, `level`) 
                        VALUES ( ?, ?, ?, ?, ?)";

        $stmtInsert = $this->conn->prepare($sqlInsert);

        $resultInsert = $stmtInsert->execute($dataBind);

        // kết quả thực thi câu sql insert
        return $resultInsert;
    }
}
