<?php

namespace Bulkly\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

use Illuminate\Support\Facades\Auth;

use Bulkly\User;

use Bulkly\SocialAccounts;
use Bulkly\SocialPostGroups;

use Bulkly\BufferPosting;

use GuzzleHttp\Exception\RequestException;

use GuzzleHttp\Exception\ClientException;

class BufferPostingController extends Controller
{
    public function index(){
        if(!Auth::guard('web')->check()){
            return redirect('/login');
        }
        $bufferPostings = BufferPosting::paginate(10);
        $groups = SocialPostGroups::get(['id','name']);
        $user = User::find(Auth::id());

        if(isset(request()->page)){
            return view('pages.buffer_posting_view', compact('bufferPostings'));
        }

        return view('pages.buffer_posting', compact('bufferPostings','user','groups'));
    }

    public function search($data){
        if(!Auth::guard('web')->check()){
            return response()->json(['success'=>false]);
        }

        $date = explode('&',$data)[0];
        $group_id = explode('&',$data)[1];

        $bufferPostings = BufferPosting::when($date!="0",function($query) use($date){
            return $query->where(\DB::raw('substr(`sent_at`,1,10)'),$date);
        })
        ->when($group_id!="0",function($query) use($group_id){
            return $query->where('group_id',$group_id);
        })
        ->paginate(10);

        return view('pages.buffer_posting_view', compact('bufferPostings'));
        
        
    }

}
