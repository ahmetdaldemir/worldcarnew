<?php

namespace App\Http\Controllers;

use App\Models\Invition;
use App\Models\ReservationInformation;
use App\Models\ReservationNote;
use App\Models\Ticket;
use App\Models\TicketContent;
use App\Service\Email;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Language;
use App\Repository\Data;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Response;


class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $data['customers'] = Customer::find(Auth::id());
        // echo Auth::id();
        // $customers = Customer::find(Auth::id());
        // var_dump($data['customers']);
        // echo $customers->email;
        // Customer::find(Auth::());
        $data['static'] = $this->staticData();
        $this->lang(1);
        $data["destinations"] = Data::getMainDestinations();
        $data["blogs"] = Data::getBlogs();
        $data["texts"] = Data::getTexts(9, 'default');
        $data["text_home"] = Data::getTexts(16, 'default');
        $data["comments"] = Data::getCommentTake();
        $data["homeImage"] = Data::getPageImage("home");
        $data["homeText"] = Data::getPageText("home");
        return view('user.info', ['data' => $data]);
    }

    public function update(Request $request)
    {
        $customers = Customer::find(Auth::id());
        $customers->firstname = $request->firstname;
        $customers->lastname = $request->lastname;
        $customers->fullname = $request->firstname . " " . $request->lastname;
        $customers->phone = $request->phone;
        $customers->nationality = $request->nationality;
        $customers->save();
        return redirect()->back();
    }

    public function reservations()
    {
        $data['static'] = $this->staticData();
        $this->lang(1);
        $data["destinations"] = Data::getMainDestinations();
        $data["blogs"] = Data::getBlogs();
        $data["texts"] = Data::getTexts(9, 'default');
        $data["text_home"] = Data::getTexts(16, 'default');
        $data["comments"] = Data::getCommentTake();
        $data["homeImage"] = Data::getPageImage("home");
        $data["homeText"] = Data::getPageText("home");

        $data['reservation'] = Reservation::where("id_customer", Auth::id())->orderByDesc('id')->get();
        return view('user.reservations', ['data' => $data]);
    }

    public function discount()
    {
        $data['static'] = $this->staticData();
        $this->lang(1);
        $data["destinations"] = Data::getMainDestinations();
        $data["blogs"] = Data::getBlogs();
        $data["texts"] = Data::getTexts(9, 'default');
        $data["text_home"] = Data::getTexts(16, 'default');
        $data["comments"] = Data::getCommentTake();
        $data["homeImage"] = Data::getPageImage("home");
        $data["homeText"] = Data::getPageText("home");
        $data['customers'] = Customer::find(Auth::id());

        return view('user.discount', ['data' => $data]);
    }

    public function invitation()
    {
        $data['static'] = $this->staticData();
        $this->lang(1);

        $data["homeImage"] = Data::getPageImage("home");
        $data["homeText"] = Data::getPageText("home");
        $data['customers'] = Customer::find(Auth::id());
        $data['invitation'] = Invition::where('user_id')->get();

        return view('user.invitation', ['data' => $data]);
    }

    public function call_center()
    {
        $data['static'] = $this->staticData();
        $this->lang(1);
        $data["destinations"] = Data::getMainDestinations();
        $data["blogs"] = Data::getBlogs();
        $data["texts"] = Data::getTexts(9, 'default');
        $data["text_home"] = Data::getTexts(16, 'default');
        $data["comments"] = Data::getCommentTake();
        $data["homeImage"] = Data::getPageImage("home");
        $data["homeText"] = Data::getPageText("home");
        $data['support'] = Ticket::where("id_customer", Auth::id())->get();
        return view('user.support', ['data' => $data]);
    }

    public function ticket()
    {
        $data['static'] = $this->staticData();
        $this->lang(1);
        $data["destinations"] = Data::getMainDestinations();
        $data["blogs"] = Data::getBlogs();
        $data["texts"] = Data::getTexts(9, 'default');
        $data["text_home"] = Data::getTexts(16, 'default');
        $data["comments"] = Data::getCommentTake();
        $data["homeImage"] = Data::getPageImage("home");
        $data["homeText"] = Data::getPageText("home");
        $data['support'] = Ticket::where("id_customer", Auth::id())->get();
        return view('user.ticket', ['data' => $data]);
    }

    public function lang($id)
    {
        if ($id != 1) {
            $lang = Language::where("id", $id)->first();
            session()->put('lang', $id);
            session()->put('title', $lang->short);
            session()->put('flag', $lang->flag);
            return redirect()->back();
        } else {
            session()->put('lang', 1);
            session()->put('title', "TR");
            session()->put('flag', "tr.png");
            return redirect()->back();
        }
    }

    public function invitationsend(Request $request)
    {
        $to_name = $request->name;
        $to_email = $request->email;
        $code = rand(0000, 9999);
        $invition = new Invition();
        $invition->user_id = Auth::user()->id;
        $invition->receiver_mail = $request->email;
        $invition->receiver_code = $code;
        $invition->receiver_name = $request->name;
        $invition->receiver_percent = 10;
            $invition->save();
        $data = array('name' => $request->name, "body" => $code);
        Mail::send('email.invitation-email', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Davet Maili');
            $message->from(Auth::user()->email, Auth::user()->fullname);
        });
    }

    public function ticketsave(Request $request)
    {

        $ticket = new Ticket();
        $ticket->id_customer = Auth::id();
        $ticket->subject = $request->subject;
        $ticket->save();
        $lastInsertId = $ticket->id;

        $ticketcontent = new TicketContent();
        $ticketcontent->id_user = null;
        $ticketcontent->id_ticket = $lastInsertId;
        $ticketcontent->message = $request->message;
        $ticketcontent->save();
        return redirect(app()->getLocale() . "/profil/call_center");
    }

    public function reservationscancel(Request $request)
    {
        $reservation = Reservation::find($request->id);
        $data['reservation'] = $reservation;
        $data['message'] = $request->message;

        $reservationNote = new ReservationNote();
        $reservationNote->ide_reservation = $reservation->id;
        $reservationNote->messages = $request->message;
        $reservationNote->type = "notes";
        $reservationNote->sender = "manager";
        $reservationNote->id_user = 0;
        $reservationNote->save();

        $to_name = $data['reservation']->customer->fullname;
        $to_email = 'info@worlcarrental.com';
        $attachment = storage_path()."/pdf/".$reservation->pnr.'.pdf';

        Mail::send('email.reservation_cancel', $data, function ($message) use ($to_name, $to_email,$attachment) {
            $message->to('worldcarturkeymail@gmail.com', $to_name)->subject('Rezervasyon İptali');
            $message->from($to_email, $to_name);
            $message->cc("worldrentalanya@gmail.com");
            $message->attach($attachment);

        });
    }

    public function getreservationinfo(Request $request)
    {
        $reservation = Reservation::find($request->id);
        return $data = array(
            'id' => $reservation->id,
            'name' => $reservation->customer->fullname
        );
    }

    public function reservationcancel(Request $request)
    {
        $reservation = Reservation::find($request->id);
        $reservation->status = Reservation::RESERVATION_STATUS_CLOSED;
        $reservation->save();

        $reservationnote = new ReservationNote();
        $reservationnote->id_reservation = $request->id;
        $reservationnote->sender = "user";
        $reservationnote->type = "notes";
        $reservationnote->messages = $request->message;
        $reservationnote->save();
    }

    public function anket()
    {
        $data['static'] = $this->staticData();
        $this->lang(1);
        $data["destinations"] = Data::getMainDestinations();
        $data["blogs"] = Data::getBlogs();
        $data["texts"] = Data::getTexts(9, 'default');
        $data["text_home"] = Data::getTexts(16, 'default');
        $data["comments"] = Data::getCommentTake();
        $data["homeImage"] = Data::getPageImage("home");
        $data["homeText"] = Data::getPageText("home");
        $data['support'] = Ticket::where("id_customer", Auth::id())->get();
        $data['customers'] = Customer::find(Auth::id());

        return view('user.anket', ['data' => $data]);
    }

    public function download(Request $request)
    {


        $filename = storage_path().'/pdf/'.$request->pdf.'.pdf';
        if(file_exists($filename))
        {
            return Response::make(file_get_contents($filename), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="'.$request->pdf.'.pdf"'
            ]);
        }

        return redirect()->back();

     }
    public function printview(Request $request)
    {
        $filename = storage_path().'/pdf/'.$request->pdf.'.pdf';
        if(file_exists($filename))
        {
            return Response::make(file_get_contents($filename), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$request->pdf.'.pdf"'
            ]);
        }
        return redirect()->back();
    }

    public function  reservationedit(Request $request)
    {
        $data['static'] = $this->staticData();
        $this->lang(1);
        $data["destinations"] = Data::getMainDestinations();
        $data["blogs"] = Data::getBlogs();
        $data["texts"] = Data::getTexts(9, 'default');
        $data["text_home"] = Data::getTexts(16, 'default');
        $data["comments"] = Data::getCommentTake();
        $data["homeImage"] = Data::getPageImage("home");
        $data["homeText"] = Data::getPageText("home");
        $data['reservation'] = Reservation::find($request->id);
        return view('user.reservationsedit', ['data' => $data]);
    }

    public function  reservationeditsave(Request $request)
    {

        $data['reservation'] = Reservation::find($request->id);



        return redirect()->back();
    }




}
