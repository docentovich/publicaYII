<?php
define("TOSEE", 1);
define("TOSEE_DEV", "tosee.loc");
define("TOSEE_PROD", "tosee.shablonkin.shn-host.ru");

define("PROBANK", 2);
define("PROBANK_DEV", "probank.loc");
define("PROBANK_PROD", "publicayii-probank.shablonkin.shn-host.ru");

switch ($_SERVER['SERVER_NAME']) {
    case  TOSEE_DEV:
    case  TOSEE_PROD:
        define("PROJECT", TOSEE);
        break;
    case PROBANK_DEV:
    case PROBANK_PROD :
        define("PROJECT", PROBANK);
        break;
}