<?php

use \PMMigration\Tables as Table;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function scenarioRun($DB) {
    $DB->add(new Table\NewsTable());
}