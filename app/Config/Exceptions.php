<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Exceptions extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * LOG EXCEPTIONS
     * --------------------------------------------------------------------------
     * Define whether an exception should be logged or not.
     */
    public bool $logDeprecations = true;

    /**
     * --------------------------------------------------------------------------
     * LOG NOTICES
     * --------------------------------------------------------------------------
     * Define whether an exception should be logged or not.
     */
    public bool $logNotices = true;

    /**
     * --------------------------------------------------------------------------
     * DO NOT LOG EXCEPTIONS
     * --------------------------------------------------------------------------
     * DO NOT log these Exception classes.
     *
     * @var list<class-string<\Throwable>>
     */
    public array $ignoreCodes = [
        \CodeIgniter\Router\Exceptions\RedirectException::class,
    ];

    /**
     * --------------------------------------------------------------------------
     * Error Views Path
     * --------------------------------------------------------------------------
     * The path to the directory containing the views used to display errors.
     */
    public string $errorViewPath = APPPATH . 'Views/errors';

    /**
     * --------------------------------------------------------------------------
     * LOG PATH
     * --------------------------------------------------------------------------
     * The path to the directory where logs should be stored.
     * Kita ganti ke /tmp/ khusus untuk server read-only Vercel.
     */
    public string $logPath = '/tmp/';
}