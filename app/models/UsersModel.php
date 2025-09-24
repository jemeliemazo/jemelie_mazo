<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: Usermodel
 * 
 * Automatically generated via CLI.
 */
class Usersmodel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function paginate($per_page, $page, $conditions = [])
    {
        $offset = ($page - 1) * $per_page;
        $where = '';
        $params = [];

        if (!empty($conditions)) {
            $whereParts = [];
            foreach ($conditions as $key => $value) {
                if (strpos($key, 'OR ') === 0) {
                    $key = substr($key, 3);
                    $whereParts[] = "OR $key ?";
                } else {
                    $whereParts[] = "$key ?";
                }
                $params[] = $value;
            }
            $where = 'WHERE ' . implode(' ', $whereParts);
        }

        $totalQuery = "SELECT COUNT(*) as total FROM {$this->table} $where";
        $totalStmt = $this->db->prepare($totalQuery);
        $totalStmt->execute($params);
        $total = $totalStmt->fetchColumn();

        $query = "SELECT * FROM {$this->table} $where LIMIT ? OFFSET ?";
        $stmt = $this->db->prepare($query);
        $params[] = $per_page;
        $params[] = $offset;
        $stmt->execute($params);
        $data = $stmt->fetchAll();

        return [
            'data' => $data,
            'total' => $total,
            'per_page' => $per_page,
            'current_page' => $page,
            'last_page' => ceil($total / $per_page)
        ];
    }
}
