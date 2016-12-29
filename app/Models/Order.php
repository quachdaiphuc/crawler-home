<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 */
class Order extends Model {
    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function setting() {
        return $this->hasMany(Setting::class, 'order_id');
    }
}