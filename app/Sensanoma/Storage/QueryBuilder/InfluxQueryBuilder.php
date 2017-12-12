<?php

namespace App\Sensanoma\Storage\QueryBuilder;


class InfluxQueryBuilder
{
    protected $select;
    protected $from;
    protected $where;
    protected $groupBy;
    protected $fill;
    protected $limit;
    protected $orderBy;

    public function select(Array $fields)
    {
        if (!$fields) {
            return new \Exception('Fields is required');
        }
        $this->select = implode(', ', $fields);
        return $this;
    }

    public function from(Array $measurements)
    {
        if (!$measurements) {
            return new \Exception('Measurements is required');
        }
        $measurements = implode(", ", $measurements);

        $this->from = $measurements;
        return $this;
    }

    public function where($clause)
    {
        ($clause) ? $this->where = "WHERE $clause" : $this->where = '';
        return $this;
    }

    public function groupBy($groupBy)
    {
        ($groupBy) ? $this->groupBy = "GROUP BY $groupBy" : $this->groupBy = '';
        return $this;
    }

    public function fill($fill = null)
    {
        ($fill) ? $this->fill = "fill($fill)" : $this->fill = '';
        return $this;
    }

    public function limit($limit = null) {
        ($limit) ? $this->limit = 'LIMIT ' .$limit : $this->limit = '';
        return $this;
    }

    public function order($orderBy = null) {
        ($orderBy) ? $this->orderBy = 'ORDER BY ' .$orderBy : $this->orderBy = '';
        return $this;
    }

    public function build()
    {
        return trim(preg_replace("/ {2,}/", " ", "SELECT $this->select FROM $this->from $this->where $this->groupBy $this->fill $this->orderBy $this->limit"));
    }
}