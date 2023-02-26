<?php namespace App\Contracts;


interface Payment
{

    public function getContent();
    public function getCurrency();
    public function getAmount();
    public function getMerchantId();
    public function getMerchantPassword();
    public function getSuccessUrl();
    public function getFailUrl();
    public function getReservationId();
    public function getReferenceId();
    public function getPan();
    public function getCcv();
    public function getExpiryDate();
    public function getTerminalId();
    public function getBrand();

}
