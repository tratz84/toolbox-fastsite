<?php


$sql = array();
$sql[] = "
create table if not exists fastsite__webmenu (
	webmenu_id int primary key auto_increment,
    parent_webmenu_id int,
    code varchar(64),
    label varchar(255),
    url varchar(255),
    webpage_id int default null,
    description text,
    sort int,
    edited datetime,
    created datetime
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$sql[] = "create table if not exists fastsite__webpage (
	webpage_id int primary key auto_increment,
	webpage_rev_id int,
    code varchar(64),
    url varchar(255),
    fastsite_template_file varchar(255),
    module varchar(64),
    active boolean default true,
    edited datetime,
    created datetime,
    unique(code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$sql[] = "create table if not exists fastsite__webpage_rev (
	webpage_rev_id int primary key auto_increment,
	webpage_id int,
	rev int,
    meta_title text,
    meta_description text,
    meta_keywords text,
    content1 text,
    content2 text,
    created datetime
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$sql[] = "create table if not exists fastsite__webpage_meta (
	webpage_meta_id int primary key auto_increment,
    webpage_id int,
    meta_key varchar(64),
    meta_value text,
    index index_webpage_id (webpage_id),
    index webpage_id_meta_key (webpage_id, meta_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$sql[] = "create table if not exists fastsite__template_setting (
	template_setting_id int primary key auto_increment,
    template_name varchar(255),
    active boolean default false,
    edited datetime,
    created datetime,
    unique key key_template_name (template_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$sql[] = "create table if not exists fastsite__webform (
	webform_id int primary key auto_increment,
    webform_name varchar(255),
    webform_code varchar(32),
    confirmation_message text,
    active boolean default true,
    edited datetime,
    created datetime
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";


$sql[] = "create table if not exists fastsite__webform_field (
	webform_field_id int primary key auto_increment,
    webform_id int,
    input_field varchar(255),
    input_options text,
    label varchar(255),
    default_value varchar(255),
    validator varchar(255),
    sort int
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$sql[] = "create table if not exists fastsite__webform_submit (
	webform_submit_id int primary key auto_increment,
    webform_id int,
    raw_request text,
    raw_server text,
    field_list text,
    field_values text,
    ip varchar(40),
    deleted boolean default false,
    completed boolean default true,
    created datetime
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$sql[] = "create table if not exists fastsite__redirect (
    redirect_id int primary key auto_increment,
    match_type enum('regexp', 'wildcard', 'exact'),
    pattern varchar(255),
    redirect_url varchar(255),
    active boolean default true,
    sort int,
    edited datetime,
    created datetime
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";



