<?php

class CourseModel extends Database
{

    protected $table = "course";

    // Lấy ra tất cả các bản ghi
    public function fetchAll()
    {
        $sqlSelect = "SELECT $this->table.id, $this->table.course_categorys_id, $this->table.course_name, $this->table.course_description, $this->table.end_date,
                        course_categorys.category_name, course_categorys.category_description
                        FROM $this->table 
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

    public function fetchCheck($name)
    {
        $sql = "SELECT * FROM $this->table WHERE course_name = ? LIMIT 1";

        $stmtCourseCategory = $this->conn->prepare($sql);

        $stmtCourseCategory->execute([$name]);

        $result = $stmtCourseCategory->setFetchMode(PDO::FETCH_OBJ);

        $name = $stmtCourseCategory->fetchObject();

        return $name;
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
        $sqlCourse = "SELECT * FROM $this->table WHERE id = ? LIMIT 1";
        $stmtCourse = $this->conn->prepare($sqlCourse);
        $stmtCourse->execute([$id]);
        $result = $stmtCourse->setFetchMode(PDO::FETCH_OBJ);
        $course = $stmtCourse->fetchObject();

        $sqlTrainer = "SELECT * FROM trainer WHERE course_id = ? ";
        $stmtTrainer = $this->conn->prepare($sqlTrainer);
        $stmtTrainer->execute([$id]);
        $result1 = $stmtTrainer->setFetchMode(PDO::FETCH_OBJ);
        $trainer = $stmtTrainer->fetchObject();

        $sqlTrainee = "SELECT * FROM trainee WHERE course_id = ? ORDER BY id DESC";
        $stmtTrainee = $this->conn->prepare($sqlTrainee);
        $stmtTrainee->execute([$id]);
        $result2 = $stmtTrainee->setFetchMode(PDO::FETCH_OBJ);
        $trainee = $stmtTrainee->fetchAll();

        $sqlCourse_categorys = "SELECT * FROM $this->table INNER JOIN course_categorys ON $this->table.course_categorys_id = course_categorys.id WHERE $this->table.id = ?";
        $stmtCourse_categorys = $this->conn->prepare($sqlCourse_categorys);
        $stmtCourse_categorys->execute([$id]);
        $result3 = $stmtCourse_categorys->setFetchMode(PDO::FETCH_OBJ);
        $course_categorys = $stmtCourse_categorys->fetchObject();

        $data = [ "course" => $course, "trainer" => $trainer, "trainee" => $trainee, "course_categorys" => $course_categorys];

        return $data;
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
