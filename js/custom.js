$(document).ready(function () {

    //Show/Hide menu on hover
    $("#menu-icon").mouseenter(function () {

        $("#display-nav").fadeIn(400);
    });
    
    $("#main-nav").mouseleave(function(){
        
        $("#display-nav").fadeOut(400);
    });
    
    //title
    
    /*function siteTitleHeight () {        
        var hWindow = $(window).height();
        var hSiteTitle = hWindow - 84;
        $("#site-title").css("height", hSiteTitle);    
    };
    
    $(function(){
        
        siteTitleHeight();
        
    });
    
    $(window).resize(function() {    
        siteTitleHeight();
    });
    
    //scrollspy plugin activation
    $('.scrollspy').scrollSpy();*/
});