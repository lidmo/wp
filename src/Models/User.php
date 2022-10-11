<?php

namespace Lidmo\WP\Models;

use Lidmo\WP\Concerns\Aliases;
use Lidmo\WP\Concerns\MetaFields;
use Lidmo\WP\Concerns\OrderScopes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @package Lidmo\WP\Models
 * @author Ashwin Sureshkumar <ashwin.sureshkumar@gmail.com>
 * @author Mickael Burguet <www.rundef.com>
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class User extends Model
{
    const CREATED_AT = 'user_registered';
    const UPDATED_AT = null;

    use Aliases;
    use MetaFields;
    use OrderScopes;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $dates = ['user_registered'];

    /**
     * @var array
     */
    protected $with = ['meta'];

    /**
     * @param mixed $value
     */
    public function setUpdatedAtAttribute($value)
    {
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function setUpdatedAt($value)
    {
        //
    }
}
