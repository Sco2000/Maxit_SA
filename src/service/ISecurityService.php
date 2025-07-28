<?php

namespace App\service;

interface ISecurityService
{
    public function getAll($login, $password);
}