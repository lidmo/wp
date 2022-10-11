<?php

namespace Lidmo\WP\Models;

use Lidmo\WP\Concerns\AdvancedCustomFields;
use Lidmo\WP\Concerns\MetaFields;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Term.
 *
 * @package Lidmo\WP\Models
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class Term extends Model
{
    use MetaFields;
    use AdvancedCustomFields;

    /**
     * @var string
     */
    protected $table = 'terms';

    /**
     * @var string
     */
    protected $primaryKey = 'term_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function taxonomy()
    {
        return $this->hasOne(Taxonomy::class, 'term_id');
    }
}
