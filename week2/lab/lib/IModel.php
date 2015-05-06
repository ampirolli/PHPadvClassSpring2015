<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author 001329606
 */
interface IModel {
    //put your code here
    
    /**
    * updates all values back to an empty state.
    *
    * @return SELF
    */
    public function reset();
    
    /**
    * sets all values based on an associative array.
    *
    * @param {Array} [$values] - must be a valid associative array
    *
    * @return SELF
    */
    public function map(array $values);
}
