<?php namespace Psimone\PlatformCore\Repositories;

use Psimone\PlatformCore\Facades\Filter;
use Psimone\PlatformCore\Facades\Order;
use Psimone\PlatformCore\Facades\Platform;
use Psimone\PlatformCore\Interfaces\Repository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Fluent implements Repository {

        public $table;
        private $result;

        public function setTable($table)
        {
                $this->table = $table;
        }

        public function delete($id)
        {
                DB::table($this->table)
                        ->where('id', $id)
                        ->delete();
        }

        public function find($id)
        {
                if (empty($this->result))
                {
                        $this->result = DB::table($this->table)
                                ->where('id', $id)
                                ->first();
                }

                return $this->result;
        }

        public function paginated()
        {
                $query = DB::table($this->table)
                        ->orderBy(Order::column(), Order::sort());

                $filtered = $this->filter($query);

                return $this->result = $this->paginate($filtered);
        }

        public function store(array $data, $id = null)
        {
                if ($id)
                {
                        DB::table($this->table)
                                ->where('id', $id)
                                ->update($data);
                }
                else
                {
                        $id = DB::table($this->table)
                                ->insertGetId($data);
                }

                return $id;
        }

        public function entries($order)
        {
                list($column, $sort) = $order;

                return $this->result = DB::table($this->table)
                        ->orderBy($column, $sort)
                        ->get();
        }

        private function filter($query)
        {
                $filters = Filter::filters();

                foreach ($filters as $field => $value)
                {
                        $query->where($field, '=', $value);
                }

                return $query;
        }

        private function paginate($query)
        {
                $paging = Config::get(Platform::getPackageName() . '::table.pagination');

                return $query->paginate($paging);
        }

}
