$("#kt_app_content_container").on("change", "#freightagetype_selection select", function(){
    let freightagetype_title = $('option:selected', this).attr('freightagetype_title');
    freightagetypeState(freightagetype_title)
});

$(document).ready(function(){
    let freightagetype_selection = $("#freightagetype_selection select");
    let freightagetype_title = $('option:selected', freightagetype_selection).attr('freightagetype_title');
    freightagetypeState(freightagetype_title)
});

function freightagetypeState(freightagetype_title) {
    let road_loader = $(".road-loader");
    let rail_loader = $(".rail-loader");
    let sea_loader = $(".sea-loader");
    let air_loader = $(".air-loader");
    let post_loader = $(".post-loader");

    switch (freightagetype_title) { 
        case 'none': 
            hideAllLoaders();
            break;
        case 'road': 
            showRoadLoader();
            break;
        case 'rail': 
            showRailLoader()
            break;
        case 'sea': 
            showSeaLoader()
            break;
        case 'air': 
            showAirLoader()
            break;
        case 'post': 
            showPostLoader()
            break;    
        default:
            hideAllLoaders();
            break;
    }

    function showRoadLoader() {
        road_loader.removeClass("d-none");

        rail_loader.addClass("d-none");
        sea_loader.addClass("d-none");
        air_loader.addClass("d-none");
        post_loader.addClass("d-none");
    }

    function showRailLoader() {
        rail_loader.removeClass("d-none");

        road_loader.addClass("d-none");
        sea_loader.addClass("d-none");
        air_loader.addClass("d-none");
        post_loader.addClass("d-none");
    }

    function showSeaLoader() {
        sea_loader.removeClass("d-none");
        
        rail_loader.addClass("d-none");
        road_loader.addClass("d-none");
        air_loader.addClass("d-none");
        post_loader.addClass("d-none");
    }

    function showAirLoader() {
        air_loader.removeClass("d-none");

        rail_loader.addClass("d-none");
        sea_loader.addClass("d-none");
        road_loader.addClass("d-none");
        post_loader.addClass("d-none");
    }

    function showPostLoader() {
        post_loader.removeClass("d-none");

        rail_loader.addClass("d-none");
        sea_loader.addClass("d-none");
        air_loader.addClass("d-none");
        road_loader.addClass("d-none");
    }

    function hideAllLoaders() {
        post_loader.addClass("d-none");
        rail_loader.addClass("d-none");
        sea_loader.addClass("d-none");
        air_loader.addClass("d-none");
        road_loader.addClass("d-none");
    }
}