<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Testcontroller extends Controller
{
    function about() {

        $about = "This is About Page";
        $sum = 20 + 6;

        return view('pages.about', compact('about', 'sum'));
    }


    function contact() {
        $contact = "This is Contact Page";

        return view('pages.contact', compact('contact'));
    }
}
?>