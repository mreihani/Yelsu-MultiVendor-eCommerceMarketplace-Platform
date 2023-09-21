// chat list auto fetch
function fetchChatData() {
    $.ajax({
        url: "/specialist/private/newMessageCounter",
        method: "get",
        success: function (response) {

            let audio = new Audio( window.location.origin  + '/adminbackend/assets/media/new-message.mp3');

            if(response.totalUnreadMessages == 0) {
                $('.totalUnreadMessages').html("");
            } else if(response.totalUnreadMessages > 99) {
                $('.totalUnreadMessages').html("99+");

                audio.play();
            } else {
                $('.totalUnreadMessages').html(response.totalUnreadMessages);

                audio.play();
            }
        },
    });
}

setInterval(() => {
    fetchChatData();
}, 10000);
// end of chat list auto fetch

$(window).on('click',function(event){
    audio.play();
});


