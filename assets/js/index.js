$(function(){
    $('.navbar a, .subnav a').smoothScroll();
    $("#email").html('<img src="assets/img/ajax-loader.gif" />');
    $("#phone").html('<img src="assets/img/ajax-loader.gif" />');

    var me = new RMC.Me();
    me.getBaseInfo({}, function(data){
        var responseObject = $.parseJSON(data);
        $("#email").html('<a href="mailto:'+responseObject.data.email+'">'+responseObject.data.email+'</a>');
        $("#phone").html(responseObject.data.phone);
    });
})