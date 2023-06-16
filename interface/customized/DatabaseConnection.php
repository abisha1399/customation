<?php
class PDOp {
        protected $PDO;
        public $numExecutes;
        public $numStatements;
        public function __construct($dsn, $user=NULL, $pass=NULL, $driver_options=NULL) {
            $this->PDO = new PDO($dsn, $user, $pass, $driver_options);
            $this->numExecutes = 0;
            $this->numStatements = 0;
        }
        public function __call($func, $args) {
            return call_user_func_array(array(&$this->PDO, $func), $args);
        }
        public function prepare() {
            $this->numStatements++;
           
            $args = func_get_args();
            $PDOS = call_user_func_array(array(&$this->PDO, 'prepare'), $args);
           
            return new PDOpStatement($this, $PDOS);
        }
        public function query() {
            $this->numExecutes++;
            $this->numStatements++;
           
            $args = func_get_args();
            $PDOS = call_user_func_array(array(&$this->PDO, 'query'), $args);
           
            return new PDOpStatement($this, $PDOS);
        }
        public function exec() {
            $this->numExecutes++;
           
            $args = func_get_args();
            return call_user_func_array(array(&$this->PDO, 'exec'), $args);
        }
    }
    class PDOpStatement implements IteratorAggregate {
        protected $PDOS;
        protected $PDOp;
        public function __construct($PDOp, $PDOS) {
            $this->PDOp = $PDOp;
            $this->PDOS = $PDOS;
        }
        public function __call($func, $args) {
            return call_user_func_array(array(&$this->PDOS, $func), $args);
        }
        public function bindColumn($column, &$param, $type=NULL) {
            if ($type === NULL)
                $this->PDOS->bindColumn($column, $param);
            else
                $this->PDOS->bindColumn($column, $param, $type);
        }
        public function bindParam($column, &$param, $type=NULL) {
            if ($type === NULL)
                $this->PDOS->bindParam($column, $param);
            else
                $this->PDOS->bindParam($column, $param, $type);
        }
        public function execute() {
            $this->PDOp->numExecutes++;
            $args = func_get_args();
            return call_user_func_array(array(&$this->PDOS, 'execute'), $args);
        }
        public function __get($property) {
            return $this->PDOS->$property;
        }
        public function getIterator() {
            return $this->PDOS;
        }
   }
?>