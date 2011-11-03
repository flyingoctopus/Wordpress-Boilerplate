<?php
$_CONFIG['license_code']="";
$_CONFIG['backup_path']="./";
$_CONFIG['clonerPath']="./";
$_CONFIG['mysql_host']="localhost";
$_CONFIG['mysql_user']="root";
$_CONFIG['mysql_pass']="";
$_CONFIG['mysql_database']="";
$_CONFIG['select_folders']="";
$_CONFIG['select_lang']="english";
$_CONFIG['secure_ftp']="0";
$_CONFIG['backup_compress']="";
$_CONFIG['cron_logemail']="";
$_CONFIG['cron_exclude']="";
$_CONFIG['cron_send']="0";
$_CONFIG['cron_btype']="0";
$_CONFIG['cron_bname']="";
$_CONFIG['cron_ip']="";
$_CONFIG['cron_ftp_server']="";
$_CONFIG['cron_ftp_user']="";
$_CONFIG['cron_ftp_pass']="";
$_CONFIG['cron_ftp_path']="";
$_CONFIG['cron_ftp_delb']="";
$_CONFIG['databases_incl_list']="";
$_CONFIG['cron_sql_drop']="";
$_CONFIG['cron_email_address']="";
$_CONFIG['cron_file_delete']="";
$_CONFIG['cron_file_delete_act']="";
$_CONFIG['mem']="";
$_CONFIG['backup_refresh']="1";
$_CONFIG['refresh_time']="1";
$_CONFIG['refresh_mode']="1";
$_CONFIG['backup_refresh_number']="100";
$_CONFIG['sql_mem']="";
$_CONFIG['enable_db_backup']="1";
$_CONFIG['zippath']="";
$_CONFIG['tarpath']="tar";
$_CONFIG['sqldump']="mysqldump --quote-names ";
$_CONFIG['system_dlink']="";
$_CONFIG['system_ftptransfer']="0";
$_CONFIG['system_mdatabases']="0";
$_CONFIG['recordsPerSession']= "10000";
$_CONFIG['excludeFilesSize'] = "-1";
$_CONFIG['splitBackupSize'] = "2048"; //MB

### Defaults
$script_dir = str_replace("\\","/",dirname(__FILE__));

$_CONFIG['jcuser'] = 'admin';
$_CONFIG['jcpass'] = md5('admin');
$_CONFIG['mem']="0";
$_CONFIG['archive_type']="0";
$_CONFIG['backup_refresh'] = "1";
$_CONFIG['backup_path'] = $script_dir;
$_CONFIG['clonerPath'] = $script_dir."/backups";
$_CONFIG['enable_db_backup'] = '0';

###Wordpress specific configuration

/*if(@include("../../../wp-config.php")){

  $_CONFIG["enable_db_backup"] = 1;
  $_CONFIG['mysql_host'] = DB_HOST;
  $_CONFIG['mysql_user'] = DB_USER;
  $_CONFIG['mysql_pass'] = DB_PASSWORD;
  $_CONFIG['mysql_database'] = DB_NAME;


}*/

if(@file_exists("../../../wp-config.php")){

  $content = file_get_contents("../../../wp-config.php");	
  $content = str_replace("require_once","#require_once", $content);	
  $content = str_replace(array("<?php","<?","?>"),array("","",""), $content);		
  eval($content);

  $_CONFIG["enable_db_backup"] = 1;
  $_CONFIG['mysql_host'] = DB_HOST;
  $_CONFIG['mysql_user'] = DB_USER;
  $_CONFIG['mysql_pass'] = DB_PASSWORD;
  $_CONFIG['mysql_database'] = DB_NAME;


}

$script_dir = str_replace("wp-content/plugins/xcloner-backup-and-restore","", $script_dir);

$_CONFIG['backup_path'] = $script_dir;

$_CONFIG['clonerPath'] = realpath($script_dir."/administrator/backups");
$_CONFIG['clonerPath'] = str_replace("\\","/", $_CONFIG['clonerPath']);

$_CONFIG['mosConfig_live_site']=$_SERVER['HTTP_HOST'];


?>
