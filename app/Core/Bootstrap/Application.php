<?php

namespace ResultSystems\Emtudo\Core\Bootstrap;

use Illuminate\Foundation\Application as LaravelApplication;

class Application extends LaravelApplication
{
    /**
     * Bootstrap the given application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function environmentFile()
    {
        if($this->runningInConsole() or $this->isDevEnvironment()){
            return ".env";
        }

        return $this->environmentFile ?: '.env';
    }

    public function isDevEnvironment(){
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $myIP = @gethostbyname('dominio.com');
        return in_array($ip, [$myIP, '127.0.0.7']);
    }
}
