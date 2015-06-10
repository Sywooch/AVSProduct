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
    imageTag = '<a href="%action_url%"><img id="%id%" src="%path%"/></a>';
    //imageTag = '<a href="#"><img id="%id%" src="%path%"/></a>';
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
                var css = {
                    'height' : data.height,
                    'width' : data.width
                };
                $('#AvsBlock').find('img').css(css);
                if(!getCookie('uniqueUser')){
                    setCookie('uniqueUser',Math.random().toString(36).substring(7),new Date(new Date().getTime() + 1 ));
                    var ads_id = $('#AvsBlock').find('img').attr('id');
                    var domain = location.protocol+'//'+location.host;
                    $.ajax({
                        url: 'http://avsproduct.local/api/v1/banner/view-ads',
                        type: 'POST',
                        dataType: 'json',
                        crossDomain: true,
                        data: {
                            ads_id:ads_id,
                            domain:domain,
                            unique:getCookie('uniqueUser')
                        },
                        success: function(data){
                        }
                    });
                }
            }
        }
    });
}
/**
 * event image and request add info
 */
function eventImg(){
    $('#AvsBlock').click(function(){
        if(!getCookie('uniqueUserClick')) {
            setCookie('uniqueUserClick',Math.random().toString(36).substring(7),new Date(new Date().getTime() + 1 ));
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
        }
    });

}
/**
 * find and replace item
 * @param find
 * @param replace
 * @returns {String}
 */
String.prototype.replaceArray = function(find, replace) {
    var replaceString = this;
    for (var i = 0; i < find.length; i++) {
        replaceString = replaceString.replace(find[i], replace[i]);
    }
    return replaceString;
};

/**
 * get ip address user
 * @returns {*}
 */
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
/**
 * get cookie name
 * @param name
 * @returns {string}
 */
function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
/**
 * set cookie name;
 * @param name
 * @param value
 * @param options
 */
function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }
    document.cookie = updatedCookie;
}