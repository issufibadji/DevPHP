<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb952c28300014378fed9160d09dc5437
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb952c28300014378fed9160d09dc5437::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb952c28300014378fed9160d09dc5437::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb952c28300014378fed9160d09dc5437::$classMap;

        }, null, ClassLoader::class);
    }
}
