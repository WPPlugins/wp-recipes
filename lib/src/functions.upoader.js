jQuery(document).ready(function() {

  jQuery('#klantenreactieFotoUploader .actionBrowse').click(function() {
    var itemLocator = jQuery(jQuery(this)).parent().parent();
    window.send_to_editor = function(html) {
      imgurlInput = jQuery('img',html).attr('src');
      imgurl = imgurlInput.replace("http://"+window.location.hostname, "");
      
//      alert(imgurl);
//      alert(window.location.hostname);
      tb_remove();
      jQuery(itemLocator).find("input").val(imgurl);
      jQuery(itemLocator).find("img").attr("src", imgurl)
    }
//      alert(imgurl);
    tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
    jQuery(itemLocator).find("a").addClass("visible");
    return false;
  });

  jQuery('#klantenreactieFotoUploader .actionDelete').click(function() {
    jQuery(jQuery(this)).parent().parent().find("div img").attr("src", "/wp-content/plugins/42A-klantenreacties/images/42Autos-img-noauto.jpg")
    jQuery(jQuery(this)).parent().parent().find("input").val("");
    jQuery(jQuery(this)).parent().parent().find("a").removeClass("visible");
    return false;
  });

});