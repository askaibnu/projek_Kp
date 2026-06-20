<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\BaseHandler;

class Session extends BaseConfig
{
    public string $driver = 'CodeIgniter\Session\Handlers\DatabaseHandler';
    public string $cookieName = 'ci_session';
    public int $expiration = 7200;
    
    // Ini sudah diganti menjadi 'ci_sessions' agar pas dengan tabel di TiDB
    public string $savePath = 'ci_sessions'; 
    
    public bool $matchIP = false;
    public int $timeToUpdate = 300;
    public bool $regenerateDestroy = false;
    public ?string $DBGroup = null;
    public int $lockRetryInterval = 100_000;
    public int $lockMaxRetries = 300;
}