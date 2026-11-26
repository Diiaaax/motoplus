<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\BlogPost;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function faq()
    {
        $faqs = FAQ::published()->get()->groupBy('category');
        return view('pages.faq', compact('faqs'));
    }
}
