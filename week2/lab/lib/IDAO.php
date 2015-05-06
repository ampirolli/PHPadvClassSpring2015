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
interface IDAO {
    //put your code here
    
    /**
    * A method to get a single row of data based on the primary key.
    *
    * @param {String} [$id] - must be a valid ID
    *
    * @return IModel
    */
    public function getById($id);

    /**
    * A method to delete a row of data.
    *
    * @param {String} [$id] - must be a valid ID
    *
    * @return IModel
    */
    public function delete($id);
   
     /**
    * A method to save a row of data.
    *
    * @param {String} [$id] - must be a valid ID
    *
    * @return IModel
    */
    public function save(IModel $model);
    
    /**
    * A method to retrieve all rows of data.
    *
    * @param {String} [$id] - must be a valid ID
    *
    * @return IModel
    */
    public function getAllRows();
}
