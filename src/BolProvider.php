<?php
declare(strict_types=1);

namespace Exewen\Bol;

use Exewen\Di\ServiceProvider;
use Exewen\Bol\Contract\BolInterface;

class BolProvider extends ServiceProvider
{

    /**
     * 服务注册
     * @return void
     */
    public function register()
    {
        $this->container->singleton(BolInterface::class);
    }

}