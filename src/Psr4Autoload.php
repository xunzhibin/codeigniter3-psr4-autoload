<?php

namespace xzb;

/**
 * PSR-4 Autoloader
 * 
 */
class Psr4Autoload
{
    /**
     * 注册
     * 
     * @param string $namesapcePerfix
     * @return void
     */
    public static function boot()
    {
        // 注册指定的函数作为 __autoload 的实现
        spl_autoload_register(function ($classname) {
            // 命名空间 前缀
            $namespacePrefix = 'App\\';
            // CodeIgniter3 系统类 前缀
            $ciClassPrefix = 'CI_';

            // 检测 前缀
            if (strncmp($classname, $namespacePrefix, strlen($namespacePrefix)) === 0) {
                // 路径
                $filePath = APPPATH . ltrim($classname, $namespacePrefix) . '.php';
                // 替换 分隔符
                $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $filePath);

                // 文件存在
                if (file_exists($filePath)) {
                    // 加载
                    require $filePath;
                }
            } else if (strncmp($classname, $ciClassPrefix, strlen($ciClassPrefix)) === 0) {
                foreach ([
                    BASEPATH . 'core' . DIRECTORY_SEPARATOR,
                    BASEPATH . 'libraries' . DIRECTORY_SEPARATOR,
                ] as $path) {
                    if (! file_exists($filePath = $path . ltrim($classname, $ciClassPrefix). '.php')) {
                        continue;
                    }

                    require $filePath;
                }
            }
        });
    }

}
