<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class WeiXin extends Model {
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'db_weixin';
    /**
     * 指定是否模型应该被戳记时间。
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        //'id' => 'string',
        //'key' => 'string',
    ];
    /**
     * [$fillable 加入白名单]
     * @var [type]
     */
    protected $fillable = ['subscribe','openid','nickname','sex','city','province','country','headimgurl','subscribe_time','avatar','code','lasttime'];
    /**
     * [$dates 将时间戳转换成日期]
     * @var array
     */
    protected $dates = [];

    
    /**
     * 获取当前时间
     *
     * @return int
     */
    public function freshTimestamp() {
        return time();
    }

    /**
     * 避免转换时间戳为时间字符串
     *
     * @param DateTime|int $value
     * @return DateTime|int
     */
    public function fromDateTime($value) {
        return $value;
    }

    //====================自定义方法===================


}
