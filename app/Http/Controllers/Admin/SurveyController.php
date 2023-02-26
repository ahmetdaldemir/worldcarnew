<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnswerLanguage;
use App\Models\Language;
use App\Models\Reservation;
use App\Models\Survey;
use App\Models\SurveyLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Activitylog\Facades\LogBatch;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['surveys'] = Survey::all();
        return view('admin/settings/survey/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['surveys'] = Survey::find(1);
        $data['languages'] = Language::all();
        return view('admin/settings/survey/create', $data);
    }


    public function answer(Request $request)
    {
        $data['surveys'] = Survey::find($request->id);
        $data['id'] = $request->id;
        $data['answers'] = AnswerLanguage::where('survey_id',$request->id)->get();
        $data['languages'] = Language::all();
        return view('admin/settings/survey/answer', $data);
    }


    public function answerstore(Request $request)
    {
        $uuid = Str::uuid();
        $language = Language::all();
        $i = 0;
        foreach ($language as $val) {
            $answerLanguage = new AnswerLanguage();
            $answerLanguage->survey_id = $request->id;
            $answerLanguage->lang_id = $val->id;
            $answerLanguage->uuid = $uuid;
            $answerLanguage->name = $request->name[$i];
            $answerLanguage->save();
            $i++;
        }
        return redirect()->back();
    }


    public function answerdelete(Request $request)
    {
        $ansver = AnswerLanguage::where('uuid',$request->id)->delete();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $language = Language::all();

        $survey = new Survey();
        $survey->type = $request->type;
        $survey->save();
        $id = $survey->id;

        $i = 0;
        foreach ($language as $val) {
            $surveyLanguage = new SurveyLanguage();
            $surveyLanguage->survey_id = $id;
            $surveyLanguage->lang_id = $val->id;
            $surveyLanguage->name = $request->name[$i];
            $surveyLanguage->save();
            $i++;
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data['surveys'] = Survey::find($request->id);
        $data['id'] = $request->id;
        $data['answers'] = SurveyLanguage::where('survey_id',$request->id)->get();
        $data['languages'] = Language::all();
        return view('admin/settings/survey/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $language = Language::all();

        $survey =  Survey::find($request->id);
        $survey->type = $request->type;
        $survey->save();

        $i = 0;
        foreach ($request->name as $key => $value) {
            $surveyLanguage = SurveyLanguage::where('survey_id',$request->id)->where('lang_id',$key)->first();
            $surveyLanguage->name = $value;
            $surveyLanguage->save();
            $i++;
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Survey::find($request->id)->delete();
        AnswerLanguage::where('survey_id',$request->id)->delete();
        return redirect()->back();
    }

    public function send(Request $request)
    {
        LogBatch::startBatch();

        $reservation = Reservation::find($request->id);
        $this->dispatch(new \App\Jobs\Survey($reservation));
        LogBatch::endBatch();
    }

}
