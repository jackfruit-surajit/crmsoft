<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <title>
        <?php echo e(get_option('companyname')); ?> - <?php echo _l('admin_auth_login_heading'); ?>
    </title>
<!-- Progressive Web App (PWA) Meta & Manifest -->
    <link rel="manifest" href="<?php echo base_url('manifest.json'); ?>">
    <meta name="theme-color" content="#0b0d14">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="BEETRX CRM">
    <link rel="apple-touch-icon" href="<?php echo base_url('assets/images/icons/apple-touch-icon.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('assets/images/icons/icon-152x152.png'); ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?php echo base_url('assets/images/icons/icon-192x192.png'); ?>">
    <script src="<?php echo base_url('assets/js/pwa-install.js'); ?>" defer></script>
    <?php echo app_compile_css('admin-auth'); ?>
    <link rel="stylesheet" type="text/css" id="fontawesome-css" href="<?php echo base_url('assets/plugins/font-awesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" id="fontawesome-solid" href="<?php echo base_url('assets/plugins/font-awesome/css/solid.min.css'); ?>">
    <link rel="stylesheet" type="text/css" id="fontawesome-regular" href="<?php echo base_url('assets/plugins/font-awesome/css/regular.min.css'); ?>">
    <style>
    body,
    html {
        font-size: 16px;
    }

    body>* {
        font-size: 14px;
    }

    body {
        font-family: "Inter", sans-serif;
        color: #475569;
        margin: 0;
        padding: 0;
    }

    .company-logo {
        padding: 25px 10px;
        display: block;
    }

    .company-logo img {
        margin: 0 auto;
        display: block;
    }

    @media screen and (max-height: 575px),
    screen and (min-width: 992px) and (max-width:1199px) {

        #rc-imageselect,
        .g-recaptcha {
            transform: scale(0.83);
            -webkit-transform: scale(0.83);
            transform-origin: 0 0;
            -webkit-transform-origin: 0 0;
        }
    }
    </style>
    <?php if (show_recaptcha()) { ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php } ?>
    <?php if (file_exists(FCPATH . 'assets/css/custom.css')) { ?>
    <link href="<?php echo base_url('assets/css/custom.css') . '?v=' . filemtime(FCPATH . 'assets/css/custom.css'); ?>" rel="stylesheet" id="custom-css">
    <?php } ?>
    <?php hooks()->do_action('app_admin_authentication_head'); ?>
</head>