<?php

class Comment extends Database {
    private $table = 'comments';

    public function __construct() {
        parent::__construct();
    }
}