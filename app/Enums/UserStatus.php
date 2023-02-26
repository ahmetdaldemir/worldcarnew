<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserStatus extends Enum
{
    public const Success = '1';
    public const Danger = '2';
    public const Comfirm = '3';
    public const Information = '4';


    public static function map() : array
    {
        return [
            static::Success  => 'Onay',
            static::Danger   => 'Red',
            static::Comfirm  => 'Tekrar Comfirme Ediniz',
            static::Information  => 'Geliş Dönüş Bilgilerini Giriniz ',
        ];
    }
}
