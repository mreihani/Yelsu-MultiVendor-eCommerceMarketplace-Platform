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
    // توابع ریفرکتور
    protected function generateUserId() {
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

        return $userId;
    }

    protected function findRoomId($userId, $otherUserId) {
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
                $roomId = Chat::pluck('roomId')->max() + 1;
            }
        }

        return $roomId;
    }

    protected function getMessageObj($userId, $otherUserId) {
        $messagesObjJdate = [];
        $roomId = "";
        $messageStatus = false;

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

            // این وضعیت پیام برای اینه که وقتی پیام جدید میاد صفحه اسکرول کنه پایین، اگر نباشه صفحه همینجوری می چسبه به پایین
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

        return array("messagesObjJdate" => $messagesObjJdate, "roomId" => $roomId, "messageStatus" => $messageStatus);
    }
    // توابع ریفرکتور


    public function sendMessage(Request $request)
    {
        $otherUserId = Purify::clean($request->otherUserId);

        if (Auth::check()) {
            $userObject = Auth::user();
            $userId = $userObject->id;
        } else {
            $userId = $this->generateUserId();
        }

        $formFields = $request->validate([
            'message' => 'required'
        ]);

        if (! trim(Purify::clean($formFields['message']))) {
            return response()->noContent();
        }

        $roomId = $this->findRoomId($userId, $otherUserId);

        $chat_id = Chat::insertGetId([
            'roomId' => $roomId,
            'userId' => $userId,
            'otherUserId' => $otherUserId,
            'message' => Purify::clean($formFields['message']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // توابع مربوط به ساکت
        //$otherUserObj = User::find($otherUserId);
        //$messageObj = Chat::find($chat_id);
        // event(new \App\Events\ChatMessageEvent($userObject, $otherUserId, $otherUserObj, $messageObj, $roomId));
        // broadcast(new \App\Events\ChatMessageEvent($userObject, $otherUserId, $messageObj, $roomId))->toOthers();

        return array('otherUserId' => $otherUserId, 'userId' => $userId, 'roomId' => $roomId);
    }

    public function fetchSpecialist(Request $request)
    {
        $users_array = User::where('specialist_category_id', Purify::clean($request->selected_category))->latest()->get(['id', 'firstname','lastname']);
        $selected_category_name = Category::find(Purify::clean($request->selected_category))->category_name;

        return response(['users_array' => $users_array, 'selected_category_name' => $selected_category_name]);
    }

    public function fetchSpecialistFinal(Request $request)
    {
        $otherUserId = (int) Purify::clean($request->otherUserId);
        $otherUserObj = User::find($otherUserId, ['firstname', 'lastname', 'photo']);

        $categoryName = User::find($otherUserId)->specialist_category->category_name;

        if (Auth::check()) {
            $userObject = Auth::user();
            $userId = $userObject->id;
        } else {
            $userId = $this->generateUserId();
        }

        $messageObj = $this->getMessageObj($userId, $otherUserId);
        $messagesObjJdate = $messageObj["messagesObjJdate"];
        $roomId = $messageObj["roomId"];
        $messageStatus = $messageObj["messageStatus"];

        return response(['userId' => $userId, 'otherUserObj' => $otherUserObj, 'messagesObj' => $messagesObjJdate, 'categoryName' => $categoryName, 'loginStatus' => auth()->check()]);
    }

    public function fetchSpecialistLongPolling(Request $request)
    {
        $otherUserId = (int) Purify::clean($request->otherUserId);
        $otherUserObj = User::find($otherUserId, ['firstname', 'lastname', 'photo']);

        $otherUserObjBackend = User::find($otherUserId);

        $roomId = $this->findRoomId(auth()->user()->id, $otherUserId);

        if (Auth::check()) {
            $userObject = Auth::user();
            $userId = $userObject->id;
        } else {
            $userId = $this->generateUserId();
        }

        $messageObj = $this->getMessageObj($userId, $otherUserId);
        $messagesObjJdate = $messageObj["messagesObjJdate"];
        $messageStatus = $messageObj["messageStatus"];
        

        // Long polling functionality
        // $attempts = 1;
        // while($messageStatus == false && $attempts <= 5) {
        //     sleep(2);
        //     $messageObj = $this->getMessageObj($userId, $otherUserId);
        //     $messagesObjJdate = $messageObj["messagesObjJdate"];
        //     $roomId = $messageObj["roomId"];
        //     $messageStatus = $messageObj["messageStatus"];
        //     $attempts++;
        // }


        // تابع مربوط به سین شدن پیام طرف مقابل
        $otherUserObjMessages = Chat::where('roomId', $roomId)->where('userId', $otherUserId)->get();
        foreach ($otherUserObjMessages as $otherUserObjMessage) {
            $otherUserObjMessage->update([
                'seen' => 1,
            ]);
        }


        // این رو موقتا ترو کن
        // $messageStatus = true;

        return response(['userId' => $userId, 'otherUserObj' => $otherUserObj, 'messagesObj' => $messagesObjJdate, 'messageStatus' => $messageStatus]);
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

            $userId = $this->generateUserId();

            $roomId = $this->findRoomId($userId, $otherUserId);

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