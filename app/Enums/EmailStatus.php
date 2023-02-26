<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EmailStatus extends Enum
{
    public const comfirm = '1';
    public const closed = '2';
    public const comfirm_please = '3';
    public const reservation_edit = '4';


    public static function map() : array
    {
        return [
            static::comfirm  => 'Onay',
            static::closed   => 'Red',
            static::comfirm_please  => 'Tekrar Comfirme Ediniz',
            static::reservation_edit  => 'Geliş Dönüş Bilgilerini Giriniz ',
        ];
    }
}
