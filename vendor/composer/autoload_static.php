<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7c31650970c7a14785adf9f6044e0b23
{
    public static $files = array (
        'edfa8eae15d81df22ddae17ec88d2fd4' => __DIR__ . '/../..' . '/config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'core\\' => 5,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7c31650970c7a14785adf9f6044e0b23::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7c31650970c7a14785adf9f6044e0b23::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7c31650970c7a14785adf9f6044e0b23::$classMap;

        }, null, ClassLoader::class);
    }
}
