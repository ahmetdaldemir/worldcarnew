<?php

namespace App\Repositories;

use App\Repositories\Accounting\AccountingRepository;
use App\Repositories\Accounting\AccountingRepositoryInterface;
use App\Repositories\AccountingCategory\AccountingCategoryRepository;
use App\Repositories\AccountingCategory\AccountingCategoryRepositoryInterface;
use App\Repositories\Car\CarRepository;
use App\Repositories\Car\CarRepositoryInterface;
use App\Repositories\EmailTemplate\EmailTemplateListRepository;
use App\Repositories\EmailTemplate\EmailTemplateListRepositoryInterface;
use App\Repositories\EmailTemplate\EmailTemplateRepositoryInterface;
use App\Repositories\EmailTemplate\EmailTemplateRepository;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\Repositories\Log\LogRepository;
use App\Repositories\Log\LogRepositoryInterface;
use App\Repositories\Message\MessageRepository;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Plate\PlateRepository;
use App\Repositories\Plate\PlateRepositoryInterface;
use App\Repositories\Reservation\ReservationRepository;
use App\Repositories\Reservation\ReservationRepositoryInterface;
use App\Repositories\StopSell\StopSellRepository;
use App\Repositories\StopSell\StopSellRepositoryInterface;
use App\Repositories\Survey\SurveyRepository;
use App\Repositories\Survey\SurveyRepositoryInterface;
use App\Repositories\Tour\TourRepository;
use App\Repositories\Tour\TourRepositoryInterface;
use App\Repositories\Transfer\TransferRepository;
use App\Repositories\Transfer\TransferRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryBackendServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            AccountingCategoryRepositoryInterface::class,
            AccountingCategoryRepository::class
        );

        $this->app->bind(
            AccountingRepositoryInterface::class,
            AccountingRepository::class
        );

        $this->app->bind(
            TransferRepositoryInterface::class,
            TransferRepository::class,
        );

        $this->app->bind(
            StopSellRepositoryInterface::class,
            StopSellRepository::class
        );

        $this->app->bind(
            PlateRepositoryInterface::class,
            PlateRepository::class
        );

        $this->app->bind(
            ReservationRepositoryInterface::class,
            ReservationRepository::class
        );

        $this->app->bind(
            MessageRepositoryInterface::class,
            MessageRepository::class
        );
        $this->app->bind(
            TourRepositoryInterface::class,
            TourRepository::class
        );
        $this->app->bind(
            EmailTemplateRepositoryInterface::class,
            EmailTemplateRepository::class
        );
        $this->app->bind(
            LanguageRepositoryInterface::class,
            LanguageRepository::class
        );
        $this->app->bind(
            EmailTemplateListRepositoryInterface::class,
            EmailTemplateListRepository::class
        );

        $this->app->bind(
            LogRepositoryInterface::class,
            LogRepository::class
        );

        $this->app->bind(
            SurveyRepositoryInterface::class,
            SurveyRepository::class
        );


        $this->app->bind(
            CarRepositoryInterface::class,
            CarRepository::class
        );
    }
}
