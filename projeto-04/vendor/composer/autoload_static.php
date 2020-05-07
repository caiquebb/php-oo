<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit377f5156e7a9ab235a3889781d157bdc
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Code\\' => 5,
        ),
        'A' => 
        array (
            'Ausi\\SlugGenerator\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Code\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Ausi\\SlugGenerator\\' => 
        array (
            0 => __DIR__ . '/..' . '/ausi/slug-generator/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit377f5156e7a9ab235a3889781d157bdc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit377f5156e7a9ab235a3889781d157bdc::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}