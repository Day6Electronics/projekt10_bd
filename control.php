<?php
require_once 'init.php';

getRouter()->setDefaultRoute('calcShow');
getRouter()->setLoginRoute('login');

getRouter()->addRoute('calcShow',    'CalcControl',           ['user','admin']);
getRouter()->addRoute('calcCompute', 'CalcControl',           ['user','admin']);
getRouter()->addRoute('login',       'LoginControl');
getRouter()->addRoute('logout',      'LoginControl',          ['user','admin']);
getRouter()->addRoute('resistorList','ResistorListControl');
getRouter()->addRoute('resistorList','ResistorEditControl',   ['user','admin']);

getRouter()->go();