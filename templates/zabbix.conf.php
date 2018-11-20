<?php
// Zabbix GUI configuration file.
global $DB;

$DB['TYPE']     = 'MYSQL';
$DB['SERVER']   = 'localhost';
$DB['PORT']     = '0';
$DB['DATABASE'] = '{{ zabbix_mysql_db }}';
$DB['USER']     = '{{ zabbix_mysql_user }}';
$DB['PASSWORD'] = '{{ zabbix_mysql_password }}';

// Schema name. Used for IBM DB2 and PostgreSQL.
$DB['SCHEMA'] = '';

$ZBX_SERVER      = 'localhost';
$ZBX_SERVER_PORT = '10051';
$ZBX_SERVER_NAME = '{{ zabbix_web_title }}';

$IMAGE_FORMAT_DEFAULT = IMAGE_FORMAT_PNG;

