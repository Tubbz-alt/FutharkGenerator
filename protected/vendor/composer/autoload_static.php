<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfea5c4411cda7ca6be0c073b253e9472
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'ACWPD\\Helpers\\' => 14,
            'ACWPD\\Futhark\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ACWPD\\Helpers\\' => 
        array (
            0 => __DIR__ . '/..' . '/acwpd/helpers',
        ),
        'ACWPD\\Futhark\\' => 
        array (
            0 => __DIR__ . '/..' . '/acwpd/futhark-c',
        ),
    );

    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
        'Firebase\\Error' => __DIR__ . '/..' . '/ktamas77/firebase-php/src/firebaseStub.php',
        'Firebase\\FirebaseInterface' => __DIR__ . '/..' . '/ktamas77/firebase-php/src/firebaseInterface.php',
        'Firebase\\FirebaseLib' => __DIR__ . '/..' . '/ktamas77/firebase-php/src/firebaseLib.php',
        'Firebase\\FirebaseStub' => __DIR__ . '/..' . '/ktamas77/firebase-php/src/firebaseStub.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfea5c4411cda7ca6be0c073b253e9472::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfea5c4411cda7ca6be0c073b253e9472::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfea5c4411cda7ca6be0c073b253e9472::$classMap;

        }, null, ClassLoader::class);
    }
}