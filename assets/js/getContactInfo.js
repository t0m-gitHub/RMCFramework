$(function(){
    var me = new RMC.Me();
    me.getBaseInfo({}, function(data){
        var responseObject = $.parseJSON(data);
        $("#email").html('<a href="mailto:'+responseObject.data.email+'">'+responseObject.data.email+'</a>');
        $("#phone").html(responseObject.data.phone);
    });
})