<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Token extends Model {
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'ys_token';
    /**
     * 指定是否模型应该被戳记时间。
     *
     * @var bool
     */
    public $timestamps = false;
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
    protected $fillable = [];
    /**
     * [$dates 将时间戳转换成日期]
     * @var array
     */
    protected $dates = [];


}
