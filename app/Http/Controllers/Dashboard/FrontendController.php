<?php

namespace App\Http\Controllers;

use App\Settings;
use App\Categories;
use App\slugs;
use App\Sub_Categories;
use App\UsersFeatures;
use App\HowFix3onWork;
use App\VideoLibrary;
use App\News;
use App\Slider;
use App\AboutCompany;
use App\usingTool;
use App\SitePolice;
use App\Tags;
use Illuminate\Http\Request;

use App\Http\Requests;

class FrontendController extends Controller
{
    public function index()
    {
        $settings = Settings::get();
        $categories = Categories::where('isActive', 1)->get();
        $usersfeatures = UsersFeatures::get();
        $slider = Slider::latest()->take(5)->where('is_slider', 0)->get();
        $steps = HowFix3onWork::orderBy('sort')->get();
        $home_video = VideoLibrary::where('video_home', 0)->latest()->first();
        $aboutcompany = AboutCompany::first();
        $news = News::latest()->take(15)->get();
        $lang = self::getLang();
        return view('front.index', compact('settings', 'categories', 'usersfeatures', 'slider', 'steps', 'lang', 'videos', 'home_video', 'aboutcompany', 'news'));
    }

    public function services()
    {
        $settings = Settings::get();
        $categories = Categories::where('isActive', 1)->get();
        $lang = self::getLang();
        return view('front.services', compact('settings', 'categories', 'lang'));
    }

    public function videos()
    {
        $settings = Settings::get();
        $categories = Categories::where('isActive', 1)->get();
        $videos = VideoLibrary::latest()->get();
        $lang = self::getLang();
        return view('front.videos', compact('settings', 'categories', 'lang', 'videos'));
    }

    public function gallery()
    {
        $settings = Settings::get();
        $categories = Categories::where('isActive', 1)->get();
        $slider = Slider::latest()->get();
        $lang = self::getLang();
        return view('front.gallery', compact('settings', 'categories', 'lang', 'slider'));
    }

    public function whoweare()
    {
        $settings = Settings::get();
        $categories = Categories::where('isActive', 1)->get();
        $lang = self::getLang();
        $aboutcompany = AboutCompany::first();
        return view('front.whoweare', compact('settings', 'categories', 'lang', 'aboutcompany'));
    }

    public function usingtool()
    {
        $settings = Settings::get();
        $categories = Categories::where('isActive', 1)->get();
        $lang = self::getLang();
        $usingtool = usingTool::first();
        return view('front.usingtool', compact('settings', 'categories', 'lang', 'usingtool'));
    }

    public function sitepolicy()
    {
        $settings = Settings::get();
        $categories = Categories::where('isActive', 1)->get();
        $lang = self::getLang();
        $sitepolicy = SitePolice::first();
        return view('front.sitepolicy', compact('settings', 'categories', 'lang', 'sitepolicy'));
    }

    public function articles()
    {
        $settings = Settings::get();
        $categories = Categories::where('isActive', 1)->get();
        $lang = self::getLang();
        $news = News::latest()->get();
        return view('front.articles', compact('settings', 'categories', 'lang', 'news'));
    }

    public static function action($lang, $slug)
    {
        $settings = Settings::get();
        $categories = Categories::where('isActive', 1)->get();

        $isExist = slugs::where('slug_ar', $slug)->orWhere('slug_en', $slug)->first();

        if (!$isExist) {
            abort(404);
        }
        if ($isExist->model == 'News') {
            $art = News::where('slug_ar', $slug)->orWhere('slug_en', $slug)->first();
            if (!$art) {
                abort(404);
            }
            if ($art['slug_' . $lang] != $slug) {
                return redirect(Url($lang . '/' . $art['slug_' . $lang]));
            }
            return view('front.singlearticle', compact('settings', 'categories', 'lang', 'art'));
        } elseif ($isExist->model == 'Categories') {
            $sub_categories = Sub_Categories::where('cat_id', $isExist->model_id)->get();

            $cat = Categories::where('slug_ar', $slug)->orWhere('slug_en', $slug)->first();
            if (!$cat) {
                abort(404);
            }
            if ($cat['slug_' . $lang] != $slug) {
                return redirect(Url($lang . '/' . $cat['slug_' . $lang]));
            }

            return view('front.singleservices', compact('settings', 'categories', 'lang', 'cat', 'sub_categories'));
        } else {
            $cat = Sub_Categories::findOrFail($isExist->model_id);
            $sub_categories = Sub_Categories::where('cat_id', $isExist->model_id)->get();
            $news = News::where('category_id', $isExist->model_id)->latest()->get();

            return view('front.subservices', compact('settings', 'categories', 'lang', 'cat', 'sub_categories', 'news'));
        }

    }

    public static function getArticlesBasedOnTag($lang,$tag)
    {
        $settings = Settings::get();
        $categories = Categories::where('isActive', 1)->get();
        $tag = Tags::where('tag_name',str_replace('-', ' ',$tag))->first();
        if (!$tag){
            abort(404);
        }

        $news = News::whereHas('tags', function ($q) use ($tag) {
            $q->where('tag_id', $tag->id);
        })->orderBy('created_at')->take(6)->get();

        return view('front.relatedArticles', compact('settings', 'categories', 'lang', 'news','tag'));


    }

    public static function getLang()
    {
        app()->setLocale(\Session::get('local'));
        return app()->getLocale();
    }


}
