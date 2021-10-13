<?php

class CourseModel extends Database
{

    protected $table = "course";

    // Lấy ra tất cả các bản ghi
    public function fetchAll()
    {
        $sqlSelect = "SELECT * FROM $this->table 
                        INNER JOIN course_categorys ON $this->table.course_categorys_id = course_categorys.id
                        ORDER BY $this->table.id DESC";

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
        $sqlInsert = "INSERT INTO $this->table ( `course_categorys_id`, `course_name`, `course_description`, `end_date`) 
                        VALUES ( ?, ?, ?, ?)";

        $stmtInsert = $this->conn->prepare($sqlInsert);

        $resultInsert = $stmtInsert->execute($data);

        // kết quả thực thi câu sql insert
        return $resultInsert;
    }

    // tìm kiếm
    public function fetchSearch($name)
    {
        $sql = " SELECT * FROM $this->table WHERE course_name LIKE '%$name%' ORDER BY id DESC";

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