<?php
$dDebug=false;
##if @BUILDER.strCharset=="Windows-949"##
$cCharset = "korean";
##else##
$cCharset = "##@BUILDER.strCharset s##";
##endif##

##if @BUILDER.m_nDatabaseType==nDATABASE_MySQL##
$host="##@BUILDER.strConnectInfo1 s##";
$user="##@BUILDER.strConnectInfo2 s##";
$pwd="##@BUILDER.strConnectInfo3 s##";
$port="##@BUILDER.strConnectInfo4 s##";
$sys_dbname="##@BUILDER.strConnectInfo5 s##";

##elseif @BUILDER.m_nDatabaseType==nDATABASE_MSSQLServer##
$host="##@BUILDER.strConnectInfo1 s##";
$user="##@BUILDER.strConnectInfo2 s##";
$pwd="##@BUILDER.strConnectInfo3 s##";
$dbname="##@BUILDER.strConnectInfo4 s##";

##elseif @BUILDER.m_nDatabaseType==nDATABASE_Access##
$dsn="##@BUILDER.strConnectInfo1 s##";
$user="##@BUILDER.strConnectInfo2 s##";
$pwd="##@BUILDER.strConnectInfo3 s##";

##elseif @BUILDER.m_nDatabaseType==nDATABASE_Oracle##
$user="##@BUILDER.strConnectInfo1 s##";
$pwd="##@BUILDER.strConnectInfo2 s##";
$sid="##@BUILDER.strConnectInfo3 s##";

##elseif @BUILDER.m_nDatabaseType==nDATABASE_PostgreSQL##
$host="##@BUILDER.strConnectInfo1 s##";
$user="##@BUILDER.strConnectInfo2 s##";
$password="##@BUILDER.strConnectInfo3 s##";
$options="##@BUILDER.strConnectInfo4 s##";
$dbname="##@BUILDER.strConnectInfo5 s##";

$connstr=	"host='".pg_escape_string($host).
			"' user='".pg_escape_string($user).
			"' password='".pg_escape_string($password).
			"' dbname='".pg_escape_string($dbname).
			"' ".$options;
##endif##

$bSubqueriesSupported=true;
$strLeftWrapper="##@BUILDER.cLeftWrap s##";
$strRightWrapper="##@BUILDER.cRightWrap s##";

##if @BUILDER.bDynamicPermissions##
$gPermissionsRefreshTime=0;
$gPermissionsRead=false;
##endif##
set_error_handler("error_handler");
$suggestAllContent = true;

?>