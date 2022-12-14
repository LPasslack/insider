<?php
// Get content width
$content_max_width       = absint( $this->get( 'content_max_width' ) );

// Get template colors
$theme_color             = $this->get_customizer_setting( 'theme_color' );
$text_color              = $this->get_customizer_setting( 'text_color' );
$muted_text_color        = $this->get_customizer_setting( 'muted_text_color' );
$border_color            = $this->get_customizer_setting( 'border_color' );
$link_color              = $this->get_customizer_setting( 'link_color' );
$header_background_color = $this->get_customizer_setting( 'header_background_color' );
$header_color            = $this->get_customizer_setting( 'header_color' );

$font_Roboto = "'Roboto', sans-serif;";

?>
/* Generic WP styling */

.alignright {
	float: right;
}

a {
	text-decoration:none;
}

.alignleft {
	float: left;
}

.aligncenter {
	display: block;
	margin-left: auto;
	margin-right: auto;
}

.amp-wp-enforced-sizes {
	/** Our sizes fallback is 100vw, and we have a padding on the container; the max-width here prevents the element from overflowing. **/
	max-width: 100%;
	margin: 0 auto;
}

.amp-wp-unknown-size img {
	/** Worst case scenario when we can't figure out dimensions for an image. **/
	/** Force the image into a box of fixed dimensions and use object-fit to scale. **/
	object-fit: contain;
}

/* Template Styles */

.amp-wp-content,
.amp-wp-title-bar div {
	<?php if ( $content_max_width > 0 ) : ?>
	margin: 0 auto;
	max-width: <?php echo sprintf( '%dpx', $content_max_width ); ?>;
	<?php endif; ?>
}

html {
	background: #fff;
}

body {
	background: <?php echo sanitize_hex_color( $theme_color ); ?>;
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	font-family: <?php echo $font_Roboto; ?>
	font-weight: 400;
	line-height: 1.5em;
}

p,
ol,
ul,
figure {
	margin: 0 0 1em;
	padding: 0;
}

a,
a:visited {
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
}

a:hover,
a:active,
a:focus {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
}

/* Quotes */

blockquote {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	background: rgba(127,127,127,.125);
	border-left: 2px solid <?php echo sanitize_hex_color( $link_color ); ?>;
	margin: 8px 0 24px 0;
	padding: 16px;
}

blockquote p:last-child {
	margin-bottom: 0;
}

.amp-wp-single-title {
	font-family:<?php echo $font_Roboto; ?>
	text-align:center;
	color:#111;
	line-height:1.1em;
	margin-bottom:10px;
	font-size:32px;
}

.text-center {
	text-align:center;
}

/* Header */

.amp-wp-header {
  background:#fff;
  border-bottom:1px solid #eaeaea;
  z-index:9999;
  position:fixed;
  text-align:center;
  top:0;
  left:0;
  width:100%;
}

.amp-wp-header div {
	color: <?php echo sanitize_hex_color( $header_color ); ?>;
	font-size: 1em;
	font-weight: 400;
	position: relative;
  height:70px;
  line-height:70px;
}

.amp-wp-header .navbar-toggle {
  left:15px;
}

.amp-wp-header .navbar-toggle,
.amp-wp-header .navbar-search {
  position:absolute;
  padding:0;
  border:0 none;
  background:none;
  font-size:16px;
  line-height:70px;
}

.amp-wp-header .navbar-search {
  color:#111;
  right:15px;
}

h1,h2,h3,h4,h5,h6 {
	font-family:<?php echo $font_Roboto; ?>
	color:#111;
	text-transform:none;
	line-height:1.1em;
}

.amp-wp-wrapper {
  background:#fff;
  position:relative;
  max-width:780px;
  margin:0 auto;
}

.amp-wp-article {
	color: #666;
	font-weight: 400;
	margin: 0 auto;
	max-width: 840px;
	overflow-wrap: break-word;
	word-wrap: break-word;
}

.amp-wp-article-header {
	align-items: center;
	align-content: stretch;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	margin: 1.5em 16px 1.5em;
}

.amp-wp-title {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	display: block;
	flex: 1 0 100%;
	font-weight: 900;
	margin: 0 0 .625em;
	width: 100%;
}

.amp-wp-meta {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	display: inline-block;
	flex: 2 1 50%;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0;
	padding: 0;
}

.amp-wp-article-header .amp-wp-meta:last-of-type {
	text-align: right;
}

.amp-wp-article-header .amp-wp-meta:first-of-type {
	text-align: left;
}

.tt-blog-nav-label {
	font-size:11px;
	color:#b5b5b5;
}

.amp-wp-byline amp-img,
.amp-wp-byline .amp-wp-author {
	display: inline-block;
	vertical-align: middle;
}

.amp-wp-meta {
	color:#111;
}

.amp-wp-article-featured-image {
	padding-top:20px ;
	margin-top:20px ;
	border-top:1px solid #eee;
}

.amp-wp-meta time {
	color:#b5b5b5;
}

.amp-wp-byline amp-img {
	border: 1px solid <?php echo sanitize_hex_color( $link_color ); ?>;
	border-radius: 50%;
	position: relative;
	margin-right: 6px;
}

.amp-wp-posted-on {
	text-align: right;
}

.amp-wp-article-featured-image {
	margin-top:1em;
  margin-bottom:1em;
}
.amp-wp-article-featured-image amp-img {
	margin: 0 auto;
}
.amp-wp-article-featured-image.wp-caption .wp-caption-text {
	margin: 0 18px;
}

.amp-wp-article-content ul,
.amp-wp-article-content ol {
	margin-left: 1em;
}

.amp-wp-article-content amp-img {
	margin: 0 auto;
}

.amp-wp-article-content amp-img.alignright {
	margin: 0 0 1em 16px;
}

.amp-wp-article-content amp-img.alignleft {
	margin: 0 16px 1em 0;
}

.wp-caption {
	padding: 0;
}

.wp-caption.alignleft {
	margin-right: 16px;
}

.wp-caption.alignright {
	margin-left: 16px;
}

.wp-caption .wp-caption-text {
	border-bottom: 1px solid #eee;
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0;
	padding: .66em 10px .75em;
}

amp-iframe,
amp-youtube,
amp-instagram,
amp-vine {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}

.amp-wp-article-content amp-carousel amp-img {
	border: none;
}

amp-carousel > amp-img > img {
	object-fit: contain;
}

.amp-wp-iframe-placeholder {
	background: <?php echo sanitize_hex_color( $border_color ); ?> url( <?php echo esc_url( $this->get( 'placeholder_image_url' ) ); ?> ) no-repeat center 40%;
	background-size: 48px 48px;
	min-height: 48px;
}

.amp-wp-comments-link {
  display:none;
}

.post-pagination {
  padding:20px 0 25px 0;
  border-top:1px solid #eee;
  border-bottom:1px solid #eee;
}


.post-pagination h5,
.post-pagination a {
	margin:0;
	text-decoration:none;
}

.post-pagination a:hover h5 {
	color:#666;
}

.amp-wp-tax-category,
.amp-wp-tax-tag {
	color: #111 ;
	font-size: .875em;
	line-height: 1.5em;
}

.amp-wp-tax-tag a {
	color:#b5b5b5;
	text-decoration:none;
}

.amp-wp-comments-link {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	text-align: center;
	margin: 2.25em 0 1.5em;
}

.amp-wp-comments-link a {
	border-style: solid;
	border-color: <?php echo sanitize_hex_color( $border_color ); ?>;
	border-width: 1px 1px 2px;
	border-radius: 4px;
	background-color: transparent;
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
	cursor: pointer;
	display: block;
	font-size: 14px;
	font-weight: 600;
	line-height: 18px;
	margin: 0 auto;
	max-width: 200px;
	padding: 11px 16px;
	text-decoration: none;
	width: 50%;
	-webkit-transition: background-color 0.2s ease;
	transition: background-color 0.2s ease;
}

.amp-wp-footer {
	margin-top:23px;
}

.amp-wp-footer h2 {
	font-size: 1em;
	line-height: 1.375em;
	margin: 0 0 .5em;
}

.amp-wp-footer p {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .8em;
	line-height: 1.5em;
	margin: 0 85px 0 0;
}

.amp-wp-footer a {
	text-decoration: none;
}

.back-to-top {
	bottom: 1.275em;
	font-size: .8em;
	font-weight: 600;
	line-height: 2em;
	position: absolute;
	right: 16px;
}

.tt-comment {
  list-style: none;
  margin-bottom: -15px;
}

.tt-comment-container {
  margin-bottom: 25px;
}

.tt-comment-avatar {
  float: left;
  width: 40px;
  height: 40px;
  -moz-border-radius: 100%;
  border-radius: 100%;
  overflow: hidden;
}

.tt-comment-avatar img {
  -moz-border-radius: 100%;
  border-radius: 100%;
}

.tt-comment-info {
  padding-left: 50px;
  padding-top: 10px;
}

.tt-comment-label {
  font-family: 'Roboto';
  font-size: 14px;
  line-height: 18px;
  font-weight: 400;
  color: #b5b5b5;
  margin-bottom: 5px;
}

.tt-comment-label span:after {
  content: '•';
  display: inline-block;
  padding-left: 4px;
  padding-right: 1px;
}

.tt-comment-label span:last-child:after {
  display: none;
}

.tt-comment-label a {
  font-weight: 700;
  color: #111;
  text-decoration:none;
}

.tt-comment-label a:hover {
  color: #51c8fa;
}

.tt-comment-info .simple-text {
  margin-bottom: 5px;
}

.tt-comment-reply,
.comment-reply-link,
.comment-edit-link {
  font-size: 13px;
  line-height: 17px;
  font-weight: 500;
  color: #111;
}

.tt-comment-reply .fa,
.comment-reply-link .fa {
  color: #ccc;
  margin-right: 6px;
  -webkit-transition: all 300ms ease-in-out;
  -moz-transition: all 300ms ease-in-out;
  transition: all 300ms ease-in-out;
}

.tt-comment-reply:hover,
.tt-comment-reply:hover .fa,
.comment-reply-link:hover,
.comment-reply-link:hover .fa,
.comment-edit-link:hover {
  color: #51c8fa;
}

.tt-comment .children {
  list-style: none;
  padding-left: 35px;
}

.tt-comment .children .tt-comment-avatar {
  width: 30px;
  height: 30px;
}

.tt-comment-container p {
  margin-bottom: 0px;
  font-size:13px;
  line-height:1.6em;
  color:#666;
}

.tt-comment .children .tt-comment-info {
  padding-left: 40px;
  padding-top: 2px;
}

@media (max-width:767px) {
  .tt-comment-container {
    text-align: center;
  }
  .tt-comment-avatar {
    display: inline-block;
    float: none;
    margin-bottom: 10px;
  }
  .tt-comment-info {
    padding-left: 0;
  }
  .tt-comment .children {
    padding-left: 0;
  }
  .tt-comment .children .tt-comment-info {
    padding-left: 0;
  }
}

.tt-comment li.pingback {
  padding-bottom: 12px;
  margin-bottom: 12px;
  border-bottom: 1px solid #e1e1e1;
}

.tt-comment li.pingback a {
  color: #51c8fa;
}


.tt-comment li.pingback:last-child {
  margin-bottom: 25px ;
}


.comment-form .tt-comment-form-ava {
  float: left;
  display: block;
  width: 40px;
  border-radius: 50%;
}

.tt-comment-form-content,
.tt-comment-form {
  padding-left: 55px;
  padding-top: 6px;
}

p.logged-in-as {
  margin-bottom: 10px ;
  font-size:12px;
  color:#b5b5b5;
}

.tt-comment-form {
  padding-left: 0;
}

.tt-comment-form .c-area {
  margin-bottom: 10px;
  border:1px solid #eee;
  width:100%;
  padding:12px 15px;
  box-sizing:border-box;
  -webkit-box-sizing:border-box;
  color:#b5b5b5;
  font-family:<?php echo $font_Roboto; ?>
}

.tt-comment-form .c-input {
  margin-bottom: 19px;
}

.tt-comment-form .c-btn {
  margin-top: -17px;
}

@media (max-width:767px) {
  .tt-comment-form-ava {
    float: none;
    margin: 0 auto 10px auto;
  }
  .tt-comment-form-content {
    padding-left: 0;
  }
}

.tt-title-block-2 {
	text-align:center;
}

.coment-item {
	margin:0 16px;
	border-top:1px solid #eee;
	margin-top:20px;
}

#reply-title {
	font-size:18px;
	margin-bottom:0;
}

.tt-comment-form input[type="submit"] {
	border:0 none;
	background:#666;
	color:#fff;
	padding:10px;
}

.tt-share-icons {
  margin-top:-12px;
}

.tt-share-buttons {
  margin-bottom:10px;
}

.post-pagination {
  overflow:hidden;
}

.amp-wp-article-footer {
  margin-bottom:25px;
}

.prev-post,
.next-post {
  width:50%;
  display:inline-block;
  float:left;
}

.next-post {
  text-align:right;
}

.tt-post-comments {
  margin-top:25px;
}

.button.tt-add-comment {
  background:#51c8fa;
  color:#fff;
  padding:6px 25px;
  font-size:14px;
  font-weight:600;
  margin-top:6px;
  display:inline-block;
}

.button.tt-add-comment:hover {
  opacity:0.8;
}

.author {
  font-weight:600;
  font-size:14px;
}

.comment-content {
  margin-top:2px;
  font-size:13px;
  color:#666;
}

.date {
  color:#b5b5b5;
  font-size:13px;
}

.comments .comment:first-child {
  border:0 none;
}

.tt-comment-title {
  margin-bottom:0;
  margin-top:0;
}

.comments .comment {
  border-top:1px solid #eaeaea;
}

.thecomment {
  width:100%;
  padding-top:15px;
}

.amp-view-desktop-version {
  text-align:center;
  padding:15px 0 21px 0;
  border-top:1px solid #eaeaea;
}
.amp-view-desktop-version .button {
  font-size:13px;
  padding:5px 22px;
}

.amp-view-desktop-version .button i {
  margin-right:5px;
  font-size:12px;
}

.amp-footer-copyright-wrapper {
  background:#000;
  padding:15px 0;
}

.footer-copy-text {
  color:rgba(255,255,255,0.3);
  font-size:11px;
  font-weight:600;
  text-align:center;
}

.amp-inner-wrapper {
  padding:0 15px;
  padding-top:95px;
}

.tt-post-comments.no-comment-yet {
  margin-top:15px;
}

.mobile-sidebar {
  background:#000;
  padding:60px 30px 30px 30px;
  width:270px;
}

.tt-mobile-logo {
  margin-bottom:25px;
  display:block;
}

.tt-mobile-close {
  display: block;
  position: absolute;
  top: 18px;
  right: 20px;
  width: 16px;
  background:none;
  border:0 none;
  height: 16px;
  cursor: pointer;
}

.tt-mobile-close:before,
.tt-mobile-close:after {
  content: "";
  position: absolute;
  display: block;
  top: 7px;
  left: 0;
  width: 100%;
  height: 2px;
  background: #d1d1d1;
  -webkit-transition: all 300ms ease-in-out;
  -moz-transition: all 300ms ease-in-out;
  transition: all 300ms ease-in-out;
}

.tt-mobile-close:before {
  margin-top: -7px;
  -webkit-transform: translateY(7px) rotate(45deg);
  -moz-transform: translateY(7px) rotate(45deg);
  -ms-transform: translateY(7px) rotate(45deg);
  transform: translateY(7px) rotate(45deg);
  -webkit-transform-origin: center center;
  -moz-transform-origin: center center;
  -ms-transform-origin: center center;
  transform-origin: center center;
}

.tt-mobile-close:after {
  margin-top: 7px;
  -webkit-transform: translateY(-7px) rotate(-45deg);
  -moz-transform: translateY(-7px) rotate(-45deg);
  -ms-transform: translateY(-7px) rotate(-45deg);
  transform: translateY(-7px) rotate(-45deg);
  -webkit-transform-origin: center center;
  -moz-transform-origin: center center;
  -ms-transform-origin: center center;
  transform-origin: center center;
}

.tt-mobile-close:hover:before,
.tt-mobile-close:hover:after {
  background: #fff;
}
.tt-mobile-nav ul {
  list-style: none;
}

.tt-mobile-nav>ul>li {
  margin-bottom: 20px;
}

.tt-mobile-nav>ul>li:last-child {
  margin-bottom: 0;
}

.tt-mobile-nav>ul>li>a {
  display: block;
  position: relative;
  font-family: 'Roboto';
  font-size: 13px;
  line-height: 17px;
  font-weight: 400;
  color: #fff;
  opacity: 0.6;
}

.tt-mobile-nav ul li.menu-item-has-children>a:before {
  position: absolute;
  right: 0;
  top: 50%;
  margin-top: -6px;
  font-size: 12px;
  content: '\f107';
  font-family: 'FontAwesome';
}

.tt-mobile-nav>ul>li.active>a,
.tt-mobile-nav>ul>li:hover>a {
  opacity: 0.9;
}

.tt-mobile-nav>ul>li>ul {
  padding-top: 15px;
  padding-left: 18px;
  padding-bottom: 2px;
}

.tt-mobile-nav>ul>li>ul>li,
.tt-mobile-nav>ul>li>ul>li>ul>li {
  margin-bottom: 10px;
}

.tt-mobile-nav>ul>li>ul>li:last-child {
  margin-bottom: 0;
}

.tt-mobile-nav>ul>li>ul>li>a,
.tt-mobile-nav>ul>li>ul>li>ul>li>a {
  position: relative;
  font-family: 'Roboto';
  font-size: 12px;
  line-height: 16px;
  font-weight: 400;
  color: #fff;
  opacity: 0.6;
}

.tt-mobile-nav>ul>li>ul>li>a {
  margin-bottom: 10px;
  display: block;
}

.tt-mobile-nav>ul>li>ul>li.active>a,
.tt-mobile-nav>ul>li>ul>li:hover>a,
.tt-mobile-nav>ul>li>ul>li>ul>li:hover>a {
  opacity: 0.9;
}

.amp-logo {
  display: inline-block;
  max-width: 100%;
  max-height: 100%;
  width: auto;
  height: auto;
  vertical-align: middle;
}

.tt-s-search {
  position: relative;
}

.tt-s-search input[type="text"] {
  width: 100%;
  height: 42px;
  border: 1px solid #eaeaea;
  background: transparent;
  box-sizing:border-box;
  padding-left: 44px;
  padding-right: 15px;
  -webkit-transition: all 300ms ease-in-out;
  -moz-transition: all 300ms ease-in-out;
  transition: all 300ms ease-in-out;
}

.tt-s-search input[type="text"]:focus {
  border-color: #51c8fa;
}

.tt-s-search-submit {
  position: absolute;
  top: 0;
  left: 0;
  width: 42px;
  height: 42px;
  text-align: center;
}

.tt-s-search-submit .fa {
  font-size: 16px;
  color: #51c8fa;
  line-height: 42px;
  font-style: normal;
  -webkit-transition: all 300ms ease-in-out;
  -moz-transition: all 300ms ease-in-out;
  transition: all 300ms ease-in-out;
}

.tt-s-search-submit:hover .fa {
  color: #30373b;
}

.tt-s-search-submit input {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: transparent;
  border: 0;
}

.amp-front-page .amp-inner-wrapper {
  padding-top:0;
}

.tt-homepage-slider {
  padding-top:70px;
  width:100%;
  margin:0;
}

.img-holder {
  position:relative;
  width:100%;
  height:106%;
  background-size:cover;
  background-position:center center;
}

.content-holder {
  position:absolute;
  width:100%;
  text-align:center;
  left:0;
  box-sizing:border-box;
  transform: translateY(-50%);
  -webkit-transform: translateY(-50%); 
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  top:50%;
  padding:0 30px;
}

.content-holder h3 a {
  color:#fff;
}

.slider-item.amp-carousel-slide {
  height:106%;
}

.amp-featured-slider .img-holder:before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.4);
  bottom: 0;
  right: 0;
  transition: opacity 0.3s;
}

.tt-post-list {
  list-style: none;
  margin-top:5px;
}

.tt-post {
  overflow:hidden;
}

.tt-post-list li {
  border-bottom: 1px solid #eaeaea;
  padding:12px 0;
}

.tt-post.type-7 .tt-post-img {
  float: left;
  width: 80px;
}

.tt-post.type-7 .tt-post-info {
  padding: 0 0 0 92px;
}

.tt-post-list li:last-child {
  margin-bottom: 0;
  border-bottom:0;
}

a.tt-post-title  {
  font-size:14px;
  color:#111;
  line-height:18px;
  margin-bottom:5px;
  display:block;
  font-weight:500;
}

.tt-post-label {
  font-size: 12px;
  line-height: 16px;
  font-weight: 400;
  color: #b5b5b5;
}

.tt-post-label span a {
  color:#b5b5b5;
  position:relative;
}

.tt-post-label span a:hover,
a.tt-post-title:hover {
  color:#51c8fa;
}

.tt-post-label span:after {
  content: '•';
  display: inline-block;
  padding-left: 4px;
  padding-right: 1px;
}

.tt-post-label span:last-child:after {
  display: none;
}

.page-numbers {
  font-size: 0;
  list-style: none;
  margin-bottom: -10px;
}

.page-numbers li  {
  display: inline-block;
  margin-right: 10px;
  margin-bottom: 10px;
  height: 30px;
  line-height: 30px;
}

.page-numbers li:last-child {
  margin-right:0;
}

.page-numbers span,
.page-numbers a {
  display: inline-block;
}

.page-numbers a,
.page-numbers span {
  min-width: 30px;
  font-size: 12px;
  line-height: 30px;
  font-weight: 500;
  color: #666;
  text-align: center;
  background: #eaeaea;
  padding: 0 5px;
}

.page-numbers a:hover,
.page-numbers li span.current {
  background: #51c8fa;
  color: #fff;
}

.amp-title-wrapper {
  border-bottom:1px solid #eaeaea;
  padding-bottom:12px;
}

.amp-title-wrapper h1 {
  font-size:20px;
  margin:0;
}

.amp-404 h1 {
  font-size:26px;
  margin-top:0;
  margin-bottom:15px;
}

.amp-404 p {
  font-size:14px;
}

[class*="amp-wp-inline"].gif-showcase {
  padding-bottom:0;
}

.tt-post-img.swiper-container {
  display:none;
}

amp-carousel .amp-carousel-button.amp-disabled {
  opacity:1;
  visibility:visible;
}

.tt-search-page .amp-title-wrapper {
  padding-top:12px;
}

.tt-related-posts {
  position:relative;
  overflow:hidden;
  border-bottom:1px solid #eaeaea;
  padding-bottom:25px;
  margin-bottom:15px;
}

.tt-related-post-col {
  width:30.40%;
  display:inline-block;
  float:left;
  padding-right:15px;
}

.tt-related-post-col:last-of-type {
  padding-right:0;
}

.tt-post-info {
  padding-top:10px;
}

.tt-post-info .c-h5 {
  font-size:16px;
  line-height:1.2;
}

.tt-google-amp-ads {
  margin: 0 0 30px;
  text-align: center;
  overflow: hidden;
  display: block;
  width: 100%;
}