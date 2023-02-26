<?php

namespace App\Repositories\Survey;

use App\Models\ReservationSurvey;

class SurveyRepository implements SurveyRepositoryInterface
{

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function all()
    {
        $reservationsurvey = ReservationSurvey::all();
        return $reservationsurvey;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update(object $data)
    {
        // TODO: Implement update() method.
    }

    public function create(object $data)
    {
        // TODO: Implement create() method.
    }
}
