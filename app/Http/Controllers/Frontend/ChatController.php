<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;


class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {

        $otherUserId = Purify::clean($request->otherUserId);

        if (Auth::check()) {
            $userObject = Auth::user();
            $userId = $userObject->id;
        } else {
            if (Session::get('notLoggedInUserId')) {
                $userId = Session::get('notLoggedInUserId');
            } else {
                $userId = Str::uuid();

                for ($i = 0; $i < 5; $i++) {
                    if (! count(Chat::where('userId', $userId)->orWhere('otherUserId', $userId)->get())) {
                        break;
                    } else {
                        $userId = Str::uuid();
                    }
                }

                Session::put('notLoggedInUserId', $userId);
            }
        }

        $formFields = $request->validate([
            'message' => 'required'
        ]);

        $temp_chat_results = Chat::all();

        if (! trim(Purify::clean($formFields['message']))) {
            return response()->noContent();
        }

        if ((! $temp_chat_results->count())) {
            $roomId = 1;
        } else {
            $ChatObj1 = Chat::where('userId', '=', $userId)->where('otherUserId', '=', $otherUserId)->latest()->get();
            $ChatObj2 = Chat::where('userId', '=', $otherUserId)->where('otherUserId', '=', $userId)->latest()->get();

            if ($ChatObj1->count()) {
                $roomId = $ChatObj1[0]->roomId;
            } elseif ($ChatObj2->count()) {
                $roomId = $ChatObj2[0]->roomId;
            } else {
                $roomId = Chat::latest()->first()->roomId + 1;
            }
        }

        $chat_id = Chat::insertGetId([
            'roomId' => $roomId,
            'userId' => $userId,
            'otherUserId' => $otherUserId,
            'message' => Purify::clean($formFields['message']),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        //$otherUserObj = User::find($otherUserId);
        //$messageObj = Chat::find($chat_id);
        // event(new \App\Events\ChatMessageEvent($userObject, $otherUserId, $otherUserObj, $messageObj, $roomId));
        // broadcast(new \App\Events\ChatMessageEvent($userObject, $otherUserId, $messageObj, $roomId))->toOthers();

        return array('otherUserId' => $otherUserId, 'userId' => $userId, 'roomId' => $roomId);
    }

    public function fetchSpecialist(Request $request)
    {
        $users_array = User::where('specialist_category_id', Purify::clean($request->selected_category))->latest()->get();
        $selected_category_name = Category::find(Purify::clean($request->selected_category))->category_name;

        // return $users_array;
        return response(['users_array' => $users_array, 'selected_category_name' => $selected_category_name]);
    }

    public function fetchSpecialistFinal(Request $request)
    {
        $otherUserId = (int) Purify::clean($request->otherUserId);
        $otherUserObj = User::find($otherUserId);

        $categoryName = $otherUserObj->specialist_category->category_name;
        $messagesObjJdate = [];
        $roomId = "";
        $messageStatus = false;

        if (Auth::check()) {
            $userObject = Auth::user();
            $userId = $userObject->id;
        } else {
            if (Session::get('notLoggedInUserId')) {
                $userId = Session::get('notLoggedInUserId');
            } else {
                $userId = Str::uuid();

                for ($i = 0; $i < 5; $i++) {
                    if (! count(Chat::where('userId', $userId)->orWhere('otherUserId', $userId)->get())) {
                        break;
                    } else {
                        $userId = Str::uuid();
                    }
                }

                Session::put('notLoggedInUserId', $userId);
            }
        }

        $temp_chat_reults = Chat::all();

        $ChatObj1 = Chat::where('userId', '=', $userId)->where('otherUserId', '=', $otherUserId)->latest()->get();
        $ChatObj2 = Chat::where('userId', '=', $otherUserId)->where('otherUserId', '=', $userId)->latest()->get();

        if ($ChatObj1->count() || $ChatObj2->count()) {

            if ((! $temp_chat_reults->count())) {
                $roomId = 1;
            } else {
                if ($ChatObj1->count()) {
                    $roomId = $ChatObj1[0]->roomId;
                } elseif ($ChatObj2->count()) {
                    $roomId = $ChatObj2[0]->roomId;
                }
            }

            $messagesObj = Chat::where('roomId', $roomId)->get();

            if (Session::get('messageCount' . $roomId) && $messagesObj->count() != Session::get('messageCount' . $roomId)) {
                $messageStatus = true;
            }

            Session::put('messageCount' . $roomId, $messagesObj->count());

            foreach ($messagesObj as $messageItem) {
                $messagesCollection = collect($messageItem);
                $messagesObjJdate[] = $messagesCollection->put('jdate', jdate($messageItem->created_at)->ago());
            }
        } else {
            $messagesObjJdate = NULL;
        }

        return response(['userId' => $userId, 'loginStatus' => Auth::check(), 'otherUserObj' => $otherUserObj, 'messagesObj' => $messagesObjJdate, 'categoryName' => $categoryName, 'roomId' => $roomId, 'messageStatus' => $messageStatus]);
    }

    public function sendfirstform(Request $request)
    {
        $obj = json_decode(Purify::clean($request->formData));

        $chatUserFirstname = $obj->chatUserFirstname;
        $chatUserLastname = $obj->chatUserLastname;
        $chatUserPhone = $obj->chatUserPhone;
        $chatUserEmail = $obj->chatUserEmail;

        if (! $chatUserFirstname || ! $chatUserLastname || ! $chatUserPhone || ! $chatUserEmail) {
            return response(['success' => false, 'chatUserFirstname' => $chatUserFirstname, 'chatUserLastname' => $chatUserLastname, 'chatUserPhone' => $chatUserPhone, 'chatUserEmail' => $chatUserEmail]);
        } else {
            $otherUserId = Purify::clean($request->otherUserId);

            if (Session::get('notLoggedInUserId')) {
                $userId = Session::get('notLoggedInUserId');
            } else {
                $userId = Str::uuid();

                for ($i = 0; $i < 5; $i++) {
                    if (! count(Chat::where('userId', $userId)->orWhere('otherUserId', $userId)->get())) {
                        break;
                    } else {
                        $userId = Str::uuid();
                    }
                }

                Session::put('notLoggedInUserId', $userId);
            }

            $temp_chat_results = Chat::all();

            if ((! $temp_chat_results->count())) {
                $roomId = 1;
            } else {
                $ChatObj1 = Chat::where('userId', '=', $userId)->where('otherUserId', '=', $otherUserId)->latest()->get();
                $ChatObj2 = Chat::where('userId', '=', $otherUserId)->where('otherUserId', '=', $userId)->latest()->get();

                if ($ChatObj1->count()) {
                    $roomId = $ChatObj1[0]->roomId;
                } elseif ($ChatObj2->count()) {
                    $roomId = $ChatObj2[0]->roomId;
                } else {
                    $roomId = Chat::latest()->first()->roomId + 1;
                }
            }

            $chat_id = Chat::insertGetId([
                'roomId' => $roomId,
                'userId' => $userId,
                'otherUserId' => $otherUserId,
                'firstname' => $chatUserFirstname,
                'lastname' => $chatUserLastname,
                'home_phone' => $chatUserPhone,
                'email' => $chatUserEmail,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return response(['success' => true]);
        }
    }
}