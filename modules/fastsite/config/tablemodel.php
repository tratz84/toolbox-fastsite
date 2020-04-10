<?php

use core\db\TableModel;

$tbs = array();


$tb_wm = new TableModel('fastsite', 'webmenu');
$tb_wm->addColumn('webmenu_id',       'int', ['key' => 'PRIMARY KEY', 'auto_increment' => true]);
$tb_wm->addColumn('parent_webmenu_id',           'int');
$tb_wm->addColumn('code', 'varchar(64)');
$tb_wm->addColumn('label', 'varchar(255)');
$tb_wm->addColumn('url', 'varchar(255)');
$tb_wm->addColumn('webpage_id', 'int');
$tb_wm->addColumn('description', 'text');
$tb_wm->addColumn('sort', 'int');
$tb_wm->addColumn('edited', 'datetime');
$tb_wm->addColumn('created', 'datetime');
$tbs[] = $tb_wm;


$tb_webpage = new TableModel('fastsite', 'webpage');
$tb_webpage->addColumn('webpage_id',       'int', ['key' => 'PRIMARY KEY', 'auto_increment' => true]);
$tb_webpage->addColumn('webpage_rev_id',           'int');
$tb_webpage->addColumn('code', 'varchar(64)');
$tb_webpage->addColumn('url', 'varchar(255)');
$tb_webpage->addColumn('fastsite_template_file', 'varchar(255)');
$tb_webpage->addColumn('module', 'varchar(64)');
$tb_webpage->addColumn('active', 'boolean');
$tb_webpage->addColumn('edited', 'datetime');
$tb_webpage->addColumn('created', 'datetime');
$tb_webpage->addIndex('index_code', 'code', ['unique' => true]);

$tb_web_rev = new TableModel('fastsite', 'webpage_rev');
$tb_web_rev->addColumn('webpage_rev_id',       'int', ['key' => 'PRIMARY KEY', 'auto_increment' => true]);
$tb_web_rev->addColumn('rev', 'int');
$tb_web_rev->addColumn('meta_title', 'text');
$tb_web_rev->addColumn('meta_description', 'text');
$tb_web_rev->addColumn('meta_keywords', 'text');
$tb_web_rev->addColumn('content1', 'text');
$tb_web_rev->addColumn('content2', 'text');
$tb_web_rev->addColumn('created', 'datetime');
$tbs[] = $tb_web_rev;

$tb_web_meta = new TableModel('fastsite', 'webpage_meta');
$tb_web_meta->addColumn('webpage_meta_id', 'int', ['key' => 'PRIMARY KEY', 'auto_increment' => true]);
$tb_web_meta->addColumn('webpage_id', 'int');
$tb_web_meta->addColumn('meta_key', 'varchar(64)');
$tb_web_meta->addColumn('meta_value', 'text');
$tb_web_meta->addIndex('index_webpage_id', 'webpage_id');
$tb_web_meta->addIndex('index_webpage_id_meta_key', ['webpage_id', 'meta_key']);
$tbs[] = $tb_web_meta;

$tb_ts = new TableModel('fastsite', 'template_setting');
$tb_ts->addColumn('template_setting_id', 'int', ['key' => 'PRIMARY KEY', 'auto_increment' => true]);
$tb_ts->addColumn('template_name', 'varchar(255)');
$tb_ts->addColumn('active', 'boolean');
$tb_ts->addColumn('edited', 'datetime');
$tb_ts->addColumn('created', 'datetime');
$tb_ts->addIndex('key_template_name', 'template_name', ['unique' => true]);
$tbs[] = $tb_ts;

$tb_webform = new TableModel('fastsite', 'webform');
$tb_webform->addColumn('webform_id', 'int', ['key' => 'PRIMARY KEY', 'auto_increment' => true]);
$tb_webform->addColumn('webform_name', 'varchar(255)');
$tb_webform->addColumn('webform_code', 'varchar(32)');
$tb_webform->addColumn('confirmation_message', 'text');
$tb_webform->addColumn('active', 'boolean');
$tb_webform->addColumn('edited', 'datetime');
$tb_webform->addColumn('created', 'datetime');
$tbs[] = $tb_webform;

$tb_webform_field = new TableModel('fastsite', 'webform_field');
$tb_webform_field->addColumn('webform_field_id', 'int', ['key' => 'PRIMARY KEY', 'auto_increment' => true]);
$tb_webform_field->addColumn('webform_id', 'int');
$tb_webform_field->addColumn('input_field', 'varchar(255)');
$tb_webform_field->addColumn('input_options', 'text');
$tb_webform_field->addColumn('label', 'varchar(255)');
$tb_webform_field->addColumn('default_value', 'varchar(255)');
$tb_webform_field->addColumn('validator', 'varchar(255)');
$tb_webform_field->addColumn('sort', 'int');
$tbs[] = $tb_webform_field;

$tb_webform_submit = new TableModel('fastsite', 'webform_submit');
$tb_webform_submit->addColumn('webform_submit_id', 'int', ['key' => 'PRIMARY KEY', 'auto_increment' => true]);
$tb_webform_submit->addColumn('webform_id', 'int');
$tb_webform_submit->addColumn('raw_request', 'text');
$tb_webform_submit->addColumn('raw_server', 'text');
$tb_webform_submit->addColumn('field_list', 'text');
$tb_webform_submit->addColumn('field_values', 'text');
$tb_webform_submit->addColumn('ip', 'varchar(40)');
$tb_webform_submit->addColumn('deleted', 'boolean');
$tb_webform_submit->addColumn('completed', 'boolean');
$tb_webform_submit->addColumn('created', 'datetime');
$tbs[] = $tb_webform_submit;

$tb_redir = new TableModel('fastsite', 'redirect');
$tb_redir->addColumn('redirect_id', 'int', ['key' => 'PRIMARY KEY', 'auto_increment' => true]);
$tb_redir->addColumn('match_type', "enum('regexp','wildcard','exact')");
$tb_redir->addColumn('pattern', 'varchar(255)');
$tb_redir->addColumn('redirect_url', 'varchar(255)');
$tb_redir->addColumn('active', 'boolean');
$tb_redir->addColumn('sort', 'int');
$tb_redir->addColumn('edited', 'datetime');
$tb_redir->addColumn('created', 'datetime');
$tbs[] = $tb_redir;

return $tbs;


