<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Exceptions extends BaseConfig
{
    public bool $logDeprecations = true;
    public bool $logNotices = true;
    public array $ignoreCodes = [
        \CodeIgniter\Router\Exceptions\RedirectException::class,
    ];
    public string $errorViewPath = APPPATH . 'Views/errors';
    public string $logPath = '/tmp/';
    public string $log = 'log_exceptions';

    /**
     * --------------------------------------------------------------------------
     * SENSITIVE DATA IN TRACE
     * --------------------------------------------------------------------------
     * Ini variabel baru yang diminta oleh CodeIgniter versi 4.7 ke atas, Nu.
     */
    public array $sensitiveDataInTrace = [];
}