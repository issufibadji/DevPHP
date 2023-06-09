<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitddf8aa9b8adc8d1628784a24adbb2014
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitddf8aa9b8adc8d1628784a24adbb2014', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitddf8aa9b8adc8d1628784a24adbb2014', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitddf8aa9b8adc8d1628784a24adbb2014::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
