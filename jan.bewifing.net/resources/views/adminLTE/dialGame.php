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
  </style>
</head>
<body class="no-skin" style="">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        活动管理
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active">幸运转盘</li>
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
              <h3 class="box-title">幸运转盘</h3>
            </div>
            <form role="form">
              <div class="box-body">
                <div class="col-sm-4">
                  <img src="/adminLTE/activityImg1.jpg" width="100%">
                </div>

                <div class="col-sm-7">
                  <!-- radio -->
                  <label>活动模板:</label>
                  <div class="form-group row">
                    <label class="checkbox-inline">
                      <input type="radio" name="optionsRadiosinline" id="optionsRadios3" value="option1" checked> 竞猜
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="optionsRadiosinline" id="optionsRadios4" value="option2"> 摇一摇
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="optionsRadiosinline" id="optionsRadios4" value="option2"> 大转盘
                    </label>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">活动名称:</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="这里填写活动名称...">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">活动时间:</label>
                    <div class="row" style="width: 390px">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="date_time_start" value="" class="form-control date_time_start" placeholder="开始时间" style="width: 160px"  />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="date_time_end" value="" class="form-control date_time_end" placeholder="结束时间" style="width: 160px"  />
                            </div>
                        </div>
                    </div>
                  </div>
<!--                   <div class="form-group">
                    <label for="exampleInputPassword1">开始时间:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="datetime" value="" class="form-control datetime"  placeholder="Input Datetime"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">结束时间:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="datetime" value="" class="form-control datetime"  placeholder="Input Datetime"/>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <label for="exampleInputPassword1">每日参与次数上限</label>  
                    <div class="input-group">
                        <input type="text" name="number" value="0" min="1" class="form-control number" style="width:100px" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Title</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="这里填写Title...">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">中奖模块:</label>
                    &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default btn-sm">新增</button>
                    <table class="table table-bordered" style="margin-top: 10px;text-align: center">
                      <thead>
                        <tr>
                          <th style="text-align: center">中奖明细</th>
                          <th style="text-align: center">中奖概率</th>
                          <th style="text-align: center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>一等奖</td>
                          <td>iPhone7 一台</td>
                          <td>
                            <a href="javascript:void(0);" data-id="1" class="grid-row-delete">
                              <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td>二等奖</td>
                          <td>小米手机 一台</td>
                          <td>
                            <a href="javascript:void(0);" data-id="1" class="grid-row-delete">
                              <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputPassword1">活动规则</label>
                    <textarea name="text" class="form-control" rows="5" placeholder="活动规则..."></textarea>
                  </div>
                </div>
              </div>

              <div class="box-footer">
                <div class="col-sm-4"></div>
                <div class="col-sm-2">
                  <div class="btn-group">
                      <button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i>&nbsp; 提交</button>
                  </div>
                </div>
              </div>
             <!--  <div class="clearfix"></div> -->
            </form>
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
