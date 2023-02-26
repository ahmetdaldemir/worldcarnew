<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogLanguage;
use App\Models\Language;
use App\Repositories\EmailTemplate\EmailTemplateRepositoryInterface;
use App\Repositories\Tour\TourRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class TourController extends Controller
{
    private TourRepositoryInterface $tourRepository;
    private EmailTemplateRepositoryInterface $languageRepository;

    public function __construct(
        TourRepositoryInterface $tourRepository,
        EmailTemplateRepositoryInterface $languageRepository
    )
    {
        $this->tourRepository = $tourRepository;
        $this->languageRepository = $languageRepository;
    }

    public function index()
    {
       $data['tours'] = $this->tourRepository->all();
       $data['languages'] = $this->languageRepository->all();
        return view('admin.tour.index', $data);
    }

    public function create()
    {
        $language = Language::all();
        return view('admin.tour.create', ['languages' => $language]);
    }

    public function save(Request $request)
    {
        $this->tourRepository->create($request);
        return redirect('admin/admin/tour');
    }


    public function edit(Request $request)
    {
        $id = $request->id;
        $data['languages'] = $this->languageRepository->all();
        $data['tour'] = $this->tourRepository->get($id);
        $data['id'] = $id;
        return view('admin.tour.edit', $data);
    }


    public function update(Request $request)
    {
       $this->tourRepository->update($request);
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $tour = Tour::find($request->id);
        $tour->delete();
        TourLanguage::where("id_blog", $request->id)->delete();
        return redirect()->back();
    }
}
