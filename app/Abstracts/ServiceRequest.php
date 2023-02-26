<?php


namespace App\Abstracts;


use App\Models\ServiceConfig;

abstract class ServiceRequest extends RemoteRestRequest
{

    protected $userConfig;

    public function __construct(ServiceConfig $userConfig)
    {
        $this->userConfig = $userConfig;
        $environment = $this->userConfig->key;
        $this->base_uri = config("service.{$environment}");
        parent::__construct();
    }



    public function getUserConfig(): ServiceConfig
    {
        return $this->userConfig;
    }
}
