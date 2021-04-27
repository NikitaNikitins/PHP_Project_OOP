<?php
//Using Model- View- Controller design pattern
class Billing extends DBConnector {

    protected $Id;
    protected $BillingOwnerId;
    protected $HoursCount;
    protected $RequestedAmount;
    protected $ProjectInProgressId;
}
