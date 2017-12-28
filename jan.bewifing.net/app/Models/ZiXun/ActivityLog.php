<?php
namespace App\Models\ZiXun;

use Illuminate\Database\Eloquent\Model;
class ActivityLog extends Model {
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'zixun_activity_log';
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
    protected $fillable = ['id','isdelete','act_id','mem_id','num'];
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
     * [activityTypes 一对多]
     * @return [type] [description]
     */
    public function activity()
    {
        return $this->hasOne('App\Models\ZiXun\Activity', 'act_id', 'id');
    }


// =======================================自定义方法=================================

}
