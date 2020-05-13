<?php declare(strict_types=1);

namespace Tests;

use App\MainController;
use Symfony\Component\Serializer\SerializerInterface;
use Twig\Environment;

/**
 * 08.05.2020
 */
class ControllerTest extends \PHPUnit\Framework\TestCase
{
    public function testController(): void
    {
        $serializer = $this->createStub(SerializerInterface::class);
        $twig = $this->createStub(Environment::class);

        $controller = new MainController($serializer, $twig);
        $this->assertTrue(\method_exists($controller, '__invoke'));
    }
}
