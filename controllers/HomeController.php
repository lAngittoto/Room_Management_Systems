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

}