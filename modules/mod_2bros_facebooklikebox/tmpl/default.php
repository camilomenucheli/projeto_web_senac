<?php
/*------------------------------------------------------------------------
# mod_2bros_facebooklikebox - 2Bros Facebook Like Box
# ------------------------------------------------------------------------
# @author - 2brothers.co.nz
# @copyright - 2brothers.co.nz
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: hhttp://2brothers.co.nz/
# Technical Support:  admin@2brothers.co.nz
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die;
?>
<div id="2BrosFacebookLikeBox" class="<?php echo $params->get('moduleclass_sfx');?>">

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb-page" data-href="<?php echo $params->get('pageURL');?>" data-width="<?php echo trim($params->get('width'));?>" data-height="<?php echo trim($params->get('height'));?>" data-hide-cover="<?php echo $params->get('header');?>" data-show-facepile="<?php echo $params->get('showFaces');?>" data-show-posts="<?php echo $params->get('streams'); ?>"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo $params->get('pageURL');?>"><a href="<?php echo $params->get('pageURL');?>">Facebook</a></blockquote></div></div>
        <?php if($params->get('support')==1): ?>
	<div style="width: <?php echo $params->get('width'); ?>px;font-size: 9px; color: #808080; font-weight: normal; font-family: tahoma,verdana,arial,sans-serif; line-height: 1.28; text-align: right; direction: ltr;"><a href="http://www.novusglassrepair.com/" target="_blank" style="color: #808080;" title="visit us">kirkland windshield repair</a></div>
<?php endif; ?>
</div>
