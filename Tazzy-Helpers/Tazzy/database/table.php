<?php

  /**
   *
   */
  class Table
  {
    protected $table;
    protected $primary_key;
    protected $validate = [];
    protected $errors =[];
    protected $hasMany =[];
    protected $hasOne =[];
    protected $db;
    protected $active_record;
    protected $qb;
    function __construct(){
      $this->db = DB::connect();
      $this->active_record = null;
      $this->qb = new QueryBuilder();
    }
    function __destruct() {
        $this->active_record = null;
    }
    public function save($fields,$key=NULL){
      $this->errors = null;
      if(!isset($key)){
        if(!isset($this->validate)){
          if($this->db->insert($this->table,$fields)){
            $this->active_record = $this->db->lastIndex();
            return $this->db->lastIndex();
          }else{
            $this->errors = $this->db->error_info();
            return false;
          }
        }else{
          if($this->validate($fields)){
            if($this->db->insert($this->table,$fields)){
              $this->active_record = $this->db->lastIndex();
              return $this->db->lastIndex();
            }else{
              $this->errors = $this->db->error_info();
              return false;
            }
          }else{
            return false;
          }
        }
      }else{
        $this->db->update($this->table,[$this->primary_key,'=',$key],$fields);
        $this->active_record = $this->db->lastIndex();
        return $this->db->lastIndex();
      }
    }
    public function read($key){
        $this->active_record = $key;
        return $this;
    }
    public function set($field,$value = null){
      $this->errors= null;
      if (isset($this->table)&&isset($this->active_record)&&isset($this->primary_key)){

        if(is_array($field)){
          if(!$this->db->update($this->table,[$this->primary_key,'=',$this->active_record],$field)->error()){
            return TRUE;
          }else{
            $this->errors = $this->db->error_info();
            return FALSE;
          }
        }else {
          if(!$this->db->update($this->table,[$this->primary_key,'=',$this->active_record],[$field => $value])->error()){
            return TRUE;
          }else{
            $this->errors = $this->db->error_info();
            return FALSE;
          }
        }
      }
      return FALSE;
    }
    public function get($field=[]){
      if(!isset($field)){
        return $this->find('first',[
          'where'=>[$this->primary_key,'=',$this->active_record],
          'fields'=>$field
        ]);
      }else{
        return $this->find('first',[
        'where'=>[
                $this->primary_key,'=',$this->active_record
            ]
        ]);
      }
    }
    public function find($type = 'all', $conditions=[]){
      $this->errors = null;
      switch ($type) {
        case 'all':

          if(!$this->db->find($this->table,$conditions)){
              $result = $this->db->result();
              if(isset($this->hasMany)){
                  foreach($this->hasMany as $model){
                      $model = new $model();
                      for($i=0;$i<count($result);$i++){
                          $result[$i]->{$model->table} = $this->db->query($this->qb->table($model->table)->where($this->primary_key,"=",$result[$i]->{$this->primary_key})->get())->result();
                      }
                 }
              }
              if(isset($this->hasOne)){
                  foreach($this->hasOne as $model){
                      $model = new $model();
                      for($i=0;$i<count($result);$i++){
                          $result[$i]->{$model->table} = $this->db->query($this->qb->table($model->table)->where($model->primary_key,"=",$result[$i]->{$this->primary_key})->get())->first();
                      }
                 }
              }

              return $result;

          }else{
            $this->errors = $this->db->error_info();
            return false;
          }
          break;
        case 'first':
          if(!$this->db->find($this->table,$conditions)){
            $result = $this->db->first();
            if(isset($this->hasMany)){
                  foreach($this->hasMany as $model){
                    $model = new $model();
                    $result->{$model->table} = $this->db->query($this->qb->table($model->table)->where($this->primary_key,"=",$result->{$this->primary_key})->get())->result();
                 }
            }
            if(isset($this->hasOne)){
                foreach($this->hasOne as $model){
                    $model = new $model();
                    for($i=0;$i<count($result);$i++){
                        $result->{$model->table} = $this->db->query($this->qb->table($model->table)->where($model->primary_key,"=",$result->{$this->primary_key})->get())->first();
                    }
                }
            }
            return $result;
          }else{
            $this->errors = $this->db->error_info();
            return false;
          }
          break;
        case 'count':
          if(!$this->db->find($this->table,$conditions)){
            return $this->db->count();
          }else{
            $this->errors = $this->db->error_info();
            return false;
          }
          break;
        default :
          if(!$this->db->find($this->table,$conditions)){
            return $this->db->result();
          }else{
            $this->errors = $this->db->error_info();
            return false;
          }
        break;
      }
    }
    public function delete(){
        if (isset($this->table)&&isset($this->active_record)&&isset($this->primary_key)){
            if(!$this->db->delete($this->table,[$this->primary_key,"=",$this->active_record])->error()){
              return $this->db->error_info();
            }else {
              return TRUE;
            }
        }{
          return FALSE;
          //make sure you run read function first
        }
    }
    public function Reset(){
      $this->db->delete($this->table,[1,'=',1]);
      $this->db->query("ALTER TABLE ".$this->table." AUTO_INCREMENT = 1");
    }

    public function validate($source,$rules=[]){
      $this->errors = null;
      $validate = new Validate();
      if(!empty($rules)){
        if($validate->check($source,$rules)->passed()){
          return true;
        }else{
          $this->errors = $validate->errors();
          return false;
        }
      }else{
        if(!empty($this->validate)){
          if($validate->check($source,$this->validate)->passed()){
            return true;
          }else{
            $this->errors = $validate->errors();
            return false;
          }
        }else{
          return true;
        }
      }
      return false;
    }

    public function errors(){
      return $this->errors;
    }

    private function primaryKey($table){
        $query = $this->db->query("SHOW KEYS FROM ".$table." WHERE Key_name = 'PRIMARY'")->result();
        if(!$this->db->error()){
            return $query[0]->Column_name;
        }
        return FALSE;
    }
    private function tableColumns($table){
        return $this->db->tableColumns($table);
    }
  }


 ?>
