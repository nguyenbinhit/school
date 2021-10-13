<?php
class CourseController
{
    public function index()
    {
        // Gọi tới model
        $courseModel = new CourseModel();

        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];

            $course = $courseModel->fetchSearch($keyword);
        } else {
            // Gọi hàm
            $course = $courseModel->fetchAll();
        }

        // Trả về view
        include_once "Views/Course/index.php";
    }

    public function create()
    {
        $courseCategoryModel = new CourseCategoryModel();

        $courseCategories = $courseCategoryModel->fetchAll();

        include_once "Views/Course/create.php";
    }
}
