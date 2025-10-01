<?php
class HomeController{
    public function login(){
        require __DIR__.'/../views/login.php';
    }
    public function rooms(){
        require __DIR__.'/../views/rooms.php';
    }
    public function mybookings(){
        require __DIR__.'/../views/mybookings.php';
    }
    public function viewdetails(){
        require __DIR__.'/../views/viewdetails.php';
    }
    public function authenticate(){
        require __DIR__.'/../models/authenticate.php';
    }
    public function logout(){
        session_start();
        session_destroy();
        header('Location: /rmsminicapstone/login');
        exit;
    }
  public function dashboard(){
    require __DIR__.'/../admin/dashboard.php';
    }

    public function bookroom(){
        require __DIR__.'/../models/bookroom.php';
    }
    public function filterrooms(){
        require __DIR__.'/../views/filterrooms.php';
    }
}