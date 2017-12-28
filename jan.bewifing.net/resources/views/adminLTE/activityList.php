<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/adminLTE/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
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
  <style type="text/css">
    .content-wrapper {
      margin-left: 0;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
      vertical-align: middle;
    }
  </style>
</head>
<body class="no-skin" style="">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        活动列表
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active">活动列表</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">活动列表</h3>
            </div>
            <div class="box-body">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">全部活动</a></li>
                  <li><a href="#tab_2" data-toggle="tab">进行中</a></li>
                  <li><a href="#tab_3" data-toggle="tab">准备中</a></li>
                  <li><a href="#tab_4" data-toggle="tab">已结束</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <table class="table table-bordered" style="margin-top: 10px;text-align: center">
                      <thead>
                        <tr>
                          <th style="text-align: center">活动类型</th>
                          <th style="text-align: center">活动名称</th>
                          <th style="text-align: center">状态</th>
                          <th style="text-align: center">开始时间</th>
                          <th style="text-align: center">结束时间</th>
                          <th style="text-align: center">每日次数</th>
                          <th style="text-align: center">奖品</th>
                          <th style="text-align: center">概率</th>
                          <th style="text-align: center">操作</th>
                          <th style="text-align: center">活动效果</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>摇一摇</td>
                          <td>双11幸运摇一摇</td>
                          <td>准备中</td>
                          <td>10-28 10:00:00</td>
                          <td>11-12 12:00:00</td>
                          <td>2</td>
                          <td style="padding:0">
                            <table class="table" style="text-align: center;margin-bottom:0">
                              <tbody>
                                <tr>
                                  <td style="border:0">手机</td>
                                </tr>
                                <tr>
                                  <td>ipad</td>
                                </tr>
                                <tr>
                                  <td>大礼包</td>
                                </tr>
                                <tr>
                                  <td>小礼包</td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                          <td style="padding:0">
                            <table class="table" style="text-align: center;margin-bottom:0">
                              <tbody>
                                <tr>
                                  <td style="border:0">16%</td>
                                </tr>
                                <tr>
                                  <td>16%</td>
                                </tr>
                                <tr>
                                  <td>16%</td>
                                </tr>
                                <tr>
                                  <td>16%</td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                          <td>
                            <a href="javascript:void(0);" data-id="1" class="grid-row-delete">
                              <i class="fa fa-trash"></i>
                            </a>
                          </td>
                          <td>
                            <a href="javascript:void(0);" data-id="1" class="grid-row-delete">
                              <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    The European languages are members of the same family. Their separate existence is a myth.
                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                    in their grammar, their pronunciation and their most common words. Everyone realizes why a
                    new common language would be desirable: one could refuse to pay expensive translators. To
                    achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                    words. If several languages coalesce, the grammar of the resulting language is more simple
                    and regular than that of the individual languages.
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                    sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                    like Aldus PageMaker including versions of Lorem Ipsum.
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_4">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                    sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                    like Aldus PageMaker including versions of Lorem Ipsum.
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
    </section>
    <!-- /.content -->
  </div>
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
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="http://120.26.143.106/packages/admin/number-input/bootstrap-number-input.js"></script>
<script src="http://120.26.143.106/packages/admin/moment/min/moment-with-locales.min.js"></script>
<script src="/adminLTE/plugins/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
  
    //Date picker
    // $('#datepicker').datepicker({
    //   autoclose: true,
    //   todayBtn: true,
    //   todayHighlight: true,
    //   viewSelect: 'hour'
    // });
    $('.datetime').datetimepicker({"format":"YYYY-MM-DD HH:mm:ss","locale":"zh-CN"});
    $('.number').bootstrapNumber();
    $('.date_time_start').datetimepicker({"format":"YYYY-MM-DD HH:mm:ss","locale":"zh-CN"});
    $('.date_time_end').datetimepicker({"format":"YYYY-MM-DD HH:mm:ss","locale":"zh-CN","useCurrent":false});
    $(".date_time_start").on("dp.change", function (e) {
        $('.date_time_end').data("DateTimePicker").minDate(e.date);
    });
    $(".date_time_end").on("dp.change", function (e) {
        $('.date_time_start').data("DateTimePicker").maxDate(e.date);
    });
</script>
</body>
</html>
