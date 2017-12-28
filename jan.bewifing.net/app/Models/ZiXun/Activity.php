<?php
namespace App\Models\ZiXun;

use Illuminate\Database\Eloquent\Model;
class Activity extends Model {
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'zixun_activity';
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
        'image' => 'array',
        'thumbnail' => 'array',
        // 'join_notes' => 'array',
        // 'kindly_reminder' => 'array',
    ];
    /**
     * [$fillable 加入白名单]
     * @var [type]
     */
    protected $fillable = ['id','isdelete','name','host','time','starttime','endtime','place','detail','join_notes','kindly_reminder','status','thumbnail','home_tips','image','share_title','share_text','share_icon'];
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


    /**
     * [activitySupplements 一对多]
     * @return [type] [description]
     */
    public function activitySupplements()
    {
        return $this->hasMany('App\Models\ZiXun\ActivitySupplement', 'act_id', 'id');
    }


    /**
     * [activityCategorys 一对多]
     * @return [type] [description]
     */
    public function activityCategorys()
    {
        return $this->hasMany('App\Models\ZiXun\ActivityCategory', 'act_id', 'id');
    }


    /**
     * [ticketTypes 一对多]
     * @return [type] [description]
     */
    public function ticketTypes()
    {
        return $this->hasMany('App\Models\ZiXun\TicketType', 'act_id', 'id');
    }


// =======================================自定义方法=================================

}
