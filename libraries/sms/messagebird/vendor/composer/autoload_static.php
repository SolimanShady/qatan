<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit95e3817adc9f36b715be4b02950103bb
{
    public static $files = array (
        'bd9634f2d41831496de0d3dfe4c94881' => __DIR__ . '/..' . '/symfony/polyfill-php56/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Util\\' => 22,
            'Symfony\\Polyfill\\Php56\\' => 23,
        ),
        'M' => 
        array (
            'MessageBird\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Util\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-util',
        ),
        'Symfony\\Polyfill\\Php56\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php56',
        ),
        'MessageBird\\' => 
        array (
            0 => __DIR__ . '/..' . '/messagebird/php-rest-api/src/MessageBird',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit95e3817adc9f36b715be4b02950103bb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit95e3817adc9f36b715be4b02950103bb::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
