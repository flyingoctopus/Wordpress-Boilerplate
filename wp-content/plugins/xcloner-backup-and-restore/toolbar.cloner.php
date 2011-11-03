<?php
/**
* XCloner
* Oficial website: http://www.joomlaplug.com/
* -------------------------------------------
* Creator: Liuta Romulus Ovidiu
* License: GNU/GPL
* Email: admin@joomlaplug.com
* Revision: 1.0
* Date: July 2007
**/


/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once('toolbar.cloner.html.php' );

switch ( $task ) {
  case 'help':
  case 'credits':
  case 'refresh':
  case 'generate':
    TOOLBAR_cloner::_GENERATE();
    break;

  case 'rename_save':
  case 'rename':
    TOOLBAR_cloner::_RENAME();
    break;
  case 'confirm':
    TOOLBAR_cloner::_CONFIRM();
    break;
  case 'continue':
  case 'move':
  case 'clone':
    TOOLBAR_cloner::_CLONE();
    break;
  case 'config':
    TOOLBAR_cloner::_CONFIG();
    break;
  case 'show':
  case 'view':
    TOOLBAR_cloner::_VIEW();
    break;


  case 'add_lang':
     TOOLBAR_cloner::_LANG_ADD();
     break;
  case 'save_lang_apply':
  case 'edit_lang':
     TOOLBAR_cloner::_LANG_EDIT();
     break;

  case 'del_lang':
  case 'lang':
    TOOLBAR_cloner::_LANG();
    break;

  case 'login':
    TOOLBAR_cloner::_LOGIN();
	break;

  default:
    TOOLBAR_cloner::_DEFAULT();
    break;
}

?>
