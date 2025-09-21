<?php
$page = $_GET['page'] ?? 'login';

require_once __DIR__."/controllers/HomeController.php";
$controller = new HomeController();

switch($page){
        case 'login':
        $controller->login();
        break;
    case'rooms':
        $controller->rooms();
        break;
    case'mybookings':
        $controller->mybookings();
        break;
    case'viewdetails':
        $controller->viewdetails();
        break;
    case'authenticate':
    $controller->authenticate();
    break;
    case'logout':
        $controller->logout();
    break;
    case 'dashboard':
        $controller->dashboard();
    break;
    case 'bookroom':
        $controller->bookroom();
    default:
    http_response_code(404);
    echo "404 Not Found";
    break;
}
