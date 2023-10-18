<?php

namespace xzb;

/**
 * PSR-4 Autoloader
 * 
 */
class Psr4Autoload
{
    /**
     * 命名空间 前缀
     * 
     * @var string
     */
    const NAMESPACE_PREFIX = 'App\\';

    /**
     * CodeIgniter 系统类前缀
     * 
     * @var string
     */
    const CI_CLASS_PREFIX = 'CI_';

    /**
     * 注册
     * 
     * @param string $namesapcePerfix
     * @return void
     */
    public static function boot($namespacePrefix = null)
    {
        if (! $namespacePrefix) {
            $namespacePrefix = self::NAMESPACE_PREFIX;
        }

        $ciClassPrefix = self::CI_CLASS_PREFIX;

        // 注册指定的函数作为 __autoload 的实现
        spl_autoload_register(function ($classname) use ($namespacePrefix, $ciClassPrefix) {
            // 检测 前缀
            if (strncmp($classname, $namespacePrefix, strlen($namespacePrefix)) === 0) {
                // 定位类的相对路径
                $classFilePath = APPPATH . ltrim($classname, $namespacePrefix) . '.php';
                // 替换 分隔符
                $classFilePath = str_replace('\\', DIRECTORY_SEPARATOR, $classFilePath);

                // 文件存在
                if (file_exists($classFilePath)) {
                    // 加载
                    require $classFilePath;
                }
            } else if (strncmp($classname, $ciClassPrefix, strlen($ciClassPrefix)) === 0) {
                // 定位类的相对路径
                $corePath = BASEPATH . 'core' . DIRECTORY_SEPARATOR;
                $libraryPath = BASEPATH . 'libraries' . DIRECTORY_SEPARATOR;

                // CI核心类
                if (file_exists($coreFilePath = $corePath . ltrim($classname, $ciClassPrefix). '.php')) {
                    require $coreFilePath;
                }
                // CI类库
                else if (file_exists($libraryFilePath = $libraryPath . ltrim($classname, $ciClassPrefix). '.php')) {
                    require $libraryFilePath;
                }
            }
        });
    }

}
