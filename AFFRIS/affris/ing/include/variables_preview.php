<?php
$strTableName="##@TABLE.strDataSourceTable s##";
##if @TABLE.strOriginalTable##
$strOriginalTableName="##@TABLE.strOriginalTable s##";
##else##
$strOriginalTableName="##@TABLE.strDataSourceTable s##";
##endif##
##if @TABLE.nType==titTABLE || @TABLE.nType==titVIEW##
$tdata##@TABLE.strShortTableName##[".pageSize"]=##@TABLE.nNumberOfRecords##;
##endif##

$gstrOrderBy="##@TABLE.strOrderBy s##";
##if @TABLE.nType==titTABLE || @TABLE.nType==titVIEW || @TABLE.nType==titREPORT##
##foreach @TABLE.arrOrderIndexes as @o order @o.nOrderIndex##
##if @first##
$g_orderindexes=array();
##endif##
$g_orderindexes[] = array(##@o.nIndex##, (##@o.bAsc## ? "ASC" : "DESC"), "##@o.strOrderField s##");
##endfor##
##endif##

$gsqlHead="##@TABLE.sqlHead ls##";
$gsqlFrom="##@TABLE.sqlFrom ls##";
$gsqlWhereExpr="##@TABLE.sqlWhere ls##";
$gsqlTail="##@TABLE.sqlTail ls##";
?>
