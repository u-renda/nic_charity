<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="<?php echo $this->config->item('title'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images'); ?>/nic-favicon.ico">
    <title><?php echo $this->config->item('title'); ?></title>
  
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/css'); ?>/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/css'); ?>/bootstrap.min.css" rel="stylesheet">
    <!-- Upload image -->
    <link href="<?php echo base_url('assets/css'); ?>/bootstrap-fileinput.css" rel="stylesheet">
    <!-- Datepicker -->
    <link href="<?php echo base_url('assets/css'); ?>/datepicker.css" rel="stylesheet">
    
    <link href="<?php echo base_url('assets/css'); ?>/uniform.default.css" rel="stylesheet">
    
    <!-- Tampilan -->
    <link href="<?php echo base_url('assets/css'); ?>/components.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css'); ?>/plugins.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css'); ?>/layouts.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css'); ?>/default.css" rel="stylesheet">
    
    <style type="text/css">
      .jqstooltip {
        position: absolute;
        left: 0px;
        top: 0px;
        visibility: hidden;
        background: rgb(0, 0, 0) transparent;
        background-color: rgba(0,0,0,0.6);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
        color: white;
        font: 10px arial, san serif;
        text-align: left;
        white-space: nowrap;
        padding: 5px;
        border: 1px solid white;
        z-index: 10000;
      }
      .jqsfield {
        color: white;
        font: 10px arial, san serif;
        text-align: left;
      }
    </style>
    
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css'); ?>/nic.css" rel="stylesheet">
    
    <script src="<?php echo base_url('assets/js'); ?>/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js'); ?>/jquery-1.11.0.min.js" type="text/javascript"></script>
    <!-- Kendo -->
    <link href="<?php echo base_url('assets/css/kendo'); ?>/kendo.common.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/kendo'); ?>/kendo.default.min.css" rel="stylesheet">
    <script src="<?php echo base_url('assets/js/kendo'); ?>/kendo.all.min.js" type="text/javascript"></script>
    <!-- TinyMCE -->
    <script src="<?php echo base_url('assets/js/tinymce'); ?>/tinymce.min.js" type="text/javascript"></script>
  </head>
  <body role="document">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">NIC Charity 2015</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index">Home</a></li>
            <li><a href="user_lists">User</a></li>
            <li><a href="barang_lists">Barang</a></li>
            <li><a href="order_create">Form Penjualan</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>