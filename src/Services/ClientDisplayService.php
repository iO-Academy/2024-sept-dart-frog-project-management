<?php

require_once 'src/Entities/ClientEntity.php';

class clientDisplayService
{
    public static function displayClient(ClientEntity $client): string
   {
    return "<h3>$client->name</h3>";
   }
}
