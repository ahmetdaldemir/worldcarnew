<?php


namespace App\Repositories\Log;


//use App\Models\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class LogRepository implements LogRepositoryInterface
{

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function create(array $data)
    {
        try {
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/mailog.log'),
            ])->info($data);
        } catch (\Exception $e) {
            dd($e);
        }
       // Log::create(['error' => $data]);
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update(object $data)
    {
        // TODO: Implement update() method.
    }


}
