<?php
namespace App\Models\ZiXun;

use Illuminate\Database\Eloquent\Model;
class TicketType extends Model {
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'zixun_ticket_type';
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
    protected $casts = [];
    /**
     * [$fillable 加入白名单]
     * @var [type]
     */
    protected $fillable = ['id','isdelete','act_id','name','price','rule','is_homebuy','homebuy_num','is_seat_selection','is_give','is_through_ticket','starttime','endtime','rest'];
    /**
     * [$dates 将时间戳转换成日期]
     * @var array
     */
    protected $dates = [];

    
    /**
     * 模型日期列的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';

    public function getDiscountAttribute($value)
    {
        return json_decode($value,true);
    }

    /**
     * [weixin 一对多]
     * @return [type] [description]
     */
    public function ticket()
    {
        return $this->hasMany('App\Models\ZiXun\Ticket', 'ticktype_id', 'id');
    }


// =======================================自定义方法=================================

}
