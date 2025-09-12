<?php
$page = $_GET['page'] ?? 'login';

require_once __DIR__."/controllers/HomeController.php";
$controller = new HomeController();

switch($page){
        case 'login':
        $controller->login();
        break;
    case'home':
        $controller->rooms();
        break;
    case'mybookings':
        $controller->mybookings();
        break;
    case'viewdetails':
        $controller->viewdetails();
        break;

    default:
    http_response_code(404);
    echo "404 Not Found";
    break;
}
