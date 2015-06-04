/**
 * Created by ejayjr on 03.06.15.
 */
$(document).ready(function (){
    templateImg();
    loadImg();
    eventImg();
});
/**
 * Template Img block
 */
function templateImg(){
    imageTag = '<a href="#"><img id="%id%" src="%path%"/></a>';
}
/**
 * ajax request current img info
 */
function loadImg(){
    var domain = location.protocol+'//'+location.host;
    var hash = $('#AvsBlock').data('hash');
    $.ajax({
        url: 'http://avsproduct.local/api/v1/banner/ads?hash_block='+hash+'&host='+domain,
        type: 'GET',
        dataType: 'json',
        crossDomain: true,
        success: function(data){
            if(data.name != "Exception403")
            {
                var img = $.parseHTML(imageTag.replaceArray(
                    ['%id%', '%path%', '%action_url%'],
                    [data.id, data.picture.base_url+'/'+data.picture.path, data.action_url]
                ));
                $('#AvsBlock').append(img);
            }
        }
    });
}
/**
 * event image and request add info
 */
function eventImg(){
    $('#AvsBlock').click(function(){
        var domain = location.protocol+'//'+location.host;
        var ipAddress = myIP();
        var ads_id = $(this).find('img').attr('id');
        $.ajax({
            url: 'http://avsproduct.local/api/v1/banner/event',
            type: 'POST',
            dataType: 'json',
            crossDomain: true,
            data: {
                ipAddress:ipAddress,
                ads_id:ads_id,
                domain:domain
            },
            success: function(data){
            }
        });
    });

}

String.prototype.replaceArray = function(find, replace) {
    var replaceString = this;
    for (var i = 0; i < find.length; i++) {
        replaceString = replaceString.replace(find[i], replace[i]);
    }
    return replaceString;
};

function myIP() {
    if (window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
    else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

    xmlhttp.open("GET","http://api.hostip.info/get_html.php",false);
    xmlhttp.send();

    hostipInfo = xmlhttp.responseText.split("\n");

    for (i=0; hostipInfo.length >= i; i++) {
        ipAddress = hostipInfo[i].split(":");
        if ( ipAddress[0] == "IP" ) return ipAddress[1];
    }
    return false;
}