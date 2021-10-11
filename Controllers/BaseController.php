<?php 
    class BaseController {
        public function index()
        {
            include_once "Views/index.php";
        }

        public function error_401()
        {
            include_once "Views/error-401.php";
        }
    }