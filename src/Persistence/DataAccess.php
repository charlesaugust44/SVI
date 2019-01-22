<?php

interface DataAccess
{
    function insert($objeto);
    function update($objeto);
    function delete($objeto);
    function getAll();
    function getByField($key, $field, $param, $all);
}