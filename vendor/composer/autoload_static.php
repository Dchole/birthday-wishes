<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8674595bc401f1683bad2794ad2bbb5f
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit8674595bc401f1683bad2794ad2bbb5f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8674595bc401f1683bad2794ad2bbb5f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8674595bc401f1683bad2794ad2bbb5f::$classMap;

        }, null, ClassLoader::class);
    }
}
