$(document).ready(() => {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#kt_chat_messenger_footer").hide();
    $("#kt_chat_messenger_header").hide();

    // Start Ajax request
    $(document).on("click", ".userChatItem", function (e) {
        let otherUserId = e.target.closest("div").firstElementChild.value;
        window.YelsuOtherUserId = otherUserId;

        // add message fetch function here
        message_fetch(otherUserId);
    });

    function message_fetch(otherUserId) {
        $("#listMessages").html(
            `<div class="d-flex justify-content-center">
            <i style="font-size:50px;" class="fas fa-spinner fa-spin"></i>
            </div>`
        );

        axios
            .post("/specialist/private/fetchsinglemessage", {
                otherUserId: otherUserId,
            })
            .then((response) => {
                let chatBody = "";
                $("#startInfo").remove();
                $("#kt_chat_messenger_footer").show();
                $("#kt_chat_messenger_header").show();

                if (response.data.otherUserObj) {
                    $(".otherUserName").html(
                        response.data.otherUserObj.firstname +
                            " " +
                            response.data.otherUserObj.lastname
                    );
                }

                response.data.messagesObj.forEach((messageItem) => {

                    let messageBody = messageItem.message;

                    let seenIcon;
                    if(messageItem.seen == 1) {
                        seenIcon = '<svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24" id="check-double" data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color"><line id="secondary" x1="13.22" y1="16.5" x2="21" y2="7.5" style="fill: none; stroke: rgb(44, 169, 188); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></line><polyline id="primary" points="3 11.88 7 16.5 14.78 7.5" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline></svg>';
                    } else {
                        seenIcon = '<svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24" id="check-double" data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color"><polyline id="primary" points="3 11.88 7 16.5 14.78 7.5" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline></svg>';
                    }

                    if (!messageItem.message) {
                        messageBody =
                            "کاربر فرم اطلاعات خود را تکمیل و ارسال نموده است";
                    }
                    if (messageItem.userId == response.data.userId) {
                        chatBody += `
    
                            <!--begin::پیام(in)-->
                            <div class="d-flex justify-content-start mb-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column align-items-start">
                                    <!--begin::user-->
                                    <div class="d-flex align-items-center mb-2">
    
                                    </div>
                                    <!--end::user-->
                                    <!--begin::Text-->
                                    <div class="p-5 myChat text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">${messageBody}</div>
                                    <div class="text-muted fs-7 mb-1 d-flex justify-content-end">
                                        ${seenIcon}
                                        &#8201;
                                        ${messageItem.jdate}
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::پیام(in)-->
    
                            `;
                    } else {
                        chatBody += `
    
                            <!--begin::پیام(out)-->
                            <div class="d-flex justify-content-end mb-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column align-items-end">
                                    <!--begin::user-->
                                    <div class="d-flex align-items-center mb-2">
                                        <!--begin::Details-->
                                        <div class="me-3">
    
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::user-->
                                    <!--begin::Text-->
                                    <input class="otherUserIdAnchor" type="hidden" value="${response.data.otherUserObj.id}">
                                    <div class="p-5 clientChat text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">${messageBody}</div>
                                    <div class="text-muted fs-7 mb-1 d-flex justify-content-end">${messageItem.jdate}</div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::پیام(out)-->
    
                            `;
                    }
                });

                $("#listMessages").html(chatBody);
                //chatBody = null;
                window.YelsuRoomId = response.data.roomId;
                window.YelsuCurrentUserId = response.data.userId;
            })
            .catch((error) => {
                // console.log("Error: ", error);
            });
    }

    // auto fetch for single chat item with long polling
    function fetchData() {
        axios
            .post("/specialist/private/fetchsinglemessagelongpolling", {
                otherUserId: YelsuOtherUserId,
            })
            .then((response) => {
                
                let chatBody = "";
                $("#startInfo").remove();
                $("#kt_chat_messenger_footer").show();
                $("#kt_chat_messenger_header").show();

                if (response.data.otherUserObj) {
                    $(".otherUserName").html(
                        response.data.otherUserObj.firstname +
                            " " +
                            response.data.otherUserObj.lastname
                    );
                }

                response.data.messagesObj.forEach((messageItem) => {
                    let messageBody = messageItem.message;
                    if (!messageItem.message) {
                        messageBody =
                            "کاربر فرم اطلاعات خود را تکمیل و ارسال نموده است";
                    }

                    let seenIcon;
                    if(messageItem.seen == 1) {
                        seenIcon = '<svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24" id="check-double" data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color"><line id="secondary" x1="13.22" y1="16.5" x2="21" y2="7.5" style="fill: none; stroke: rgb(44, 169, 188); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></line><polyline id="primary" points="3 11.88 7 16.5 14.78 7.5" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline></svg>';
                    } else {
                        seenIcon = '<svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24" id="check-double" data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color"><polyline id="primary" points="3 11.88 7 16.5 14.78 7.5" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline></svg>';
                    }

                    if (messageItem.userId == response.data.userId) {
                        chatBody += `

                        <!--begin::پیام(in)-->
                        <div class="d-flex justify-content-start mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-start">
                                <!--begin::user-->
                                <div class="d-flex align-items-center mb-2">

                                </div>
                                <!--end::user-->
                                <!--begin::Text-->
                                <div class="p-5 myChat text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">${messageBody}</div>
                                <div class="text-muted fs-7 mb-1 d-flex justify-content-end">
                                    ${seenIcon}
                                    &#8201;
                                    ${messageItem.jdate}
                                </div>
                                
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::پیام(in)-->

                        `;
                    } else {
                        chatBody += `

                        <!--begin::پیام(out)-->
                        <div class="d-flex justify-content-end mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-end">
                                <!--begin::user-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                                    <div class="me-3">

                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::user-->
                                <!--begin::Text-->
                                <input class="otherUserIdAnchor" type="hidden" value="${response.data.otherUserObj.id}">
                                <div class="p-5 clientChat text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">${messageBody}</div>
                                <div class="text-muted fs-7 mb-1 d-flex justify-content-end">${messageItem.jdate}</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::پیام(out)-->

                        `;
                    }
                });

                document.getElementById("listMessages").innerHTML = chatBody;
                // chatBody = null;
                window.YelsuRoomId = response.data.roomId;
                window.YelsuCurrentUserId = response.data.userId;

                if (response.data.messageStatus) {
                    //auto scroll function
                    $(".chatBodyScroll").animate(
                        {
                            scrollTop:
                                $(".chatBodyScroll").prop("scrollHeight"),
                        },
                        "fast"
                    );
                }
            })
            .catch((error) => {
                // console.log("Error: ", error);
            });
    }

    setInterval(() => {
        if (typeof YelsuOtherUserId != "undefined") {
            fetchData();
        }
    }, 10000);
    // end of auto fetch for single chat item with long polling

   
    // send chat function
    if(window.location.pathname == "/specialist/private/chat") {
        const formBtn = document.getElementById("inputMessageBtn");
        const inputMessage = document.getElementById("inputMessage");

        function sendItemPack() {
            let userInput = inputMessage.value;

            otherUserId = $(".otherUserIdAnchor").val();

            let newChatInput = `
                    
                    <div class="d-flex justify-content-start mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column align-items-start">
                            <!--begin::user-->
                            <div class="d-flex align-items-center mb-2">
                            </div>
                            <!--end::user-->
                            <!--begin::Text-->
                            <div class="p-5 myChat text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">${userInput}</div>
                            <div class="text-muted fs-7 mb-1 d-flex justify-content-end">
                            <svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24" id="check-double" data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color"><polyline id="primary" points="3 11.88 7 16.5 14.78 7.5" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline></svg>
                            &#8201;
                            چند لحظه گذشته
                            </div>
                            <!--end::Text-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                
                    `;

            $("#listMessages").append(newChatInput);

            //auto scroll function
            $(".chatBodyScroll").animate(
                {
                    scrollTop: $(".chatBodyScroll").prop("scrollHeight"),
                },
                "fast"
            );

            $.ajax({
                url: "/sendmessage",
                method: "post",
                data: {
                    message: userInput,
                    otherUserId: otherUserId,
                },
                success: function (response) {},
            });

            $("#inputMessage").val("");
        }

        inputMessage.addEventListener("keypress", function onEvent(event) {
            if (event.key === "Enter") {
                sendItemPack();
            }
        });

        formBtn.addEventListener("click", function (event) {
            sendItemPack();
        });
    }
    // end of send chat function

    // chat list auto fetch
    function fetchChatData() {
        $.ajax({
            url: "/specialist/private/autofetch",
            method: "get",

            success: function (response) {
                if (response.chatArr.length && window.location.pathname == "/specialist/private/chat") {
                    let chatListAutoFetch =
                        document.getElementById("chatListAutoFetch");
                    var htmlAutoFetch = "";
                    response.chatArr.forEach((chatItem) => {
                        let lastItem = chatItem[chatItem.length - 1];
                        let familyNameFirstAlphabet =
                            lastItem.otherUserObj.lastname.charAt(0);
                        let home_phone = lastItem.otherUserObj.home_phone ?? "";

                        htmlAutoFetch += `
                            <div class="d-flex flex-stack py-4">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-45px symbol-circle">
                                        <span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">${familyNameFirstAlphabet}</span>
                                    </div>

                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-5">
                                        <input type="hidden" value="${lastItem.otherUserObj.id}">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2 userChatItem">${lastItem.otherUserObj.firstname} ${lastItem.otherUserObj.lastname}</a>
                                        <div class="fw-semibold text-muted">${lastItem.otherUserObj.email}</div>
                                        <div class="fw-semibold text-muted">${home_phone}</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Lat seen-->
                                <div class="d-flex flex-column align-items-end ms-2">
                                    <span class="text-muted fs-7 mb-1">${lastItem.latestTime}</span>
                                </div>
                                <!--end::Lat seen-->
                            </div>
                        `;
                    });

                    chatListAutoFetch.innerHTML = htmlAutoFetch;
                }

                // let audio = new Audio( window.location.origin  + '/adminbackend/assets/media/new-message.mp3');

                if(response.totalUnreadMessages == 0) {
                    $('.totalUnreadMessages').html("");
                    
                } else if(response.totalUnreadMessages > 99) {
                    $('.totalUnreadMessages').html("99+");

                    // audio.play();
                } else {
                    $('.totalUnreadMessages').html(response.totalUnreadMessages);

                    // audio.play();
                }
                
            },

        });

        // این تریگیر فایل صوتی باید خارج از پاسخ ایجکس باشه
        // $('.totalUnreadMessages').on('click',function(event){
        //     audio.play();
        // });
    }

    setInterval(() => {
        fetchChatData();
    }, 3000);
    // end of chat list auto fetch
    
    
});
