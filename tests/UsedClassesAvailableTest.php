<?php declare(strict_types=1);

namespace Swag\PlatformDemoDataTests;

use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;
use Symfony\Component\Finder\Finder;

class UsedClassesAvailableTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testClassesAreInstantiable(): void
    {
        $namespace = \str_replace('Tests', '', __NAMESPACE__);

        foreach ($this->getPluginClasses() as $class) {
            $classRelativePath = \str_replace(['.php', '/'], ['', '\\'], $class->getRelativePathname());

            /** @var class-string $className */
            $className = $namespace . '\\' . $classRelativePath;

            $this->getMockBuilder($className)
                ->disableOriginalConstructor()
                ->getMock();
        }

        // Nothing broke so far, classes seem to be instantiable
        static::assertTrue(true);
    }

    private function getPluginClasses(): Finder
    {
        $finder = new Finder();
        $finder->in((string) \realpath(__DIR__ . '/../'));
        $finder->exclude(['vendor', 'Test', 'tests', 'var']);

        return $finder->files()->name('*.php');
    }
}
