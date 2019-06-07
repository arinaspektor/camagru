<?php

    class DatabaseObject {

        static protected $db;
        // static protected $table = "";
        // static protected $columns = [];
        // public $errors = [];

        static public function set_database($database) {
            self::$db = $database;
        }

        
        // static public function find_by_sql($sql) {
        //     $result = self::$db->query($sql);

        //     if(!$result) {
        //       exit("Database query failed.");
        //     }
        
        //     $object_array = [];
        //     while($record = $result->fetch_assoc()) {
        //       $object_array[] = static::instantiate($record);
        //     }
        //     $result->free();
        //     return $object_array;
        // }

        // static public function find_all() {
        //     $sql = "SELECT * FROM " . static::$table;
        //     return static::find_by_sql($sql);
        // }

        // static public function count_all() {
        //     $sql = "SELECT COUNT(*) FROM " . static::$table;
        //     $result = self::$db->query($sql);
        //     $row = $result->fetch_array();
        //     return array_shift($row);
        // }

        // static public function find_by_id($id) {
        //     $sql = "SELECT * FROM " . static::$table . " ";
        //     $sql .= "WHERE id='" . self::$db->escape_string($id) . "'";
        //     $obj_array = static::find_by_sql($sql);

        //     if(!empty($obj_array)) {
        //       return array_shift($obj_array);
        //     } else {
        //       return false;
        //     }
        // }

        // static protected function instantiate($record) {
        //     $object = new static;
           
        //     foreach($record as $property => $value) {
        //       if(property_exists($object, $property)) {
        //         $object->$property = $value;
        //       }
        //     }
            
        //     return $object;
        // }

        // protected function validate() {
        //     $this->errors = [];
        
        //     // Add custom validations
        
        //     return $this->errors;
        // }


        // protected function create() {
        //     $this->validate();

        //     if(!empty($this->errors)) { return false; }

        //     $attributes = $this->sanitized_attributes();

        //     $sql = "INSERT INTO " . static::$table . " (";
        //     $sql .= join(', ', array_keys($attributes));
        //     $sql .= ") VALUES ('";
        //     $sql .= join("', '", array_values($attributes));
        //     $sql .= "')";

        //     $result = self::$db->query($sql);
        //     if($result) {
        //     $this->id = self::$db->insert_id;
        //     }

        //     return $result;
        // }

        // protected function update() {
        //     $this->validate();

        //     if(!empty($this->errors)) { return false; }
        
        //     $attributes = $this->sanitized_attributes();
        //     $attribute_pairs = [];
        //     foreach($attributes as $key => $value) {
        //       $attribute_pairs[] = "{$key}='{$value}'";
        //     }
        
        //     $sql = "UPDATE " . static::$table . " SET ";
        //     $sql .= join(', ', $attribute_pairs);
        //     $sql .= " WHERE id='" . self::$db->escape_string($this->id) . "' ";
        //     $sql .= "LIMIT 1";

        //     $result = self::$db->query($sql);

        //     return $result;
        // }

        // public function save() {
        //     if(isset($this->id)) {
        //     return $this->update();
        //     } else {
        //     return $this->create();
        //     }
        // }

        // public function merge_attributes($args=[]) {
        //     foreach($args as $key => $value) {
        //       if(property_exists($this, $key) && !is_null($value)) {
        //         $this->$key = $value;
        //       }
        //     }
        // }

        // public function attributes() {
        //     $attributes = [];
        //     foreach(static::$db_columns as $column) {
        //       if($column == 'id') { continue; }
        //       $attributes[$column] = $this->$column;
        //     }
        //     return $attributes;
        // }

        // protected function sanitized_attributes() {
        //     $sanitized = [];
        //     foreach($this->attributes() as $key => $value) {
        //       $sanitized[$key] = self::$db->escape_string($value);
        //     }
        //     return $sanitized;
        // }

        // public function delete() {
        //     $sql = "DELETE FROM " . static::$table . " ";
        //     $sql .= "WHERE id='" . self::$db->escape_string($this->id) . "' ";
        //     $sql .= "LIMIT 1";
        //     $result = self::$db->query($sql);
        //     return $result;
        // }
    }

?>