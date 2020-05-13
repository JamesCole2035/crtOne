<?php declare(strict_types=1);

use App\MainController;
use Symfony\Component\HttpFoundation\{Request, Session\Session};
use Symfony\Component\Serializer\{Encoder\JsonEncoder, Normalizer\ObjectNormalizer, Serializer};
use Twig\{Environment, Extension\DebugExtension, Loader\FilesystemLoader};

require \dirname(__DIR__) . '/vendor/autoload.php';

$_SERVER['APP_DEBUG'] = \filter_var(($_ENV['APP_DEBUG'] ?? $_SERVER['APP_DEBUG'] ?? null) ?? '0', FILTER_VALIDATE_BOOLEAN);
$_SERVER['APP_ENV'] = ($_ENV['APP_ENV'] ?? $_SERVER['APP_ENV'] ?? null) ?? 'dev';

$session = new Session();
$session->start();

$request = Request::createFromGlobals();
$request->setSession($session);

$serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);

$loader = new FilesystemLoader(\dirname(__DIR__) . '/templates');
$twig = new Environment($loader, [
    'cache' => \dirname(__DIR__) . '/cache',
    'debug' => true,
]);
$twig->addExtension(new DebugExtension());

$response = new MainController($serializer, $twig);

$response($request)->send();
