<?php
//Using Model- View- Controller design pattern
class User extends DBConnector {

    protected $Id;
    protected $UserName;
    protected $Email;
    protected $PasswordHash;
    protected $PhoneNumber;
    protected $FirstName;
    protected $LastName;
    protected $FullName;
    protected $Address;
    protected $City;
    protected $CustomerId;
    protected $WorkerId;
}