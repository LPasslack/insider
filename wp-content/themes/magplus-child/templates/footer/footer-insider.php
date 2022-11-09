<?php
/**
 * Part of footer file ( default style )
 *
 * @package magplus
 * @since 1.0
 */
$uriSegments = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>
<div class="tt-footer">
  <div class="container">
    <div class="row">
      <?php magplus_footer_columns(); ?>
      <div class="col-md-12"><div class="empty-space marg-lg-b60 marg-sm-b50 marg-xs-b30"></div></div>
    </div>
  </div>
  <div class="tt-footer-copy">
    <div class="container">
    <?php if ($_SERVER['SERVER_NAME'] == 'blog') {
        $str = wp_kses_data(magplus_get_opt('footer-copyright-text'));
        $links = str_replace('href="', 'href="/insider-blog', $str);
        echo $links;
    } ?>
    <?php if ($_SERVER['SERVER_NAME'] == 'v542webdev' && $uriSegments[1] === 'insider-blog-sandbox') {
        $str = wp_kses_data(magplus_get_opt('footer-copyright-text'));
        $links = str_replace('href="', 'href="/insider-blog-sandbox', $str);
        echo $links;
    } ?>
    <?php if ($_SERVER['SERVER_NAME'] == 'v542webdev' && $uriSegments[1] === 'insider-blog') {
        $str = wp_kses_data(magplus_get_opt('footer-copyright-text'));
        $links = str_replace('href="', 'href="/insider-blog', $str);
        echo $links;
    } ?>
    <?php if ($_SERVER['SERVER_NAME'] == 'www.ideal-versicherung.de' && $uriSegments[1] === 'insider-blog') {
        $str = wp_kses_data(magplus_get_opt('footer-copyright-text'));
        $links = str_replace('href="', 'href="/insider-blog', $str);
        echo $links;
    } ?>
    </div>
  </div>
</div>

