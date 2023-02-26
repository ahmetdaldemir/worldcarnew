<?php


namespace App\Repository;


use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Destination;
use App\Models\Image;
use App\Models\Language;
use App\Models\Location;
use App\Models\Page;
use App\Models\PageLanguage;
use App\Models\Plate;
use App\Models\Reservation;
use App\Models\ReservationInformation;
use App\Models\ReservationPlate;
use App\Models\Text;
use App\Models\TextCategory;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Str;
use Redis;
use voku\helper\HtmlDomParser;

class Data
{


    public function getCustomer(int $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            return $customer->fullname;
        }
    }


    public static function getMainDestinations()
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $redis = new Redis();
        $redis->connect('localhost', 6379);
        if (!$redis->get('getMainDestinations_' . $langId)) {
            $data = DB::table('destinations')
                ->leftJoin('destination_languages', 'destinations.id', '=', 'destination_languages.id_destination')
                ->select('destinations.*', 'destination_languages.title', 'destination_languages.slug', 'destination_languages.short_description')
                ->where('destination_languages.id_lang', $langId)
                ->where('destinations.main_destination', "main")
                ->limit(4);
            if ($data->count() > 0) {
                $redis->set('getMainDestinations_' . $langId, json_encode($data->get()));
                return $data->get();
            } else {
                return array();
            }
        } else {
            return json_decode($redis->get('getMainDestinations_' . $langId));
        }
    }

    public static function getDestinations()
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;

        $data = DB::table('destinations')
            ->leftJoin('destination_languages', 'destinations.id', '=', 'destination_languages.id_destination')
            ->leftJoin('images', 'destinations.id', '=', 'images.id_module')
            ->select('destinations.*', 'destination_languages.title', 'destination_languages.slug','images.title as resim')->where('destination_languages.id_lang', $langId)
            ->where('images.module','destinations')
            ->limit(300);
        if ($data->count() > 0) {
            return $data->get();
        } else {
            return array();
        }
    }

    public static function getDestinationsId($id)
    {
        if (is_numeric($id)) {
            $langId = Language::where("url", app()->getLocale())->first()->id;

            $data = DB::table('destinations')
                ->leftJoin('destination_languages', 'destinations.id', '=', 'destination_languages.id_destination')
                ->where('destination_languages.id_lang', $langId)
                ->where('destinations.id', $id);
            if ($data->count() > 0) {
                return $data->first();
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    public static function getSubDestinations($id)
    {
        $x = Destination::find($id);
        if ($x) {
            if ($x->main_destination == "main") {
                $langId = Language::where("url", app()->getLocale())->first()->id;

                $data = DB::table('destinations')
                    ->leftJoin('destination_languages', 'destinations.id', '=', 'destination_languages.id_destination')
                    ->where('destination_languages.id_lang', $langId)
                    ->where('destinations.main_destination', $id)->select('destinations.*', 'destination_languages.title', 'destination_languages.slug')->get();
                return $data;
            } else {
                return array();
            }
        } else {
            return array();
        }


    }

    public static function getBlogs()
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $redis = new Redis();
        $redis->connect('localhost', 6379);


            $data = DB::table('blogs')
                ->leftJoin('blog_languages', 'blogs.id', '=', 'blog_languages.id_blog')
                ->select("blogs.id", "blog_languages.title", "blog_languages.meta_title", "blog_languages.image_alt", "blog_languages.image_alt_title", "blogs.image", "blogs.created_at", "blog_languages.short_description", "blog_languages.slug")
                ->where('blog_languages.id_lang', $langId)->where("view", 1)->orderBy("blogs.sort",'asc')->take(4);
            if ($data->count() > 0) {
                $redis->set('blog_' . $langId, json_encode($data->get()));
                return $data->get();
            } else {
                return array();
            }


    }

    public static function getAllBlogs()
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;

        $data = DB::table('blogs')
            ->leftJoin('blog_languages', 'blogs.id', '=', 'blog_languages.id_blog')
            ->select("blogs.id", "blog_languages.title", "blog_languages.image_alt", "blog_languages.image_alt_title", "blogs.image", "blogs.created_at", "blog_languages.short_description", "blog_languages.slug")->where('blog_languages.id_lang', $langId);
        if ($data->count() > 0) {
            return $data->get();
        } else {
            return array();
        }
    }

    public static function getTexts(int $category, string $type)
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $redis = new Redis();
        $redis->connect('localhost', 6379);

        if (!$redis->get('getTexts_' . $langId . '_' . $category . '_' . $type)) {
            if ($type == "tab") {
                return TextCategory::where('type', $type)->get();
            } else {
                $data = DB::table('texts')
                    ->leftJoin('text_languages', 'texts.id', '=', 'text_languages.id_text')
                    ->select('texts.id', 'texts.file', 'text_languages.title', 'text_languages.slug', 'text_languages.description')
                    ->where('text_languages.id_lang', $langId)->where('texts.category', $category)->orderBy("sort", "asc");
                if ($data->count() > 0) {
                    $redis->set('getTexts_' . $langId, json_encode($data->get()));
                    return $data->get();
                } else {
                    return array();
                }
            }
        } else {
            return json_decode($redis->get('getTexts_' . $langId));
        }
    }

    public static function getText($id)
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $data = DB::table('texts')
            ->leftJoin('text_languages', 'texts.id', '=', 'text_languages.id_text')
            ->where('text_languages.id_lang', $langId)->where("texts.id", $id);
        if ($data->count() > 0) {
            return $data->first();
        } else {
            return array();
        }

    }

    public static function getTextSlug($slug)
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $data = DB::table('texts')
            ->leftJoin('text_languages', 'texts.id', '=', 'text_languages.id_text')
            ->where('text_languages.id_lang', $langId)->where("text_languages.slug", $slug);
        if ($data->count() > 0) {
            return $data->first();
        } else {
            return array();
        }
    }

    public static function getAbout()
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $data = DB::table('texts')
            ->leftJoin('text_languages', 'texts.id', '=', 'text_languages.id_text')
            ->where('text_languages.id_lang', $langId)->where("texts.category", "19");
        if ($data->count() > 0) {
            return $data->first();
        } else {
            return array();
        }
    }

    public static function getTextForCategoryAll($slug)
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $dataCount = DB::table('texts')
            ->leftJoin('text_languages', 'texts.id', '=', 'text_languages.id_text')
            ->where('text_languages.id_lang', $langId)->where("text_languages.slug", $slug);
        if ($dataCount->count() > 0) {
            $category = $dataCount->first()->category;
            $ids = Text::select("id")->where("category", $category)->get();
            $data = DB::table('texts')
                ->select('texts.id', 'texts.category', 'texts.file', 'text_languages.title', 'text_languages.slug', 'text_languages.description', 'texts.created_at')
                ->leftJoin('text_languages', 'texts.id', '=', 'text_languages.id_text')
                ->where('text_languages.id_lang', $langId)->whereIn("texts.id", $ids->pluck('id')->all())
                ->get();
            return $data;
        } else {
            return array();
        }

    }

    public static function getTerms()
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;

        $data = DB::table('text_categories')
            ->leftJoin('text_category_languages', 'text_categories.id', '=', 'text_category_languages.id_text_category')
            ->where('text_category_languages.id_lang', $langId);
        if ($data->count() > 0) {
            return $data->get();
        } else {
            return array();
        }

    }

    public static function getNowTime()
    {
        $new_date = strtotime(date('H:i')) + strtotime("+3 hours");
        return date('h:00', $new_date);
    }

    public static function getBlog($id)
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $data = DB::table('blogs')
            ->leftJoin('blog_languages', 'blogs.id', '=', 'blog_languages.id_blog')
            ->where('blog_languages.id_lang', $langId)->where("blogs.id", $id);
        if ($data->count() > 0) {
            return $data->first();
        } else {
            return array();
        }

    }

    public static function getAllCampaings()
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $data = DB::table('campings')
            ->leftJoin('camping_languages', 'campings.id', '=', 'camping_languages.id_camping')
            ->where('camping_languages.id_lang', $langId);
        if ($data->count() > 0) {
            foreach ($data->get() as $val) {
                $datas[] = array(
                    'id' => $val->id,
                    'id_car' => self::getCarInfo($val->id_car),
                    'title' => $val->title,
                    'slug' => $val->slug,
                    'price' => $val->price2,
                    'id_camping' => $val->id_camping,
                    'image' => Image::where("id_module", $val->id_car)->where("module", "cars")->where("default", "default")->first()->title
                );
            }
            return $datas;
        } else {
            return array();
        }
    }

    public static function getCarInfoNoYear($id_car)
    {
        $car = Car::find($id_car);
        $brand = @Brand::find($car->brand)->brandname ?? null;
        $model = @CarModel::find($car->model)->modelname ?? null;
        return $brand . " " . $model;
    }

    public static function getCarInfo($id_car)
    {
        $car = Car::find($id_car);
        $brand = Brand::find($car->brand)->brandname ?? null;
        $model = CarModel::find($car->model)->modelname ?? null;
        $year = $car->year;
        return $brand . " " . $model . " " . $year;
    }

    public static function getCampaings($id)
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $data = DB::table('campings')
            ->leftJoin('camping_languages', 'campings.id', '=', 'camping_languages.id_camping')
            ->where('camping_languages.id_lang', $langId)->where("campings.id", $id);
        if ($data->count() > 0) {
            return $data->first();
        } else {
            return array();
        }
    }

    public static function getCommentTake()
    {
        $comment = Comment::where("status", 1)->orderBy("id", "desc")->get()->take(3);
        return $comment;
    }

    public static function getComments()
    {
        $comment = Comment::where('status', 1)->orderBy("id", "desc")->get();
        return $comment;
    }

    public static function wordRestriction($text, $length = 85, $ending = '...', $exact = true, $considerHtml = false)
    {
        if ($considerHtml) {
            // if the plain text is shorter than the maximum length, return the whole text
            if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }

            // splits all html-tags to scanable lines
            preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

            $total_length = strlen($ending);
            $open_tags = array();
            $truncate = '';

            foreach ($lines as $line_matchings) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if (!empty($line_matchings[1])) {
                    // if it’s an “empty element” with or without xhtml-conform closing slash (f.e.)
                    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // do nothing
                        // if tag is a closing tag (f.e.)
                    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // delete tag from $open_tags list
                        $pos = array_search($tag_matchings[1], $open_tags);
                        if ($pos !== false) {
                            unset($open_tags[$pos]);
                        }
                        // if tag is an opening tag (f.e. )
                    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                        // add tag to the beginning of $open_tags list
                        array_unshift($open_tags, strtolower($tag_matchings[1]));
                    }
                    // add html-tag to $truncate’d text
                    $truncate .= $line_matchings[1];
                }

                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length + $content_length > $length) {
                    // the number of characters which are left
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($entity[1] + 1 - $entities_length <= $left) {
                                $left--;
                                $entities_length += strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= substr($line_matchings[2], 0, $left + $entities_length);
                    // maximum lenght is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }

                // if the maximum length is reached, get off the loop
                if ($total_length >= $length) {
                    break;
                }
            }
        } else {
            if (strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = substr($text, 0, $length - strlen($ending));
            }
        }

        // if the words shouldn't be cut in the middle...
        if (!$exact) {
            // ...search the last occurance of a space...
            $spacepos = strrpos($truncate, ' ');
            if (isset($spacepos)) {
                // ...and cut the text in this position
                $truncate = substr($truncate, 0, $spacepos);
            }
        }

        // add the defined ending to the text
        $truncate .= $ending;

        if ($considerHtml) {
            // close all unclosed html-tags
            foreach ($open_tags as $tag) {
                $truncate .= "</" . $tag . ">";
            }
        }

        return $truncate;

    }

    public function kisalt($kelime, $str = 85)
    {
        if (strlen($kelime) > $str) {
            if (function_exists("mb_substr")) $kelime = mb_substr($kelime, 0, $str, "UTF-8") . '..';
            else $kelime = substr($kelime, 0, $str) . '..';
        }
        return $kelime;
    }


    public static function convertUtf8($response)
    {
        $s = str_replace(['?'], ['ı'], $response);
        return $s;
    }

    public static function getCategorys()
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $data = DB::table('categories')
            ->leftJoin('category_languages', 'categories.id', '=', 'category_languages.id_categories')
            ->where('category_languages.id_lang', $langId)->select('categories.*', 'category_languages.title', 'category_languages.slug');
        if ($data->count() > 0) {
            return $data->get();
        } else {
            return array();
        }
    }

    public static function getCarAttibutes($id_car)
    {
        $car = Car::find($id_car);
        $attributes = array(
            'category' => self::getCategory($car->category)[0]->title,
            'type' => $car->type,
            'fuel' => $car->fuel,
            'transmission' => $car->transmission,
        );
        return $attributes;
    }

    public static function getCategory($id)
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $data = DB::table('categories')
            ->leftJoin('category_languages', 'categories.id', '=', 'category_languages.id_categories')
            ->where('category_languages.id_lang', $langId)->where('categories.id', $id)->select('categories.*', 'category_languages.title', 'category_languages.slug');
        if ($data->count() > 0) {
            return $data->get();
        } else {
            return array();
        }
    }

    public static function getPageImage($function)
    {
        $redis = new Redis();
        $redis->connect('localhost', 6379);
        if (!$redis->get('getPageImage')) {
            $id_page = Page::where("function", $function)->first();
            if ($id_page) {
                $id_page = $id_page->id;
            }
            $x = Image::where("id_module", $id_page)->where("module", "pages")->first();
            if ($x) {
                $redis->set('getPageImage', json_encode($x->title));
                return $x->title;
            }
        } else {
            return json_decode($redis->get('getPageImage'));
        }

    }

    public static function getPageText($function)
    {
        $redis = new Redis();
        $redis->connect('localhost', 6379);
        if (!$redis->get('getPageText')) {
            $langId = Language::where("url", app()->getLocale())->first()->id;
            $id_page = Page::where("function", $function)->first()->id;
            $id_page = Page::where("function", $function)->first()->id;
            $redis->set('getPageImage', json_encode(PageLanguage::where("id_pages", $id_page)->where("id_lang", $langId)->first()->title));
            return PageLanguage::where("id_pages", $id_page)->where("id_lang", $langId)->first()->title;
        } else {
            return json_decode($redis->get('getPageText'));
        }
    }

    public static function getCarInfoFullNoYear($id_car)
    {

        $car = Car::find($id_car);
        $brand = @Brand::find($car->brand)->brandname ?? null;
        $model = @CarModel::find($car->model)->modelname ?? null;
        return $brand . " " . $model;
    }


    public static function getCarInfoFullNoDetail($id_car)
    {
        $car = Car::find($id_car);
        return $car->fuel . "-" . $car->transmission;
    }

    public function locationInfo($id)
    {
        return Location::find($id);
    }

    public function getDropData($id)
    {
        $data = array(
            'reservation_id' => 'Müsait',
            'checkin' => 'Müsait',
            'checkout' => 'Müsait',
            'droplocation' => 'Müsait',
            'checkouttime' => '-',
            'checkintime' => '-'
        );
        $location = new Location();
        $reservation = Reservation::where('plate', $id)->whereNotNull('drop_date')->orderByDesc('drop_date')->first();
        if ($reservation) {
                $data = array(
                    'reservation_id' => $reservation->id,
                    'checkin' => date('d-m-Y', strtotime($reservation->checkin)),
                    'checkintime' => date('H:i', strtotime($reservation->checkin_time)),
                    'checkout' => date('d-m-Y', strtotime($reservation->checkout)),
                    'checkouttime' => date('H:i', strtotime($reservation->checkout_time)),
                    'droplocation' => $location->getViewLocationName($reservation->drop_location)->sort ?? "Bulunamadı",
                );
         }

        return $data;
    }

    public function getPlateReservation($id)
    {
        if ($id == 0) {
            return "Atanmadı";
        } else {
            return Plate::find($id)->plate;
        }
    }


    public function getCheckinTime($id)
    {
        $reservationinfo = ReservationInformation::where('id_reservation', $id)->first();
        return $reservationinfo->checkin_time;
    }

    public function getCheckOutTime($id)
    {
        $reservationinfo = ReservationInformation::where('id_reservation', $id)->first();
        return $reservationinfo->checkout_time;
    }

    public static function getClientIps()
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"]))
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        else if (!empty($_SERVER["REMOTE_ADDR"]))
            $ip = $_SERVER["REMOTE_ADDR"];
        else
            $ip = "err";
        return $ip;
    }
}
