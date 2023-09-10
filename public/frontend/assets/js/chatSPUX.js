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
                    if(!messageItem.message) {
                        messageBody = "کاربر فرم اطلاعات را تکمیل و شروع به چت کرده است"
                    }
                        if (messageItem.userId == response.data.user.id) {
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
                                    <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">${messageBody}</div>
                                    <div class="text-muted fs-7 mb-1 d-flex justify-content-end">${messageItem.jdate}</div>
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
                                    <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">${messageBody}</div>
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

    //  auto fetch
    function fetchData() {
        axios
            .post("/specialist/private/fetchsinglemessage", {
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
                    if(!messageItem.message) {
                        messageBody = "کاربر فرم اطلاعات را تکمیل و شروع به چت کرده است"
                    }
                    
                    if (messageItem.userId == response.data.user.id) {
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
                                <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">${messageBody}</div>
                                <div class="text-muted fs-7 mb-1 d-flex justify-content-end">${messageItem.jdate}</div>
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
                                <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">${messageBody}</div>
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

    // intervals auto fetch
    setInterval(() => {
        if (typeof YelsuOtherUserId != "undefined") {
            fetchData();
        }
    }, 5000);
    // end of auto fetch

    // send chat function
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
                        <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">${userInput}</div>
                        <div class="text-muted fs-7 mb-1 d-flex justify-content-end">چند لحظه گذشته</div>
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
    // end of send chat function

    // chat list auto fetch
    function fetchChatData() {
        $.ajax({
            url: "/specialist/private/autofetch",
            method: "get",

            success: function (response) {
                if (response.chatArr.length) {
                    let chatListAutoFetch =
                        document.getElementById("chatListAutoFetch");
                    var htmlAutoFetch = "";
                    response.chatArr.forEach((chatItem) => {
                        let lastItem = chatItem[chatItem.length - 1];
                        let familyNameFirstAlphabet =
                            lastItem.otherUserObj.lastname.charAt(0);
                        let home_phone = lastItem.otherUserObj.home_phone ?? '';

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
            },
        });
    }

    setInterval(() => {
        fetchChatData();
    }, 5000);
    // end of chat list auto fetch
});
