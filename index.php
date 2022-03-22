<?php

session_start();

use App\Controllers\ApartmentsController;
use App\Controllers\ReservationsController;
use App\Controllers\ReviewsController;
use App\Controllers\SignInController;
use App\Controllers\SignOutController;
use App\Controllers\SignUpController;
use App\Controllers\UsersController;
use App\Controllers\HomePageController;
use App\Redirect;
use App\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    $r->addRoute('GET', '/', [HomePageController::class, 'homePage']);
    $r->addRoute('GET', '/users/home', [HomePageController::class, 'userHomePage']);

    // Users
    $r->addRoute('GET', '/users', [UsersController::class, 'index']);
    $r->addRoute('GET', '/users/{id:\d+}', [UsersController::class, 'show']);

    // User SignUp
    $r->addRoute('GET', '/users/signup', [SignUpController::class, 'signup']);
    $r->addRoute('POST', '/users', [SignUpController::class, 'signupUser']);

    // User Login
    $r->addRoute('POST', '/users/signin', [SignInController::class, 'signIn']);
    $r->addRoute('GET', '/users/signin', [SignInController::class, 'signInUser']);

    // User SignOut
    $r->addRoute('GET', '/users/signout', [SignOutController::class, 'signOut']);

    // Apartments
    $r->addRoute('GET', '/apartments', [ApartmentsController::class, 'index']);
    $r->addRoute('GET', '/apartments/{id:\d+}', [ApartmentsController::class, 'show']);

    // Create Apartment
    $r->addRoute('POST', '/apartments', [ApartmentsController::class, 'store']);
    $r->addRoute('GET', '/apartments/create', [ApartmentsController::class, 'create']);

    // Delete Apartment
    $r->addRoute('POST', '/apartments/{id:\d+}/delete', [ApartmentsController::class, 'delete']);

    // Edit Apartment
    $r->addRoute('GET', '/apartments/{id:\d+}/edit', [ApartmentsController::class, 'edit']);
    $r->addRoute('POST', '/apartments/{id:\d+}', [ApartmentsController::class, 'update']);

    // Apartment Reservation
    $r->addRoute('GET', '/apartments/{id:\d+}/reservation', [ReservationsController::class, 'reservation']);
    $r->addRoute('POST', '/apartments/{id:\d+}/confirm', [ReservationsController::class, 'confirm']);

    // Apartment Reviews
    $r->addRoute('POST', '/apartments/{id:\d+}/review', [ReviewsController::class, 'review']);
    $r->addRoute('POST', '/apartments/{nr:\d+}/delete/{id:\d+}', [ReviewsController::class, 'delete']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        var_dump('404 Not Found');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        var_dump('405 Method Not Allowed');
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $routeInfo[1][0];
        $method = $routeInfo[1][1];

        $vars = $routeInfo[2];
        /** @var View $response */
        $response = (new $controller)->$method($vars);

        $loader = new FilesystemLoader('app/Views');
        $twig = new Environment($loader);

        if($response instanceof View) {
            echo $twig->render($response->getPath() . '.twig', $response->getVariables());
        }

        if($response instanceof Redirect) {
            header('Location: ' . $response->getLocation());
            exit;
        }

        break;
}