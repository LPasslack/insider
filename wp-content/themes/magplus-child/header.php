<?php
/**
 * Header file
 *
 * @package magplus
 * @since 1.0
 */
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--
    Einbindung Lato und Robot Slab
    Gründe für diese Anforderung https://confluence.ideal-services.de/display/NM/Abmahnungsgefahr+bei+Verwendung+externer+Ressourcen
    -->
    <link rel='stylesheet' href='https://www.ideal-versicherung.de/vendor/fonts/lato.css' media='all'>
    <link rel='stylesheet' href='https://www.ideal-versicherung.de/vendor/fonts/roboto-slab.css' media='all'>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="wrapper">

    <?php magplus_loader(); ?>
    <?php magplus_sideheader(); ?>
    <?php search_popup(); ?>
    <?php magplus_popup(); ?>

    <div id="content-wrapper">
        <?php magplus_header_template(magplus_get_opt('header-template')); ?>
        <?php get_template_part('templates/title-wrapper/default'); ?>
