<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no"/>
<meta charset="utf-8">
<!-- <script language="javascript" src="LodopFuncs.js"></script> -->
<object  id="LODOP_OB" classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width=0 height=0> 
       <embed id="LODOP_EM" type="application/x-print-lodop" width=0 height=0></embed>
</object>
<link rel="stylesheet" type="text/css" media="print" href="/assets/css/print.css?v=6" />
<link rel="stylesheet" type="text/css" href="/assets/css/print.css?v=6" />
<title>打印订单</title>
<style type="text/css">
*{
  padding: 0;
  margin: 0;
}
.code{
	margin: 10px auto;
}
a{
  display: block;
  width: 200px;
  height: 40px;
  line-height: 40px;
  margin: 10px 20px;
  color: #fff;
  text-align: center;
  border-radius: 5px;
}

.blue{
  background: #1b6798;
}
.green{
  background: green;
}
.grey{
  background: grey;
}
</style>
</head>
<body>  
<!-- <label for="begin">开始码段</label>
  <input type="text" name="begin" id="begin" />
  <br />
  <label for="total">总数</label>
  <input type="text" name="total" id="total" />
  <a class="blue" onclick="load()">生成二维码</a>
  <a class="green" onclick="next()">下一批</a> -->
<div class="warp" style="font-size:width:6px;*width:6px !important;">
  <a class="grey" onclick="printQrcode()">打印</a>

  <div class="print canon">
    <?php if(!empty($sendList)): ?>
    <?php $__currentLoopData = $sendList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="item">
      <div class="el">
        <div class="el-row">
          <div class="el-col fl">
            <div class="grid-content">收货人：<span><?php echo e($value['dispatch_name']); ?></span></div>
          </div>
          <div class="el-col-1 fr">
            <div class="grid-content">订单号：<span><?php echo e($value['ordersn']); ?></span></div>
          </div>
        </div>
        <div class="el-row">
          <div class="el-col fl">
            <div class="grid-content bg-purple">联系方式：<span><?php echo e($value['dispatch_tel']); ?></span></div>
          </div>
          <div class="el-col-1 fr">
            <div class="grid-content">下单时间：<span><?php echo e(date('Y-m-d H:i:s', $value['pay_time'])); ?></span></div>
          </div>
        </div>
        <div class="el-row ">
          <div class="el-col fl">
            <div class="grid-content">收货地址：<span><?php echo e($value['dispatch_address']); ?></span></div>
          </div>
          <div class="el-col-1 fr">
            <div class="grid-content">备注：<span><?php echo e($value['remark']); ?></span></div>
          </div>
        </div>
      </div>
      <table>
        <tbody >
          <tr >
            <th align="middle" height="20px"><div>商品名称</div></th>
            <th align="middle"><div>规格</div></th>
            <th align="middle"><div>价格</div></th>
            <th align="middle"><div>数量</div></th>
            <th align="middle"><div>小计</div></th>
          </tr>
          <?php if(!empty($value['order_goods'])): ?>
          <?php $__currentLoopData = $value['order_goods']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td height="40px"><div><?php echo e($v['goods_name']); ?></div></td>
            <td><div><?php echo e($v['goods_spec']); ?></div></td>
            <td align="right"><div><?php echo e($v['goods_price']); ?>元</div></td>
            <td align="right"><div><?php echo e($v['num']); ?></div></td>
            <td align="right"><div><?php echo e($v['price']); ?>元</div></td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          <tr>
            <td colspan="5" height="20px" align="right"><div>商品总金额：<?php echo e($value['goods_price']); ?>元 + 配送费：<?php echo e($value['dispatch_price']); ?>元 = 订单总金额：<?php echo e($value['total_price']); ?>元</div></td>
          </tr>
          <tr class="last-tr">
            <td><div></div></td>
            <td><div></div></td>
            <td align="right"><div></div></td>
            <td align="right"><div></div></td>
            <td align="right"><div></div></td>
          </tr>
        </tbody>
      </table>
      <div class="line"></div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
  </div>
  <div id="box"></div>
</div>
</body>
</html>
<script language="javascript" src="http://www.jq22.com/demo/dayin/jquery-1.4.4.min.js"></script>
<script language="javascript" src="http://www.jq22.com/demo/dayin/jquery.jqprint-0.3.js"></script>
<script src="/assets/js/jquery.qrcode.min.js"></script>
<script type="text/javascript">

/*
var str = '';

for (var i = 0; i < 20; i++) {
  Things[i]
};
*/
/*if(localStorage.getItem("total")){
  $('h3').html('上次打印到 '+localStorage.getItem("total"));
}


function load(){
  var b = parseInt($('#begin').val()), t = parseInt($('#total').val());
  if(!b){
    alert('没有填写开始码段');
    return;
  }

  if(!t){
    alert('没有填写总数');
    return;
  }
}
// <div class="code"><img src='+$("canvas")[i].toDataURL("image/png")+' /><p>NO:'+item.sn+'</p></div>
function next(){
  var t = parseInt($('#total').val()), b = parseInt($('#begin').val()) + t;
  $.ajax({
      type: 'POST',
      url: 'ajaxshowqrcode',
      dataType: 'json',
      data :　{begin: b, total: t},
      beforeSend:function(){
        $('.green').html('正在生成...');
      },
      success:function(data){
        $('.print').html('');
        $('#box').html('');
        $.each(data,function(i,item){
          if(item.sn == null){
            alert('程序出错，请刷新');
            return;
          }
          $('#box').qrcode({ 
              render: "canvas", // 
              width: 200, //宽度 
              height:200, //高度 
              text: 'http://lezaigo.com/scanqrcode?qrcode='+ item.ticket//任意内容 
          });
          $('.print').append('<svg id="svgForStroke" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3cm 4cm" xmlns:xlink="http://www.w3.org/1999/xlink"><image xlink:href="'+$("canvas")[i].toDataURL("image/png")+'" x="0cm" y="0.3cm" height="2.5cm" width="2.5cm" /><text x="0.2cm" y="3.5cm" style="font-size:10pt">NO.'+item.sn+'</text></svg>');
        })
        $('#begin').val(b);

        localStorage.setItem("total",b+t-1);
        $('h3').html('上次打印到 '+localStorage.getItem("total"));
        $('.green').html('下一批');
        $(".print").jqprint();
          console.log(data);
      },
      error:function(){
      }
  });
}
*/
function printQrcode(){
	$(".print").jqprint();
}
</script>