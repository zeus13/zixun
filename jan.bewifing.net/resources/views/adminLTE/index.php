<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>中国移动</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/adminLTE/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminLTE/dist/css/AdminLTE.min.css?1">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/adminLTE/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/adminLTE/plugins/iCheck/flat/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">CMCC</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">中国移动后台管理</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">切换导航</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/adminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/adminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce
                  <small>超级管理员</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                  <a href="#" class="btn btn-default btn-flat">安全退出</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/adminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">菜单</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span> 活动管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a onclick="setIframe(this)" data-url="dialGame" target="main"><i class="fa fa-circle-o"></i> 大转盘游戏</a></li>
            <li><a onclick="setIframe(this)" data-url="guessGame" target="main"><i class="fa fa-circle-o"></i> 竞猜型游戏</a></li>
            <li><a onclick="setIframe(this)" data-url="diglettGame" target="main"><i class="fa fa-circle-o"></i> 打地鼠游戏</a></li>
            <li><a onclick="setIframe(this)" data-url="shakeGame" target="main"><i class="fa fa-circle-o"></i> 摇一摇游戏</a></li>
            <li><a onclick="setIframe(this)" data-url="answerGame" target="main"><i class="fa fa-circle-o"></i> 答题游戏</a></li>
            <li><a onclick="setIframe(this)" data-url="activityList" target="main"><i class="fa fa-circle-o"></i> 活动列表</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a onclick="setIframe(this)" data-url="home" target="main">
            <i class="fa fa-question-circle"></i> <span>帮助</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <iframe scrolling="yes" style="width: 100%; min-height: 1000px; overflow: visible; height: 100%;" name="main" id="main" src="http://jan.app/home" frameborder="0"></iframe> 
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">南宁好无聊</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="/adminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="/adminLTE/bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="/adminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/adminLTE/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/adminLTE/dist/js/app.min.js"></script>
<script type="text/javascript">
  function setIframe(i){
    $('#main').attr("src", 'http://jan.app/'+$(i).data('url'));
  }

  $('.sidebar-menu .treeview').click(function(){
    $(this).addClass('active').siblings('.treeview').removeClass('active');
  });

  $('.sidebar-menu .treeview .treeview-menu li').click(function(){
    $(this).addClass('active').siblings().removeClass('active');
  });
</script>
</body>
</html>
