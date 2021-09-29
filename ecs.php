<?php declare(strict_types=1);

use PhpCsFixer\Fixer\Alias\MbStrFunctionsFixer;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(NativeFunctionInvocationFixer::class)
        ->call('configure', [[
            'include' => [NativeFunctionInvocationFixer::SET_ALL],
            'scope' => 'namespaced',
        ]]);

    $services->set(MbStrFunctionsFixer::class);

    $parameters = $containerConfigurator->parameters();

    $parameters->set('cache_directory', __DIR__ . '/var/cache/cs_fixer');

    $parameters->set('cache_namespace', 'SwagPlatformDemoData');

    $parameters->set('paths', [__DIR__ . '/src', __DIR__ . '/tests']);
};
