<?php

namespace App\Http\Controllers;

use App\subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function add($topic) : Subscription
    {
        dd($topic);
    }
}
