<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Models\Language;
use App\Repositories\EmailTemplate\EmailTemplateListRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{

    private EmailTemplateListRepositoryInterface $emailTemplateListRepository;
    private LanguageRepositoryInterface $languageRepository;

    public function __construct(EmailTemplateListRepositoryInterface $emailTemplateListRepository, LanguageRepositoryInterface $languageRepository)
    {
        $this->emailTemplateListRepository = $emailTemplateListRepository;
        $this->languageRepository = $languageRepository;
    }

    public function index()
    {
        $data['languages'] = $this->languageRepository->all();
        $data['emailTemplateList'] = $this->emailTemplateListRepository->all();
        return view('admin.mail_template.index', $data);
    }

    public function store(Request $request)
    {
        $languages = new Language();
        foreach ($request->mail as $key => $value) {
            foreach ($languages->all() as $language) {
                $emailTemplate = EmailTemplate::updateOrCreate(
                    ['language_id' => $language->id, 'email_template_id' => $key],
                    ['title' => $value['mailTitle'][$language->id], 'template' => $value['mailContent'][$language->id]]
                );
            }
        }
        return $emailTemplate;
    }

    public function edit()
    {

    }

    public function show()
    {

    }

    public function delete()
    {

    }

}
