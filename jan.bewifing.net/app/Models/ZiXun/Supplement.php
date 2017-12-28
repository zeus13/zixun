<?php
namespace App\Models\ZiXun;
use App\Models\BaseModel;
class Supplement extends BaseModel {
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'zixun_supplement'; // 补充类型（如wifi，免费停车图标等）表
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
        'key' => 'string',
    ];
    /**
     * [$fillable 加入白名单]
     * @var [type]
     */
    protected $fillable = [];
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

}
