$(document).ready(() => {
    

    // move up or down chat btn
    window.onscroll = function (e) {
        // print "false" if direction is down and "true" if up

        if ($(window).width() < 478) {
            if (this.oldScroll < this.scrollY) {
                $(".chatBtn").css("bottom", function (index) {
                    return 80;
                });
            } else {
                $(".chatBtn").css("bottom", function (index) {
                    return 20;
                });
            }
        }

        let window_size = window.matchMedia("(max-width: 478px)");

        this.oldScroll = this.scrollY;
    };
    // end of move up or down chat btn

    const startChatbtn = document.getElementById("startChatbtn");

    //delete later
    $('#chatBtnContact').click(() => {
        $("#departmentContainer").slideToggle("slow");
    });
    //delete later

    $(".chatBtn").click(() => {
        $("#departmentContainer").slideToggle("slow");
    });

    $("#btnCloseChat").click(() => {
        $("#departmentContainer").slideUp("slow");
    });

    // start first Ajax request
    startChatbtn.addEventListener("click", function (event) {
        let selected_category = $("#departmentContainer #departman select")
            .find(":selected")
            .val();

        let departmentContainer = document.getElementById(
            "departmentContainer"
        );
        $("#spinnerChat").show();
        axios
            .post("/fetchspecialist", {
                selected_category: selected_category,
            })
            .then((response) => {
                let users_array = response.data.users_array;
                let selected_category_name =
                    response.data.selected_category_name;
                let optionsArray;

                users_array.forEach((user) => {
                    optionsArray += `
                    <option name="specialist_user" value="${user.id}">${user.firstname} ${user.lastname}</option>
                    `;
                });

                let html = `

                <div id="departmentContainer">
                    <div class="titleName">
                        سامانه گفتگوی آنلاین
                        <span id="btnCloseChat">
                            <svg fill="#ffffff" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                        </span>
                    </div>
                    <div id="departman" class="secChat" style="background-image: url('https://yelsu.com/frontend/assets/images/chat_bcg.png')">
                        <p class="t-blck">پشتیبان مورد نظر را انتخاب کنید</p>
                                    <select style="direction:rtl">
                                        
                                        ${optionsArray}        
                                    </select><br class="clear">
                                    <i id="spinnerChat" class="fas fa-spinner fa-spin"></i>
                        <div class="onlineSupport">
                            <div id="online">
                                <div class="dot"></div>
                            </div>
                            <p class="tBlckOnline"> لطفا برای آغاز گفتگو برای روی دکمه <br><b>شروع پشتیبانی</b> کلیک کنید</p>
                            <a href="#">
                                <button type="submit" id="startChatbtnFinal">شروع پشتیبانی
                                
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                `;

                departmentContainer.innerHTML = html;

                $("#btnCloseChat").click(() => {
                    $("#departmentContainer").slideUp("slow");
                });
                // End of first Ajax request

                // Start second Ajax request
                const startChatbtnFinal =
                    document.getElementById("startChatbtnFinal");
                startChatbtnFinal.addEventListener("click", function (event) {
                    $("#spinnerChat").show();
                    // add message fetch function here
                    message_fetch();

                    setInterval(() => {
                        fetchData();
                    }, 5000);

                });
                // end of second ajax request
            })
            .catch((error) => {
                // console.log("Error: ", error);
            });
    });
});

function message_fetch() {
    let otherUserId = $("#departmentContainer #departman select")
        .find(":selected")
        .val();

    window.YelsuOtherUserId = otherUserId;

    let departmentContainer = document.getElementById("departmentContainer");

    axios
        .post("/fetchSpecialistFinal", {
            otherUserId: otherUserId,
        })
        .then((response) => {
            let htmlChat;
            let chatBody = "";

            let chatContactFormImage = window.location.origin + "/adminbackend/assets/media/misc/chat-contact-form.png";
            
            let clientAvatar = response.data.otherUserObj.photo
                ? window.location.origin +
                  "/storage/upload/specialist_images/" +
                  response.data.otherUserObj.photo
                : window.location.origin + "/storage/upload/no_image.jpg";

            let sendBtnIcon =
                window.location.origin + "/frontend/assets/images/send.svg";

            let clientFullName =
                response.data.otherUserObj.firstname +
                " " +
                response.data.otherUserObj.lastname;

            let categoryName = response.data.categoryName;

            departmentContainer.remove();
            let chatBox = $(".chatBox");

            chatBox.show();
            
            if (!response.data.messagesObj && !response.data.loginStatus) {

                htmlChat = `
                <div class="titleName">
                        سامانه گفتگوی آنلاین
                        <span id="btnCloseChat">
                            <svg fill="#ffffff" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                        </span>
                    </div>
                    <div class="client">
                        <img src="${clientAvatar}" alt="logo">
                        <div class="clientInfo">
                            <div class="client-name">
                                ${clientFullName}
                            </div>
                            <div class="clientDesc">
                                کارشناس ${categoryName}  
                            </div>
                        </div>
                    </div>
                    <div class="chats">

                    <div class="chatStartForm mt-3">
                        <img src="${chatContactFormImage}" style="display:flex; margin-left:auto; margin-right:auto; width: 140px;">
                        <p class="chatTitleStart mb-0">لطفا اطلاعات تماس خود را وارد نمایید</p>
                            <p id="chatFormInputError"">لطفا همه فیلد ها را به درستی وارد نمایید</p>
                            <div class="form-group d-flex justify-content-between mt-1">
                                <label for="chatUserFirstname">نام:</label>
                                <input type="text" id="chatUserFirstname">
                            </div>
                            <div class="form-group d-flex justify-content-between mt-1">
                                <label for="chatUserLastname">نام خانوادگی:</label>
                                <input type="text" id="chatUserLastname">
                            </div>
                            <div class="form-group d-flex justify-content-between mt-1">
                                <label for="chatUserPhone">شماره تلفن:</label>
                                <input type="number" id="chatUserPhone">
                            </div>
                            <div class="form-group d-flex justify-content-between mt-1">
                                <label for="chatUserEmail">ایمیل:</label>
                                <input type="email" id="chatUserEmail">
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <button id="chatUserSubmitBtn" type="submit" class="btn btn-primary btn-rounded">
                                ارسال
                                <i id="spinnerChatCForm" class="fas fa-spinner fa-spin"></i>
                                </button>
                            </div>
                    </div>
                    
                    <div id="listMessages" class="chatBody">
                        ${chatBody}
                    </div>
                    </div>
                    <div class="chatInput" style="display:none;">
                        <input id="inputMessage" type="text" placeholder="پیام خود را بنویسید...">
                        <button id="inputMessageBtn" class="sendBtn">
                            <img src="${sendBtnIcon}" alt="chat box"/>
                        </button>
                    </div>
                `;

            } else if(!response.data.messagesObj && response.data.loginStatus) {
                htmlChat = `
                <div class="titleName">
                        سامانه گفتگوی آنلاین
                        <span id="btnCloseChat">
                            <svg fill="#ffffff" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                        </span>
                    </div>
                    <div class="client">
                        <img src="${clientAvatar}" alt="logo">
                        <div class="clientInfo">
                            <div class="client-name">
                                ${clientFullName}
                            </div>
                            <div class="clientDesc">
                                کارشناس ${categoryName}  
                            </div>
                        </div>
                    </div>
                    <div class="chats">

                    <div id="listMessages" class="chatBody">
                        ${chatBody}
                    </div>
                    </div>
                    <div class="chatInput">
                        <input id="inputMessage" type="text" placeholder="پیام خود را بنویسید...">
                        <button id="inputMessageBtn" class="sendBtn">
                            <img src="${sendBtnIcon}" alt="chat box"/>
                        </button>
                    </div>
                `;
            } else {
                response.data.messagesObj.forEach((msgItem) => {
                    if(msgItem.message != null) {
                        if (msgItem.userId == response.data.userId) {
                            chatBody += `
                            <div class="myChat">
                                <div class="chatBoxContent">
                                    <div class="chatText">
                                        ${msgItem.message}
                                    </div>
                                    
                                </div>
                                <div class="chatTime">${msgItem.jdate}</div>
                            </div>
                        `;
                        } else {
                            chatBody += `
                            <div class="clientChat">
                                    <div class="chatBoxContent">
                                        <img src="${clientAvatar}" alt="logo">
                                        <div class="chatText">
                                         ${msgItem.message}
                                        </div>
                                    </div>
                                    <div class="chatTime">${msgItem.jdate}</div>
                                </div>
                            `;
                        }
                    }
                });

                htmlChat = `                               

                <div class="titleName">
                        سامانه گفتگوی آنلاین
                        <span id="btnCloseChat">
                            <svg fill="#ffffff" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                        </span>
                    </div>
                    <div class="client">
                        <img src="${clientAvatar}" alt="logo">
                        <div class="clientInfo">
                            <div class="client-name">
                                ${clientFullName}
                            </div>
                            <div class="clientDesc">
                                کارشناس ${categoryName}  
                            </div>
                        </div>
                    </div>
                    <div class="chats">
                        <div id="listMessages" class="chatBody">
                            ${chatBody}
                        </div>
                    </div>
                    <div class="chatInput">
                        <input id="inputMessage" type="text" placeholder="پیام خود را بنویسید...">
                        <button id="inputMessageBtn" class="sendBtn">
                            <img src="${sendBtnIcon}" alt="chat box"/>
                        </button>
                    </div>
                `;
            }

            chatBox.html(htmlChat);

            $("#btnCloseChat").click(() => {
                $(".chatBox").slideUp("slow");
            });

            $(".chatBtn").click(() => {
                $(".chatBox").slideToggle("slow");
            });

            window.YelsuRoomId = response.data.roomId;
            window.YelsuCurrentUserId = response.data.userId;

            // send first form function
            if(!response.data.messagesObj && !response.data.loginStatus) {
                let chatUserSubmitBtn = document.getElementById("chatUserSubmitBtn");
                chatUserSubmitBtn.addEventListener("click", function() {
                    chatUserFirstSubmit();
                });

                $('.chatStartForm input').keypress(function(e){
                    if(e.which == 13){
                        chatUserFirstSubmit();
                    }
                });

                $('#chatFormInputError').hide();

                function chatUserFirstSubmit() {
                    let chatUserFirstname = document.getElementById("chatUserFirstname").value;
                    let chatUserLastname = document.getElementById("chatUserLastname").value;
                    let chatUserPhone = document.getElementById("chatUserPhone").value;
                    let chatUserEmail = document.getElementById("chatUserEmail").value;

                    $('#spinnerChatCForm').show();
                    
                    let formData = {
                        'chatUserFirstname':chatUserFirstname, 
                        'chatUserLastname':chatUserLastname, 
                        'chatUserPhone':chatUserPhone,
                        'chatUserEmail':chatUserEmail
                    }

                    axios
                    .post("/sendfirstform", {
                        formData: JSON.stringify(formData),
                        otherUserId: YelsuOtherUserId
                    })
                    .then((response) => {
                        if(response.data.success == true) {
                            
                            $('.chatStartForm').hide();
                            $('.chatInput').show();
                        } else {
                            $('#spinnerChatCForm').hide();
                                
                            if(!response.data.chatUserFirstname) {
                                $('#chatUserFirstname').addClass('invalidForm');
                                $('#chatFormInputError').addClass('invalidForm');
                                $('#chatFormInputError').show();
                            } else {
                                $('#chatUserFirstname').removeClass('invalidForm');
                            }

                            if(!response.data.chatUserLastname) {
                                $('#chatUserLastname').addClass('invalidForm');
                                $('#chatFormInputError').addClass('invalidForm');
                                $('#chatFormInputError').show();
                            } else {
                                $('#chatUserLastname').removeClass('invalidForm');
                            }

                            if(!response.data.chatUserPhone) {
                                $('#chatUserPhone').addClass('invalidForm');
                                $('#chatFormInputError').addClass('invalidForm');
                                $('#chatFormInputError').show();
                            } else {
                                $('#chatUserPhone').removeClass('invalidForm');
                            }

                            if(!response.data.chatUserEmail) {
                                $('#chatUserEmail').addClass('invalidForm');
                                $('#chatFormInputError').addClass('invalidForm');
                                $('#chatFormInputError').show();
                            } else {
                                $('#chatUserEmail').removeClass('invalidForm');
                            }
                        }
                    })
                    .catch((error) => {
                        // console.log("Error: ", error);
                    });
                }
            }
            // end of - first form



            // send chat function
            let formBtn = document.getElementById("inputMessageBtn");
            let inputMessage = document.getElementById("inputMessage");

            function sendItemPack() {
                let userInput = inputMessage.value;

                let newChatInput = `
                <div class="myChat">
                    <div class="chatBoxContent">
                        <div class="chatText">
                            ${userInput}
                        </div>
                    </div>
                    <div class="chatTime">چند لحظه گذشته</div>
                </div>
                `;

                $("#listMessages").append(newChatInput);

                //auto scroll function
                $(".chatBody").animate(
                    { scrollTop: $(".chatBody").prop("scrollHeight") },
                    "fast"
                );

                axios
                    .post("/sendmessage", {
                        message: userInput,
                        otherUserId: YelsuOtherUserId,
                    })
                    .then((response) => {
                        roomId = response.data.roomId;
                        // console.log(roomId);
                    })
                    .catch((error) => {
                        // console.log("Error: ", error);
                    });

                $("#inputMessage").val("");
            }
            inputMessage.addEventListener("keypress", function onEvent(event) {
                if (event.key === "Enter" && inputMessage.value) {
                    sendItemPack();
                }
            });

            formBtn.addEventListener("click", function (event) {
                if(inputMessage.value) {
                    sendItemPack();
                }
            });
            // end of send chat function
        })
        .catch((error) => {
            // console.log("Error: ", error);
        });
}

function fetchData() {
    axios
        .post("/fetchSpecialistLongPolling", {
            otherUserId: YelsuOtherUserId,
        })
        .then((response) => {
            
            if (response.data.messageStatus) {
                let htmlChat;
                let chatBody = "";

                let clientAvatar = response.data.otherUserObj.photo
                    ? window.location.origin +
                      "/storage/upload/specialist_images/" +
                      response.data.otherUserObj.photo
                    : window.location.origin + "/storage/upload/no_image.jpg";

                if (!response.data.messagesObj) {
                    htmlChat = `
                    <div class="chats">
                        <div id="listMessages" class="chatBody">
                            <h3 id="sendUrMsg">
                            
                            </h3>
                        </div>
                    </div>
                `;
                } else {
                    response.data.messagesObj.forEach((msgItem) => {
                        if(msgItem.message) {
                            if(msgItem.userId == response.data.userId) {
                                chatBody += `
                            <div class="myChat">
                                <div class="chatBoxContent">
                                    <div class="chatText">
                                        ${msgItem.message}
                                    </div>
                                    
                                </div>
                                <div class="chatTime">${msgItem.jdate}</div>
                            </div>`;
                            } else {
                                chatBody += `
                            <div class="clientChat">
                                    <div class="chatBoxContent">
                                        <img src="${clientAvatar}" alt="logo">
                                        <div class="chatText">
                                         ${msgItem.message}
                                        </div>
                                    </div>
                                    <div class="chatTime">${msgItem.jdate}</div>
                                </div>
                            `;
                            }
                        }
                    });

                    htmlChat = `                               
                    ${chatBody}
                `;
                }

                $(".chatBody").html(htmlChat);

                window.YelsuRoomId = response.data.roomId;
                window.YelsuCurrentUserId = response.data.userId;

                //auto scroll function
                $(".chatBody").animate(
                    { scrollTop: $(".chatBody").prop("scrollHeight") },
                    "fast"
                );
            }
        })
        .catch((error) => {
            // console.log("Error: ", error);
        });
}


