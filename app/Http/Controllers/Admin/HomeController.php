<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Page;
use App\Models\ServiceCategory;
use App\Models\PageCategory;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::whereRoleIs('user')->orWhereRoleIs('admin')->count();
        //dd($users);
        $blogs = Blog::count();
        $blog_categories = Category::count();
        $page_categories = PageCategory::count();
        $pages = Page::count();
        $contacts = Contact::count();
        $subscribes = Subscribe::count();

        return view('admin.home', compact(
            ['users', 'blogs',  'blog_categories',
                'pages', 'page_categories', 'contacts', 'subscribes']));

    }// end of index

    public function fcm()
    {
        return view('admin.fcm');

    }// end of index

    public function saveToken(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $user->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }

    public function sendNotification(Request $request)
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAAVPR2uaU:APA91bGfcTqKmWfngwrE-WrcxiX5_5BCzVWAC30Cu6RNB8XqHoOQwe-oxuF9h1X1LRv_irqAmazXaK2zXNNbwXfF6FhBvEunWLdn0XUX0y2P8bxCwLB6rDJjkAXCcnaBv4rMrzSmrwNT';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        dd($response);
    }

}//end of controller
