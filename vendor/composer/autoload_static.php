<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit49fae66d7093674248098b9fb8844f6a
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
        'f9e61f18f0291090ecf3f67a829046de' => __DIR__ . '/..' . '/athari/yalinqo/YaLinqo/Linq.php',
        '2cffec82183ee1cea088009cef9a6fc3' => __DIR__ . '/..' . '/ezyang/htmlpurifier/library/HTMLPurifier.composer.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Y' => 
        array (
            'YaLinqo\\' => 8,
        ),
        'S' => 
        array (
            'Svg\\' => 4,
            'Slim\\Middleware\\' => 16,
            'Slim\\HttpCache\\' => 15,
            'Slim\\' => 5,
            'Sabberworm\\CSS\\' => 15,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Container\\' => 14,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'H' => 
        array (
            'Hybridauth\\' => 11,
            'Html2Text\\' => 10,
        ),
        'F' => 
        array (
            'FontLib\\' => 8,
            'Firebase\\JWT\\' => 13,
            'FastRoute\\' => 10,
        ),
        'D' => 
        array (
            'Dompdf\\' => 7,
            'Delight\\Http\\' => 13,
            'Delight\\Cookie\\' => 15,
            'Defuse\\Crypto\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'YaLinqo\\' => 
        array (
            0 => __DIR__ . '/..' . '/athari/yalinqo/YaLinqo',
        ),
        'Svg\\' => 
        array (
            0 => __DIR__ . '/..' . '/phenx/php-svg-lib/src/Svg',
        ),
        'Slim\\Middleware\\' => 
        array (
            0 => __DIR__ . '/..' . '/tuupola/slim-jwt-auth/src',
        ),
        'Slim\\HttpCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/http-cache/src',
        ),
        'Slim\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/slim/Slim',
        ),
        'Sabberworm\\CSS\\' => 
        array (
            0 => __DIR__ . '/..' . '/sabberworm/php-css-parser/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Hybridauth\\' => 
        array (
            0 => __DIR__ . '/..' . '/hybridauth/hybridauth/src',
        ),
        'Html2Text\\' => 
        array (
            0 => __DIR__ . '/..' . '/soundasleep/html2text/src',
        ),
        'FontLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/phenx/php-font-lib/src/FontLib',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
        'Dompdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/hkvstore/dompdf/src',
        ),
        'Delight\\Http\\' => 
        array (
            0 => __DIR__ . '/..' . '/delight-im/http/src',
        ),
        'Delight\\Cookie\\' => 
        array (
            0 => __DIR__ . '/..' . '/delight-im/cookie/src',
        ),
        'Defuse\\Crypto\\' => 
        array (
            0 => __DIR__ . '/..' . '/defuse/php-encryption/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
            'PHPThumb' => 
            array (
                0 => __DIR__ . '/..' . '/hkvstore/phpthumb/src',
            ),
        ),
        'H' => 
        array (
            'HTMLPurifier' => 
            array (
                0 => __DIR__ . '/..' . '/ezyang/htmlpurifier/library',
            ),
        ),
        'D' => 
        array (
            'Dflydev\\DotAccessData' => 
            array (
                0 => __DIR__ . '/..' . '/dflydev/dot-access-data/src',
            ),
            'Detection' => 
            array (
                0 => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/namespaced',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Cpdf' => __DIR__ . '/..' . '/hkvstore/dompdf/lib/Cpdf.php',
        'HTML5_Data' => __DIR__ . '/..' . '/hkvstore/dompdf/lib/html5lib/Data.php',
        'HTML5_InputStream' => __DIR__ . '/..' . '/hkvstore/dompdf/lib/html5lib/InputStream.php',
        'HTML5_Parser' => __DIR__ . '/..' . '/hkvstore/dompdf/lib/html5lib/Parser.php',
        'HTML5_Tokenizer' => __DIR__ . '/..' . '/hkvstore/dompdf/lib/html5lib/Tokenizer.php',
        'HTML5_TreeBuilder' => __DIR__ . '/..' . '/hkvstore/dompdf/lib/html5lib/TreeBuilder.php',
        'Mobile_Detect' => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/Mobile_Detect.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit49fae66d7093674248098b9fb8844f6a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit49fae66d7093674248098b9fb8844f6a::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit49fae66d7093674248098b9fb8844f6a::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit49fae66d7093674248098b9fb8844f6a::$classMap;

        }, null, ClassLoader::class);
    }
}
