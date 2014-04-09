<?php namespace Psimone\PlatformCore\Interfaces;

interface Repository {

        public function setTable($table);

        public function delete($id);

        public function find($id);

        public function paginated();

        public function store(array $data, $id = null);
        
        public function syncPivot($id, array $data, array $relation);
        
        public function getPivot($id, array $relation);

}
