<?php

interface IConnectInfo
{
    const HOST = "localhost";
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'pai';

    function testConnection();
}

