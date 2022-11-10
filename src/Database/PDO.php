<?php


namespace Lidmo\WP\Database;


use PDO as BasePDO;
use PDOException;
use ReturnTypeWillChange;

class PDO extends BasePDO
{
    /**
     * @var Connection
     */
    protected $db;
    protected $in_transaction;

    public function __construct($wpdb)
    {
        try {
            parent::__construct('');
        } catch (PDOException $e) {

        }
        $this->db = $wpdb;
    }

    public function beginTransaction(): bool
    {
        if ($this->in_transaction) {
            throw new PDOException("Failed to start transaction. Transaction is already started.");
        }
        $this->in_transaction = true;
        return $this->db->unprepared('START TRANSACTION');
    }

    public function commit(): bool
    {
        if (!$this->in_transaction) {
            throw new PDOException("There is no active transaction to commit");
        }
        $this->in_transaction = false;
        return $this->db->unprepared('COMMIT');
    }

    public function rollBack(): bool
    {
        if (!$this->in_transaction) {
            throw new PDOException("There is no active transaction to rollback");
        }
        $this->in_transaction = false;
        return $this->db->unprepared('ROLLBACK');
    }

    public function inTransaction(): bool
    {
        return $this->in_transaction;
    }

    #[ReturnTypeWillChange] public function exec($statement): bool
    {
        return $this->db->unprepared($statement);
    }

    #[ReturnTypeWillChange] public function lastInsertId($name = null): int
    {
        return (int) $this->db->getWP()->insert_id;
    }
}
