@php
    $specialist_category_array = [];
    $specialist_category_array_unique = [];

    $usersList = App\Models\User::where('role','specialist')->get(["id","specialist_category_id"]);
    foreach ($usersList as $userItem) {
        if($userItem->specialist_category_id != NULL) {
            $specialist_category_array[] = $userItem->specialist_category;
        }
    }

    if($specialist_category_array) {
        $specialist_category_array_unique = array_unique($specialist_category_array);
    }
@endphp

@if (!Auth::check() || Auth::user()->role != 'specialist')
    
<div class="chatContainer">
    <div id="departmentContainer" class="departmentContainer1">
        <div class="titleName">
            سامانه گفتگوی آنلاین
            <span id="btnCloseChat">
                <svg fill="#ffffff" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
            </span>
        </div>

        <div id="departman" class="secChat" style="background-image: url('{{asset('frontend/assets/images/chat_bcg.png')}}')">
            <p class="t-blck">دپارتمان مورد نظر را انتخاب کنید</p>
            <select style="direction:rtl">
                <option value="#" selected="selected" data-select="chat">انتخاب دپارتمان</option>
                @if ($specialist_category_array_unique)
                    @foreach ($specialist_category_array_unique as $specialist_category_item)
                        <option name="specialist_category_id" value="{{$specialist_category_item->id}}">{{$specialist_category_item->category_name}}</option>
                    @endforeach
                @endif
            </select><br class="clear">
            <i id="spinnerChat" class="fas fa-spinner fa-spin"></i>
            <div class="onlineSupport">
                <div id="online">
                    <div class="dot"></div>
                </div>
                <p class="tBlckOnline">در حال حاضر {{count($specialist_category_array)}} نفر از همکاران Online و آماده پاسخگویی {{count($specialist_category_array) > 1 ? 'هستند' : "هست"}}</p>
                <a href="#">
                    <button type="submit" id="startChatbtn">انتخاب دپارتمان
                        
                    </button>
                    
                </a>
            </div>
        </div>
    </div>

    <div class="chatBox" style="display: none"></div>

    <div class="chatBtn">
        <img width="100" src="{{asset('frontend/assets/images/chat_icon.svg')}}" alt="chat box"/>
    </div>
</div>


@endif

