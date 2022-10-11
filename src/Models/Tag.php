<?php

namespace Lidmo\WP\Models;

/**
 * Tag class.
 *
 * @package Lidmo\WP\Models
 * @author Mickael Burguet <www.rundef.com>
 */
class Tag extends Taxonomy
{
    /**
     * @var string
     */
    protected $taxonomy = 'post_tag';
}
