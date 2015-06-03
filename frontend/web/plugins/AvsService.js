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
    imageTag = '<a id="AvsAction" href="#"><img id="%id%" src="%path%"/></a>';
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
    $('#AvsAction').click(function(){
        alert('click banner');
        $.ajax({
            url: 'http://avsproduct.local/api/v1/banner/event',
            type: 'POST',
            dataType: 'json',
            crossDomain: true,
            data: {},
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