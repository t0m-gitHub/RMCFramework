
var RMCModel = function() {}

RMCModel.prototype.doRequest = function(methodName, callback){
    var data = {
        modelName : this.modelName,
        calledMethod : methodName
    }
    if(callback === undefined){
        return $.ajax({
            url: '/RMCFramework/index.php?action=RemoteModelCall',
            type: 'POST',
            data: JSON.stringify(data),
            async: false,
            contentType: 'application/json; charset=utf-8'
        }).responseText;
    } else {
        $.ajax({
            url: '/RMCFramework/index.php?action=RemoteModelCall',
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json; charset=utf-8',
            success: callback
        })
    }

}

RMC = {
    Me: function(){},
    Resume: function(){}
}

RMC.Me.prototype = new RMCModel();
RMC.Me.prototype.modelName = 'Me';
RMC.Me.prototype.getFullInfo = function (callback){
    return this.doRequest('getFullInfo', callback);
}
RMC.Me.prototype.getBaseInfo = function (callback){
    return this.doRequest('getBaseInfo', callback);
}

RMC.Resume.prototype = new RMCModel();
RMC.Resume.prototype.modelName = 'Resume';
RMC.Resume.prototype.getMySkills = function (callback){
    return this.doRequest('getMySkills', callback);
};