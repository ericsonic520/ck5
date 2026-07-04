<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShareButtonsController extends Controller
{
    function newsShare() {
        $data = [
            'id' => 1,
            'title' => 'The first title',
            'description' => 'This tutorial is about social share buttons in laravel...',
            'image' => '5f02b3ad15313.jpg',
        ];

        $shareButtons = \Share::page(
            url('/post'),
            'here is the text',
        )
        ->facebook()
        ->telegram()
        ->linkedin()
        ->whatsapp()
        ->reddit()
        ->twitter()
        ->pinterest();
        return view('news.newsShare',compact('data','shareButtons'));

    }
}
