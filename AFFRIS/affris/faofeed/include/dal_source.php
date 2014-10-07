<?php

$dal_info=array();
$daltable_tb_specgroup = array();
$daltable_tb_specgroup["GroupID"]=array();
$daltable_tb_specgroup["GroupID"]["nType"]=3;
	$daltable_tb_specgroup["GroupID"]["bKey"]=true;
$daltable_tb_specgroup["GroupID"]["varname"]="GroupID";
$daltable_tb_specgroup["Description"]=array();
$daltable_tb_specgroup["Description"]["nType"]=200;
	$daltable_tb_specgroup["Description"]["varname"]="Description";
$dal_info["tb_specgroup"]=&$daltable_tb_specgroup;
$daltable_tb_specfeedhabit = array();
$daltable_tb_specfeedhabit["FeedHabitID"]=array();
$daltable_tb_specfeedhabit["FeedHabitID"]["nType"]=3;
	$daltable_tb_specfeedhabit["FeedHabitID"]["bKey"]=true;
$daltable_tb_specfeedhabit["FeedHabitID"]["varname"]="FeedHabitID";
$daltable_tb_specfeedhabit["Description"]=array();
$daltable_tb_specfeedhabit["Description"]["nType"]=200;
	$daltable_tb_specfeedhabit["Description"]["varname"]="Description";
$dal_info["tb_specfeedhabit"]=&$daltable_tb_specfeedhabit;
$daltable_vw_antinutritional = array();
$daltable_vw_antinutritional["IngredientID"]=array();
$daltable_vw_antinutritional["IngredientID"]["nType"]=3;
	$daltable_vw_antinutritional["IngredientID"]["varname"]="IngredientID";
$daltable_vw_antinutritional["IName"]=array();
$daltable_vw_antinutritional["IName"]["nType"]=200;
	$daltable_vw_antinutritional["IName"]["varname"]="IName";
$daltable_vw_antinutritional["Description"]=array();
$daltable_vw_antinutritional["Description"]["nType"]=200;
	$daltable_vw_antinutritional["Description"]["varname"]="Description";
$daltable_vw_antinutritional["AntiID"]=array();
$daltable_vw_antinutritional["AntiID"]["nType"]=3;
	$daltable_vw_antinutritional["AntiID"]["varname"]="AntiID";
$daltable_vw_antinutritional["AntiFactor"]=array();
$daltable_vw_antinutritional["AntiFactor"]["nType"]=200;
	$daltable_vw_antinutritional["AntiFactor"]["varname"]="AntiFactor";
$daltable_vw_antinutritional["ToxicLevel"]=array();
$daltable_vw_antinutritional["ToxicLevel"]["nType"]=200;
	$daltable_vw_antinutritional["ToxicLevel"]["varname"]="ToxicLevel";
$daltable_vw_antinutritional["TreatmentID"]=array();
$daltable_vw_antinutritional["TreatmentID"]["nType"]=3;
	$daltable_vw_antinutritional["TreatmentID"]["varname"]="TreatmentID";
$daltable_vw_antinutritional["Treatment"]=array();
$daltable_vw_antinutritional["Treatment"]["nType"]=200;
	$daltable_vw_antinutritional["Treatment"]["varname"]="Treatment";
$daltable_vw_antinutritional["IDSourceID"]=array();
$daltable_vw_antinutritional["IDSourceID"]["nType"]=3;
	$daltable_vw_antinutritional["IDSourceID"]["varname"]="IDSourceID";
$daltable_vw_antinutritional["DataSource"]=array();
$daltable_vw_antinutritional["DataSource"]["nType"]=200;
	$daltable_vw_antinutritional["DataSource"]["varname"]="DataSource";
$daltable_vw_antinutritional["PartUsedID"]=array();
$daltable_vw_antinutritional["PartUsedID"]["nType"]=3;
	$daltable_vw_antinutritional["PartUsedID"]["varname"]="PartUsedID";
$daltable_vw_antinutritional["PartUsed"]=array();
$daltable_vw_antinutritional["PartUsed"]["nType"]=200;
	$daltable_vw_antinutritional["PartUsed"]["varname"]="PartUsed";
$dal_info["vw_antinutritional"]=&$daltable_vw_antinutritional;
$daltable_vw_digestibility = array();
$daltable_vw_digestibility["IngredientID"]=array();
$daltable_vw_digestibility["IngredientID"]["nType"]=3;
	$daltable_vw_digestibility["IngredientID"]["varname"]="IngredientID";
$daltable_vw_digestibility["IName"]=array();
$daltable_vw_digestibility["IName"]["nType"]=200;
	$daltable_vw_digestibility["IName"]["varname"]="IName";
$daltable_vw_digestibility["Description"]=array();
$daltable_vw_digestibility["Description"]["nType"]=200;
	$daltable_vw_digestibility["Description"]["varname"]="Description";
$daltable_vw_digestibility["SpeciesID"]=array();
$daltable_vw_digestibility["SpeciesID"]["nType"]=3;
	$daltable_vw_digestibility["SpeciesID"]["varname"]="SpeciesID";
$daltable_vw_digestibility["SpecName"]=array();
$daltable_vw_digestibility["SpecName"]["nType"]=200;
	$daltable_vw_digestibility["SpecName"]["varname"]="SpecName";
$daltable_vw_digestibility["CommonName"]=array();
$daltable_vw_digestibility["CommonName"]["nType"]=200;
	$daltable_vw_digestibility["CommonName"]["varname"]="CommonName";
$daltable_vw_digestibility["DigestTypeID"]=array();
$daltable_vw_digestibility["DigestTypeID"]["nType"]=3;
	$daltable_vw_digestibility["DigestTypeID"]["varname"]="DigestTypeID";
$daltable_vw_digestibility["DigestibilityType"]=array();
$daltable_vw_digestibility["DigestibilityType"]["nType"]=200;
	$daltable_vw_digestibility["DigestibilityType"]["varname"]="DigestibilityType";
$daltable_vw_digestibility["DValue"]=array();
$daltable_vw_digestibility["DValue"]["nType"]=5;
	$daltable_vw_digestibility["DValue"]["varname"]="DValue";
$daltable_vw_digestibility["Country"]=array();
$daltable_vw_digestibility["Country"]["nType"]=200;
	$daltable_vw_digestibility["Country"]["varname"]="Country";
$daltable_vw_digestibility["DataSource"]=array();
$daltable_vw_digestibility["DataSource"]["nType"]=200;
	$daltable_vw_digestibility["DataSource"]["varname"]="DataSource";
$dal_info["vw_digestibility"]=&$daltable_vw_digestibility;
$daltable_users = array();
$daltable_users["ID"]=array();
$daltable_users["ID"]["nType"]=3;
	$daltable_users["ID"]["bKey"]=true;
$daltable_users["ID"]["varname"]="ID";
$daltable_users["user"]=array();
$daltable_users["user"]["nType"]=200;
	$daltable_users["user"]["varname"]="user";
$daltable_users["pass"]=array();
$daltable_users["pass"]["nType"]=200;
	$daltable_users["pass"]["varname"]="pass";
$dal_info["users"]=&$daltable_users;
$daltable_vw_species = array();
$daltable_vw_species["SpeciesID"]=array();
$daltable_vw_species["SpeciesID"]["nType"]=3;
	$daltable_vw_species["SpeciesID"]["varname"]="SpeciesID";
$daltable_vw_species["SpecName"]=array();
$daltable_vw_species["SpecName"]["nType"]=200;
	$daltable_vw_species["SpecName"]["varname"]="SpecName";
$daltable_vw_species["CommonName"]=array();
$daltable_vw_species["CommonName"]["nType"]=200;
	$daltable_vw_species["CommonName"]["varname"]="CommonName";
$daltable_vw_species["Hybrid"]=array();
$daltable_vw_species["Hybrid"]["nType"]=200;
	$daltable_vw_species["Hybrid"]["varname"]="Hybrid";
$daltable_vw_species["Variety"]=array();
$daltable_vw_species["Variety"]["nType"]=200;
	$daltable_vw_species["Variety"]["varname"]="Variety";
$daltable_vw_species["Family"]=array();
$daltable_vw_species["Family"]["nType"]=200;
	$daltable_vw_species["Family"]["varname"]="Family";
$daltable_vw_species["Group"]=array();
$daltable_vw_species["Group"]["nType"]=200;
	$daltable_vw_species["Group"]["varname"]="Group";
$daltable_vw_species["Genus"]=array();
$daltable_vw_species["Genus"]["nType"]=200;
	$daltable_vw_species["Genus"]["varname"]="Genus";
$daltable_vw_species["Environment"]=array();
$daltable_vw_species["Environment"]["nType"]=200;
	$daltable_vw_species["Environment"]["varname"]="Environment";
$daltable_vw_species["FeedHabit"]=array();
$daltable_vw_species["FeedHabit"]["nType"]=200;
	$daltable_vw_species["FeedHabit"]["varname"]="FeedHabit";
$daltable_vw_species["Country"]=array();
$daltable_vw_species["Country"]["nType"]=200;
	$daltable_vw_species["Country"]["varname"]="Country";
$daltable_vw_species["SpecYear"]=array();
$daltable_vw_species["SpecYear"]["nType"]=3;
	$daltable_vw_species["SpecYear"]["varname"]="SpecYear";
$dal_info["vw_species"]=&$daltable_vw_species;
$daltable_vw_feedspec = array();
$daltable_vw_feedspec["FeedID"]=array();
$daltable_vw_feedspec["FeedID"]["nType"]=3;
	$daltable_vw_feedspec["FeedID"]["varname"]="FeedID";
$daltable_vw_feedspec["FName"]=array();
$daltable_vw_feedspec["FName"]["nType"]=200;
	$daltable_vw_feedspec["FName"]["varname"]="FName";
$daltable_vw_feedspec["BrandName"]=array();
$daltable_vw_feedspec["BrandName"]["nType"]=200;
	$daltable_vw_feedspec["BrandName"]["varname"]="BrandName";
$daltable_vw_feedspec["Technology"]=array();
$daltable_vw_feedspec["Technology"]["nType"]=200;
	$daltable_vw_feedspec["Technology"]["varname"]="Technology";
$daltable_vw_feedspec["FeedYear"]=array();
$daltable_vw_feedspec["FeedYear"]["nType"]=3;
	$daltable_vw_feedspec["FeedYear"]["varname"]="FeedYear";
$daltable_vw_feedspec["Stage"]=array();
$daltable_vw_feedspec["Stage"]["nType"]=200;
	$daltable_vw_feedspec["Stage"]["varname"]="Stage";
$daltable_vw_feedspec["FCountryID"]=array();
$daltable_vw_feedspec["FCountryID"]["nType"]=3;
	$daltable_vw_feedspec["FCountryID"]["varname"]="FCountryID";
$daltable_vw_feedspec["CountryOrigin"]=array();
$daltable_vw_feedspec["CountryOrigin"]["nType"]=200;
	$daltable_vw_feedspec["CountryOrigin"]["varname"]="CountryOrigin";
$daltable_vw_feedspec["FIDSourceID"]=array();
$daltable_vw_feedspec["FIDSourceID"]["nType"]=3;
	$daltable_vw_feedspec["FIDSourceID"]["varname"]="FIDSourceID";
$daltable_vw_feedspec["FisDetail"]=array();
$daltable_vw_feedspec["FisDetail"]["nType"]=13;
	$daltable_vw_feedspec["FisDetail"]["varname"]="FisDetail";
$daltable_vw_feedspec["FDataSource"]=array();
$daltable_vw_feedspec["FDataSource"]["nType"]=200;
	$daltable_vw_feedspec["FDataSource"]["varname"]="FDataSource";
$daltable_vw_feedspec["FeedTypeID"]=array();
$daltable_vw_feedspec["FeedTypeID"]["nType"]=3;
	$daltable_vw_feedspec["FeedTypeID"]["varname"]="FeedTypeID";
$daltable_vw_feedspec["FeedType"]=array();
$daltable_vw_feedspec["FeedType"]["nType"]=200;
	$daltable_vw_feedspec["FeedType"]["varname"]="FeedType";
$daltable_vw_feedspec["SpeciesID"]=array();
$daltable_vw_feedspec["SpeciesID"]["nType"]=3;
	$daltable_vw_feedspec["SpeciesID"]["varname"]="SpeciesID";
$daltable_vw_feedspec["SpecName"]=array();
$daltable_vw_feedspec["SpecName"]["nType"]=200;
	$daltable_vw_feedspec["SpecName"]["varname"]="SpecName";
$daltable_vw_feedspec["CommonName"]=array();
$daltable_vw_feedspec["CommonName"]["nType"]=200;
	$daltable_vw_feedspec["CommonName"]["varname"]="CommonName";
$daltable_vw_feedspec["Hybrid"]=array();
$daltable_vw_feedspec["Hybrid"]["nType"]=200;
	$daltable_vw_feedspec["Hybrid"]["varname"]="Hybrid";
$daltable_vw_feedspec["Variety"]=array();
$daltable_vw_feedspec["Variety"]["nType"]=200;
	$daltable_vw_feedspec["Variety"]["varname"]="Variety";
$daltable_vw_feedspec["Family"]=array();
$daltable_vw_feedspec["Family"]["nType"]=200;
	$daltable_vw_feedspec["Family"]["varname"]="Family";
$daltable_vw_feedspec["Group"]=array();
$daltable_vw_feedspec["Group"]["nType"]=200;
	$daltable_vw_feedspec["Group"]["varname"]="Group";
$daltable_vw_feedspec["Genus"]=array();
$daltable_vw_feedspec["Genus"]["nType"]=200;
	$daltable_vw_feedspec["Genus"]["varname"]="Genus";
$daltable_vw_feedspec["Environment"]=array();
$daltable_vw_feedspec["Environment"]["nType"]=200;
	$daltable_vw_feedspec["Environment"]["varname"]="Environment";
$daltable_vw_feedspec["FeedHabit"]=array();
$daltable_vw_feedspec["FeedHabit"]["nType"]=200;
	$daltable_vw_feedspec["FeedHabit"]["varname"]="FeedHabit";
$daltable_vw_feedspec["Country"]=array();
$daltable_vw_feedspec["Country"]["nType"]=200;
	$daltable_vw_feedspec["Country"]["varname"]="Country";
$daltable_vw_feedspec["SpecYear"]=array();
$daltable_vw_feedspec["SpecYear"]["nType"]=3;
	$daltable_vw_feedspec["SpecYear"]["varname"]="SpecYear";
$dal_info["vw_feedspec"]=&$daltable_vw_feedspec;
$daltable_vw_feedanalysis = array();
$daltable_vw_feedanalysis["FeedID"]=array();
$daltable_vw_feedanalysis["FeedID"]["nType"]=3;
	$daltable_vw_feedanalysis["FeedID"]["varname"]="FeedID";
$daltable_vw_feedanalysis["FName"]=array();
$daltable_vw_feedanalysis["FName"]["nType"]=200;
	$daltable_vw_feedanalysis["FName"]["varname"]="FName";
$daltable_vw_feedanalysis["BrandName"]=array();
$daltable_vw_feedanalysis["BrandName"]["nType"]=200;
	$daltable_vw_feedanalysis["BrandName"]["varname"]="BrandName";
$daltable_vw_feedanalysis["Technology"]=array();
$daltable_vw_feedanalysis["Technology"]["nType"]=200;
	$daltable_vw_feedanalysis["Technology"]["varname"]="Technology";
$daltable_vw_feedanalysis["FeedYear"]=array();
$daltable_vw_feedanalysis["FeedYear"]["nType"]=3;
	$daltable_vw_feedanalysis["FeedYear"]["varname"]="FeedYear";
$daltable_vw_feedanalysis["Stage"]=array();
$daltable_vw_feedanalysis["Stage"]["nType"]=200;
	$daltable_vw_feedanalysis["Stage"]["varname"]="Stage";
$daltable_vw_feedanalysis["FCountryID"]=array();
$daltable_vw_feedanalysis["FCountryID"]["nType"]=3;
	$daltable_vw_feedanalysis["FCountryID"]["varname"]="FCountryID";
$daltable_vw_feedanalysis["CountryOrigin"]=array();
$daltable_vw_feedanalysis["CountryOrigin"]["nType"]=200;
	$daltable_vw_feedanalysis["CountryOrigin"]["varname"]="CountryOrigin";
$daltable_vw_feedanalysis["FIDSourceID"]=array();
$daltable_vw_feedanalysis["FIDSourceID"]["nType"]=3;
	$daltable_vw_feedanalysis["FIDSourceID"]["varname"]="FIDSourceID";
$daltable_vw_feedanalysis["FisDetail"]=array();
$daltable_vw_feedanalysis["FisDetail"]["nType"]=13;
	$daltable_vw_feedanalysis["FisDetail"]["varname"]="FisDetail";
$daltable_vw_feedanalysis["FDataSource"]=array();
$daltable_vw_feedanalysis["FDataSource"]["nType"]=200;
	$daltable_vw_feedanalysis["FDataSource"]["varname"]="FDataSource";
$daltable_vw_feedanalysis["FeedTypeID"]=array();
$daltable_vw_feedanalysis["FeedTypeID"]["nType"]=3;
	$daltable_vw_feedanalysis["FeedTypeID"]["varname"]="FeedTypeID";
$daltable_vw_feedanalysis["FeedType"]=array();
$daltable_vw_feedanalysis["FeedType"]["nType"]=200;
	$daltable_vw_feedanalysis["FeedType"]["varname"]="FeedType";
$daltable_vw_feedanalysis["FeedAnalysisTypeID"]=array();
$daltable_vw_feedanalysis["FeedAnalysisTypeID"]["nType"]=3;
	$daltable_vw_feedanalysis["FeedAnalysisTypeID"]["varname"]="FeedAnalysisTypeID";
$daltable_vw_feedanalysis["FeedAnalysisType"]=array();
$daltable_vw_feedanalysis["FeedAnalysisType"]["nType"]=200;
	$daltable_vw_feedanalysis["FeedAnalysisType"]["varname"]="FeedAnalysisType";
$daltable_vw_feedanalysis["FATTagName"]=array();
$daltable_vw_feedanalysis["FATTagName"]["nType"]=200;
	$daltable_vw_feedanalysis["FATTagName"]["varname"]="FATTagName";
$daltable_vw_feedanalysis["UnitID"]=array();
$daltable_vw_feedanalysis["UnitID"]["nType"]=3;
	$daltable_vw_feedanalysis["UnitID"]["varname"]="UnitID";
$daltable_vw_feedanalysis["UnitName"]=array();
$daltable_vw_feedanalysis["UnitName"]["nType"]=200;
	$daltable_vw_feedanalysis["UnitName"]["varname"]="UnitName";
$daltable_vw_feedanalysis["UnitSymbol"]=array();
$daltable_vw_feedanalysis["UnitSymbol"]["nType"]=200;
	$daltable_vw_feedanalysis["UnitSymbol"]["varname"]="UnitSymbol";
$daltable_vw_feedanalysis["UnitDecimal"]=array();
$daltable_vw_feedanalysis["UnitDecimal"]["nType"]=2;
	$daltable_vw_feedanalysis["UnitDecimal"]["varname"]="UnitDecimal";
$daltable_vw_feedanalysis["FAValue"]=array();
$daltable_vw_feedanalysis["FAValue"]["nType"]=5;
	$daltable_vw_feedanalysis["FAValue"]["varname"]="FAValue";
$daltable_vw_feedanalysis["isShownDetail"]=array();
$daltable_vw_feedanalysis["isShownDetail"]["nType"]=13;
	$daltable_vw_feedanalysis["isShownDetail"]["varname"]="isShownDetail";
$dal_info["vw_feedanalysis"]=&$daltable_vw_feedanalysis;
$daltable_vw_feedingredient = array();
$daltable_vw_feedingredient["FeedID"]=array();
$daltable_vw_feedingredient["FeedID"]["nType"]=3;
	$daltable_vw_feedingredient["FeedID"]["varname"]="FeedID";
$daltable_vw_feedingredient["FName"]=array();
$daltable_vw_feedingredient["FName"]["nType"]=200;
	$daltable_vw_feedingredient["FName"]["varname"]="FName";
$daltable_vw_feedingredient["FisDetail"]=array();
$daltable_vw_feedingredient["FisDetail"]["nType"]=13;
	$daltable_vw_feedingredient["FisDetail"]["varname"]="FisDetail";
$daltable_vw_feedingredient["IngredientID"]=array();
$daltable_vw_feedingredient["IngredientID"]["nType"]=3;
	$daltable_vw_feedingredient["IngredientID"]["varname"]="IngredientID";
$daltable_vw_feedingredient["IName"]=array();
$daltable_vw_feedingredient["IName"]["nType"]=200;
	$daltable_vw_feedingredient["IName"]["varname"]="IName";
$daltable_vw_feedingredient["IisDetail"]=array();
$daltable_vw_feedingredient["IisDetail"]["nType"]=13;
	$daltable_vw_feedingredient["IisDetail"]["varname"]="IisDetail";
$daltable_vw_feedingredient["FValue"]=array();
$daltable_vw_feedingredient["FValue"]["nType"]=5;
	$daltable_vw_feedingredient["FValue"]["varname"]="FValue";
$dal_info["vw_feedingredient"]=&$daltable_vw_feedingredient;
$daltable_vw_ingredient = array();
$daltable_vw_ingredient["IngredientID"]=array();
$daltable_vw_ingredient["IngredientID"]["nType"]=3;
	$daltable_vw_ingredient["IngredientID"]["varname"]="IngredientID";
$daltable_vw_ingredient["IName"]=array();
$daltable_vw_ingredient["IName"]["nType"]=200;
	$daltable_vw_ingredient["IName"]["varname"]="IName";
$daltable_vw_ingredient["IfeedNo"]=array();
$daltable_vw_ingredient["IfeedNo"]["nType"]=200;
	$daltable_vw_ingredient["IfeedNo"]["varname"]="IfeedNo";
$daltable_vw_ingredient["Description1"]=array();
$daltable_vw_ingredient["Description1"]["nType"]=200;
	$daltable_vw_ingredient["Description1"]["varname"]="Description1";
$daltable_vw_ingredient["Description2"]=array();
$daltable_vw_ingredient["Description2"]["nType"]=200;
	$daltable_vw_ingredient["Description2"]["varname"]="Description2";
$daltable_vw_ingredient["Description3"]=array();
$daltable_vw_ingredient["Description3"]["nType"]=200;
	$daltable_vw_ingredient["Description3"]["varname"]="Description3";
$daltable_vw_ingredient["IisDetail"]=array();
$daltable_vw_ingredient["IisDetail"]["nType"]=13;
	$daltable_vw_ingredient["IisDetail"]["varname"]="IisDetail";
$daltable_vw_ingredient["IDSourceID"]=array();
$daltable_vw_ingredient["IDSourceID"]["nType"]=3;
	$daltable_vw_ingredient["IDSourceID"]["varname"]="IDSourceID";
$daltable_vw_ingredient["DataSource"]=array();
$daltable_vw_ingredient["DataSource"]["nType"]=200;
	$daltable_vw_ingredient["DataSource"]["varname"]="DataSource";
$daltable_vw_ingredient["CountryID"]=array();
$daltable_vw_ingredient["CountryID"]["nType"]=3;
	$daltable_vw_ingredient["CountryID"]["varname"]="CountryID";
$daltable_vw_ingredient["ICountry"]=array();
$daltable_vw_ingredient["ICountry"]["nType"]=200;
	$daltable_vw_ingredient["ICountry"]["varname"]="ICountry";
$daltable_vw_ingredient["IngredientSpecID"]=array();
$daltable_vw_ingredient["IngredientSpecID"]["nType"]=3;
	$daltable_vw_ingredient["IngredientSpecID"]["varname"]="IngredientSpecID";
$daltable_vw_ingredient["Species"]=array();
$daltable_vw_ingredient["Species"]["nType"]=200;
	$daltable_vw_ingredient["Species"]["varname"]="Species";
$dal_info["vw_ingredient"]=&$daltable_vw_ingredient;
$daltable_vw_feed = array();
$daltable_vw_feed["FeedID"]=array();
$daltable_vw_feed["FeedID"]["nType"]=3;
	$daltable_vw_feed["FeedID"]["varname"]="FeedID";
$daltable_vw_feed["FName"]=array();
$daltable_vw_feed["FName"]["nType"]=200;
	$daltable_vw_feed["FName"]["varname"]="FName";
$daltable_vw_feed["BrandName"]=array();
$daltable_vw_feed["BrandName"]["nType"]=200;
	$daltable_vw_feed["BrandName"]["varname"]="BrandName";
$daltable_vw_feed["Technology"]=array();
$daltable_vw_feed["Technology"]["nType"]=200;
	$daltable_vw_feed["Technology"]["varname"]="Technology";
$daltable_vw_feed["FeedYear"]=array();
$daltable_vw_feed["FeedYear"]["nType"]=3;
	$daltable_vw_feed["FeedYear"]["varname"]="FeedYear";
$daltable_vw_feed["Stage"]=array();
$daltable_vw_feed["Stage"]["nType"]=200;
	$daltable_vw_feed["Stage"]["varname"]="Stage";
$daltable_vw_feed["FCountryID"]=array();
$daltable_vw_feed["FCountryID"]["nType"]=3;
	$daltable_vw_feed["FCountryID"]["varname"]="FCountryID";
$daltable_vw_feed["CountryOrigin"]=array();
$daltable_vw_feed["CountryOrigin"]["nType"]=200;
	$daltable_vw_feed["CountryOrigin"]["varname"]="CountryOrigin";
$daltable_vw_feed["FIDSourceID"]=array();
$daltable_vw_feed["FIDSourceID"]["nType"]=3;
	$daltable_vw_feed["FIDSourceID"]["varname"]="FIDSourceID";
$daltable_vw_feed["FisDetail"]=array();
$daltable_vw_feed["FisDetail"]["nType"]=13;
	$daltable_vw_feed["FisDetail"]["varname"]="FisDetail";
$daltable_vw_feed["FDataSource"]=array();
$daltable_vw_feed["FDataSource"]["nType"]=200;
	$daltable_vw_feed["FDataSource"]["varname"]="FDataSource";
$daltable_vw_feed["FeedTypeID"]=array();
$daltable_vw_feed["FeedTypeID"]["nType"]=3;
	$daltable_vw_feed["FeedTypeID"]["varname"]="FeedTypeID";
$daltable_vw_feed["FeedType"]=array();
$daltable_vw_feed["FeedType"]["nType"]=200;
	$daltable_vw_feed["FeedType"]["varname"]="FeedType";
$dal_info["vw_feed"]=&$daltable_vw_feed;
$daltable_vw_fullingredientelementanalysis = array();
$daltable_vw_fullingredientelementanalysis["IngredientID"]=array();
$daltable_vw_fullingredientelementanalysis["IngredientID"]["nType"]=3;
	$daltable_vw_fullingredientelementanalysis["IngredientID"]["varname"]="IngredientID";
$daltable_vw_fullingredientelementanalysis["ElementID"]=array();
$daltable_vw_fullingredientelementanalysis["ElementID"]["nType"]=3;
	$daltable_vw_fullingredientelementanalysis["ElementID"]["varname"]="ElementID";
$daltable_vw_fullingredientelementanalysis["EName"]=array();
$daltable_vw_fullingredientelementanalysis["EName"]["nType"]=200;
	$daltable_vw_fullingredientelementanalysis["EName"]["varname"]="EName";
$daltable_vw_fullingredientelementanalysis["CommonName"]=array();
$daltable_vw_fullingredientelementanalysis["CommonName"]["nType"]=200;
	$daltable_vw_fullingredientelementanalysis["CommonName"]["varname"]="CommonName";
$daltable_vw_fullingredientelementanalysis["TagName"]=array();
$daltable_vw_fullingredientelementanalysis["TagName"]["nType"]=200;
	$daltable_vw_fullingredientelementanalysis["TagName"]["varname"]="TagName";
$daltable_vw_fullingredientelementanalysis["ElementTypeID"]=array();
$daltable_vw_fullingredientelementanalysis["ElementTypeID"]["nType"]=3;
	$daltable_vw_fullingredientelementanalysis["ElementTypeID"]["varname"]="ElementTypeID";
$daltable_vw_fullingredientelementanalysis["Description"]=array();
$daltable_vw_fullingredientelementanalysis["Description"]["nType"]=200;
	$daltable_vw_fullingredientelementanalysis["Description"]["varname"]="Description";
$daltable_vw_fullingredientelementanalysis["UnitID"]=array();
$daltable_vw_fullingredientelementanalysis["UnitID"]["nType"]=3;
	$daltable_vw_fullingredientelementanalysis["UnitID"]["varname"]="UnitID";
$daltable_vw_fullingredientelementanalysis["UnitName"]=array();
$daltable_vw_fullingredientelementanalysis["UnitName"]["nType"]=200;
	$daltable_vw_fullingredientelementanalysis["UnitName"]["varname"]="UnitName";
$daltable_vw_fullingredientelementanalysis["UnitSymbol"]=array();
$daltable_vw_fullingredientelementanalysis["UnitSymbol"]["nType"]=200;
	$daltable_vw_fullingredientelementanalysis["UnitSymbol"]["varname"]="UnitSymbol";
$daltable_vw_fullingredientelementanalysis["UnitDecimal"]=array();
$daltable_vw_fullingredientelementanalysis["UnitDecimal"]["nType"]=2;
	$daltable_vw_fullingredientelementanalysis["UnitDecimal"]["varname"]="UnitDecimal";
$daltable_vw_fullingredientelementanalysis["IValue"]=array();
$daltable_vw_fullingredientelementanalysis["IValue"]["nType"]=5;
	$daltable_vw_fullingredientelementanalysis["IValue"]["varname"]="IValue";
$dal_info["vw_fullingredientelementanalysis"]=&$daltable_vw_fullingredientelementanalysis;
$daltable_vw_fullingredientproxanalysis = array();
$daltable_vw_fullingredientproxanalysis["IngredientID"]=array();
$daltable_vw_fullingredientproxanalysis["IngredientID"]["nType"]=3;
	$daltable_vw_fullingredientproxanalysis["IngredientID"]["varname"]="IngredientID";
$daltable_vw_fullingredientproxanalysis["ElementTypeID"]=array();
$daltable_vw_fullingredientproxanalysis["ElementTypeID"]["nType"]=3;
	$daltable_vw_fullingredientproxanalysis["ElementTypeID"]["varname"]="ElementTypeID";
$daltable_vw_fullingredientproxanalysis["Description"]=array();
$daltable_vw_fullingredientproxanalysis["Description"]["nType"]=200;
	$daltable_vw_fullingredientproxanalysis["Description"]["varname"]="Description";
$daltable_vw_fullingredientproxanalysis["UnitName"]=array();
$daltable_vw_fullingredientproxanalysis["UnitName"]["nType"]=200;
	$daltable_vw_fullingredientproxanalysis["UnitName"]["varname"]="UnitName";
$daltable_vw_fullingredientproxanalysis["UnitSymbol"]=array();
$daltable_vw_fullingredientproxanalysis["UnitSymbol"]["nType"]=200;
	$daltable_vw_fullingredientproxanalysis["UnitSymbol"]["varname"]="UnitSymbol";
$daltable_vw_fullingredientproxanalysis["UnitDecimal"]=array();
$daltable_vw_fullingredientproxanalysis["UnitDecimal"]["nType"]=2;
	$daltable_vw_fullingredientproxanalysis["UnitDecimal"]["varname"]="UnitDecimal";
$daltable_vw_fullingredientproxanalysis["ETValue"]=array();
$daltable_vw_fullingredientproxanalysis["ETValue"]["nType"]=5;
	$daltable_vw_fullingredientproxanalysis["ETValue"]["varname"]="ETValue";
$dal_info["vw_fullingredientproxanalysis"]=&$daltable_vw_fullingredientproxanalysis;
$daltable_vw_fullfeedproxanalysis = array();
$daltable_vw_fullfeedproxanalysis["FeedID"]=array();
$daltable_vw_fullfeedproxanalysis["FeedID"]["nType"]=3;
	$daltable_vw_fullfeedproxanalysis["FeedID"]["varname"]="FeedID";
$daltable_vw_fullfeedproxanalysis["ElementTypeID"]=array();
$daltable_vw_fullfeedproxanalysis["ElementTypeID"]["nType"]=3;
	$daltable_vw_fullfeedproxanalysis["ElementTypeID"]["varname"]="ElementTypeID";
$daltable_vw_fullfeedproxanalysis["Description"]=array();
$daltable_vw_fullfeedproxanalysis["Description"]["nType"]=200;
	$daltable_vw_fullfeedproxanalysis["Description"]["varname"]="Description";
$daltable_vw_fullfeedproxanalysis["isShownDetail"]=array();
$daltable_vw_fullfeedproxanalysis["isShownDetail"]["nType"]=13;
	$daltable_vw_fullfeedproxanalysis["isShownDetail"]["varname"]="isShownDetail";
$daltable_vw_fullfeedproxanalysis["ETTagName"]=array();
$daltable_vw_fullfeedproxanalysis["ETTagName"]["nType"]=200;
	$daltable_vw_fullfeedproxanalysis["ETTagName"]["varname"]="ETTagName";
$daltable_vw_fullfeedproxanalysis["UnitID"]=array();
$daltable_vw_fullfeedproxanalysis["UnitID"]["nType"]=3;
	$daltable_vw_fullfeedproxanalysis["UnitID"]["varname"]="UnitID";
$daltable_vw_fullfeedproxanalysis["UnitName"]=array();
$daltable_vw_fullfeedproxanalysis["UnitName"]["nType"]=200;
	$daltable_vw_fullfeedproxanalysis["UnitName"]["varname"]="UnitName";
$daltable_vw_fullfeedproxanalysis["UnitSymbol"]=array();
$daltable_vw_fullfeedproxanalysis["UnitSymbol"]["nType"]=200;
	$daltable_vw_fullfeedproxanalysis["UnitSymbol"]["varname"]="UnitSymbol";
$daltable_vw_fullfeedproxanalysis["UnitDecimal"]=array();
$daltable_vw_fullfeedproxanalysis["UnitDecimal"]["nType"]=2;
	$daltable_vw_fullfeedproxanalysis["UnitDecimal"]["varname"]="UnitDecimal";
$daltable_vw_fullfeedproxanalysis["ETValue"]=array();
$daltable_vw_fullfeedproxanalysis["ETValue"]["nType"]=5;
	$daltable_vw_fullfeedproxanalysis["ETValue"]["varname"]="ETValue";
$dal_info["vw_fullfeedproxanalysis"]=&$daltable_vw_fullfeedproxanalysis;
$daltable_vw_fullfeedelementanalysis = array();
$daltable_vw_fullfeedelementanalysis["FeedID"]=array();
$daltable_vw_fullfeedelementanalysis["FeedID"]["nType"]=3;
	$daltable_vw_fullfeedelementanalysis["FeedID"]["varname"]="FeedID";
$daltable_vw_fullfeedelementanalysis["ElementID"]=array();
$daltable_vw_fullfeedelementanalysis["ElementID"]["nType"]=3;
	$daltable_vw_fullfeedelementanalysis["ElementID"]["varname"]="ElementID";
$daltable_vw_fullfeedelementanalysis["EName"]=array();
$daltable_vw_fullfeedelementanalysis["EName"]["nType"]=200;
	$daltable_vw_fullfeedelementanalysis["EName"]["varname"]="EName";
$daltable_vw_fullfeedelementanalysis["CommonName"]=array();
$daltable_vw_fullfeedelementanalysis["CommonName"]["nType"]=200;
	$daltable_vw_fullfeedelementanalysis["CommonName"]["varname"]="CommonName";
$daltable_vw_fullfeedelementanalysis["TagName"]=array();
$daltable_vw_fullfeedelementanalysis["TagName"]["nType"]=200;
	$daltable_vw_fullfeedelementanalysis["TagName"]["varname"]="TagName";
$daltable_vw_fullfeedelementanalysis["UnitID"]=array();
$daltable_vw_fullfeedelementanalysis["UnitID"]["nType"]=3;
	$daltable_vw_fullfeedelementanalysis["UnitID"]["varname"]="UnitID";
$daltable_vw_fullfeedelementanalysis["UnitName"]=array();
$daltable_vw_fullfeedelementanalysis["UnitName"]["nType"]=200;
	$daltable_vw_fullfeedelementanalysis["UnitName"]["varname"]="UnitName";
$daltable_vw_fullfeedelementanalysis["UnitSymbol"]=array();
$daltable_vw_fullfeedelementanalysis["UnitSymbol"]["nType"]=200;
	$daltable_vw_fullfeedelementanalysis["UnitSymbol"]["varname"]="UnitSymbol";
$daltable_vw_fullfeedelementanalysis["UnitDecimal"]=array();
$daltable_vw_fullfeedelementanalysis["UnitDecimal"]["nType"]=2;
	$daltable_vw_fullfeedelementanalysis["UnitDecimal"]["varname"]="UnitDecimal";
$daltable_vw_fullfeedelementanalysis["iValue"]=array();
$daltable_vw_fullfeedelementanalysis["iValue"]["nType"]=5;
	$daltable_vw_fullfeedelementanalysis["iValue"]["varname"]="iValue";
$dal_info["vw_fullfeedelementanalysis"]=&$daltable_vw_fullfeedelementanalysis;



function CustomQuery($dalSQL)
{
	global $conn;
	$rs = db_query($dalSQL,$conn);
	  return $rs;
}

function UsersTableName()
{
	return "`users`";
}


class tDAL
{
	var $tb_specgroup;
	var $tb_specfeedhabit;
	var $vw_antinutritional;
	var $vw_digestibility;
	var $users;
	var $vw_species;
	var $vw_feedspec;
	var $vw_feedanalysis;
	var $vw_feedingredient;
	var $vw_ingredient;
	var $vw_feed;
	var $vw_fullingredientelementanalysis;
	var $vw_fullingredientproxanalysis;
	var $vw_fullfeedproxanalysis;
	var $vw_fullfeedelementanalysis;
  function Table($strTable)
  {
          if(strtoupper($strTable)==strtoupper("tb_specgroup"))
              return $this->tb_specgroup;
          if(strtoupper($strTable)==strtoupper("tb_specfeedhabit"))
              return $this->tb_specfeedhabit;
          if(strtoupper($strTable)==strtoupper("vw_antinutritional"))
              return $this->vw_antinutritional;
          if(strtoupper($strTable)==strtoupper("vw_digestibility"))
              return $this->vw_digestibility;
          if(strtoupper($strTable)==strtoupper("users"))
              return $this->users;
          if(strtoupper($strTable)==strtoupper("vw_species"))
              return $this->vw_species;
          if(strtoupper($strTable)==strtoupper("vw_feedspec"))
              return $this->vw_feedspec;
          if(strtoupper($strTable)==strtoupper("vw_feedanalysis"))
              return $this->vw_feedanalysis;
          if(strtoupper($strTable)==strtoupper("vw_feedingredient"))
              return $this->vw_feedingredient;
          if(strtoupper($strTable)==strtoupper("vw_ingredient"))
              return $this->vw_ingredient;
          if(strtoupper($strTable)==strtoupper("vw_feed"))
              return $this->vw_feed;
          if(strtoupper($strTable)==strtoupper("vw_fullingredientelementanalysis"))
              return $this->vw_fullingredientelementanalysis;
          if(strtoupper($strTable)==strtoupper("vw_fullingredientproxanalysis"))
              return $this->vw_fullingredientproxanalysis;
          if(strtoupper($strTable)==strtoupper("vw_fullfeedproxanalysis"))
              return $this->vw_fullfeedproxanalysis;
          if(strtoupper($strTable)==strtoupper("vw_fullfeedelementanalysis"))
              return $this->vw_fullfeedelementanalysis;
//	check table names without dbo. and other prefixes
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("tb_specgroup")))
              return $this->tb_specgroup;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("tb_specfeedhabit")))
              return $this->tb_specfeedhabit;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("vw_antinutritional")))
              return $this->vw_antinutritional;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("vw_digestibility")))
              return $this->vw_digestibility;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("users")))
              return $this->users;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("vw_species")))
              return $this->vw_species;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("vw_feedspec")))
              return $this->vw_feedspec;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("vw_feedanalysis")))
              return $this->vw_feedanalysis;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("vw_feedingredient")))
              return $this->vw_feedingredient;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("vw_ingredient")))
              return $this->vw_ingredient;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("vw_feed")))
              return $this->vw_feed;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("vw_fullingredientelementanalysis")))
              return $this->vw_fullingredientelementanalysis;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("vw_fullingredientproxanalysis")))
              return $this->vw_fullingredientproxanalysis;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("vw_fullfeedproxanalysis")))
              return $this->vw_fullfeedproxanalysis;
          if(strtoupper(cutprefix($strTable))==strtoupper(cutprefix("vw_fullfeedelementanalysis")))
              return $this->vw_fullfeedelementanalysis;
  }
}

$dal = new tDAL;

class tDALTable
{
	var $m_TableName;
	var $Param = array();
	var $Value = array();
	
	function TableName()
	{
		return AddTableWrappers($this->m_TableName);
	} 
	
	function Add() 
	{
		global $conn,$dal_info;
		$insertFields="";
		$insertValues="";
		$tableinfo = &$dal_info[$this->m_TableName];
//	prepare parameters		
		foreach($tableinfo as $fieldname=>$fld)
		{
			$command='if(isset($this->'.$fld['varname'].'))
			{
				$this->Value[\''.escapesq($fieldname).'\'] = $this->'.$fld['varname'].';
			}';
			eval($command);
			foreach($this->Value as $field=>$value)
			{
				if (strtoupper($field)!=strtoupper($fieldname))
					continue;
				$insertFields.= AddFieldWrappers($fieldname).",";
				if (NeedQuotes($fld["nType"]))
					$insertValues.= "'".db_addslashes($value) . "',";
				else
					$insertValues.= "".(0+$value) . ",";		
				break;
			}
		}
//	prepare and exec SQL
		if ($insertFields!="" && $insertValues!="")		
		{
			$insertFields = substr($insertFields,0,-1);
			$insertValues = substr($insertValues,0,-1);
			$dalSQL = "insert into ".AddTableWrappers($this->m_TableName)." (".$insertFields.") values (".$insertValues.")";
			db_exec($dalSQL,$conn);
		}
//	cleanup		
	    $this->Reset();
	}

	function QueryAll()
	{
		global $conn;
		$dalSQL = "select * from ".AddFieldWrappers($this->m_TableName);
		$rs = db_query($dalSQL,$conn);
		return $rs;
	}

	function Query($swhere="",$orderby="")
	{
		global $conn;
		if ($swhere)
			$swhere = " where ".$swhere;
		if ($orderby)
			$orderby = " order by ".$orderby;
		$dalSQL = "select * from ".AddTableWrappers($this->m_TableName).$swhere.$orderby;
		$rs = db_query($dalSQL,$conn);
		return $rs;
	}

	function Delete()
	{
		global $conn,$dal_info;
		$deleteFields="";
		$tableinfo = &$dal_info[$this->m_TableName];
//	prepare parameters		
		foreach($tableinfo as $fieldname=>$fld)
		{
			$command='if(isset($this->'.$fld['varname'].'))
			{
				$this->Value[\''.escapesq($fieldname).'\'] = $this->'.$fld['varname'].';
			}
			';
			eval($command);
			foreach($this->Value as $field=>$value)
			{
				if (strtoupper($field)!=strtoupper($fieldname))
					continue;
				if (NeedQuotes($fld["nType"]))
					$deleteFields.= AddFieldWrappers($fieldname)."='".db_addslashes($value) . "' and ";
				else
					$deleteFields.= AddFieldWrappers($fieldname)."=". (0+$value) . " and ";		
				break;
			}
		}
//	do delete
		if ($deleteFields)
		{
			$deleteFields = substr($deleteFields,0,-5);
			$dalSQL = "delete from ".AddFieldWrappers($this->m_TableName)." where ".$deleteFields;
			db_exec($dalSQL,$conn);
		}
	
//	cleanup
	    $this->Reset();
	}

	function Reset()
	{
		$this->Value=array();
		$this->Param=array();
		global $dal_info;
		$tableinfo = &$dal_info[$this->m_TableName];
//	prepare parameters		
		foreach($tableinfo as $fieldname=>$fld)
		{
			$command='unset($this->'.$fld["varname"].");";
			eval($command);
		}
	}	

	function Update()
	{
		global $conn,$dal_info;
		$tableinfo = &$dal_info[$this->m_TableName];
		$updateParam = "";
		$updateValue = "";

		foreach($tableinfo as $fieldname=>$fld)
		{
			$command='if(isset($this->'.$fld['varname'].')) { ';
			if($fld["bKey"])
				$command.='$this->Param[\''.escapesq($fieldname).'\'] = $this->'.$fld['varname'].';';
			else
				$command.='$this->Value[\''.escapesq($fieldname).'\'] = $this->'.$fld['varname'].';';
			$command.=' }';
			eval($command);
			if(!$fld["bKey"])
			{
				foreach($this->Value as $field=>$value)
				{
					if (strtoupper($field)!=strtoupper($fieldname))
						continue;
					if (NeedQuotes($fld["nType"]))
						$updateValue.= AddFieldWrappers($fieldname)."='".db_addslashes($value) . "', ";
					else
						$updateValue.= AddFieldWrappers($fieldname)."=".(0+$value) . ", ";
					break;
				}
			}
			else
			{
				foreach($this->Param as $field=>$value)
				{
					if (strtoupper($field)!=strtoupper($fieldname))
						continue;
					if (NeedQuotes($fld["nType"]))
						$updateParam.= AddFieldWrappers($fieldname)."='".db_addslashes($value) . "' and ";
					else
						$updateParam.= AddFieldWrappers($fieldname)."=".(0+$value) . " and ";
					break;
				}
			}
		}

//	construct SQL and do update	
		if ($updateParam)
			$updateParam = substr($updateParam,0,-5);
		if ($updateValue)
			$updateValue = substr($updateValue,0,-2);
		if ($updateValue && $updateParam)
		{
			$dalSQL = "update ".AddTableWrappers($this->m_TableName)." set ".$updateValue." where ".$updateParam;
			db_exec($dalSQL,$conn);
		}

//	cleanup
		$this->Reset();
	}

	function FetchByID()
	{
		global $conn,$dal_info;
		$tableinfo = &$dal_info[$this->m_TableName];

		$dal_where="";
		foreach($tableinfo as $fieldname=>$fld)
		{
			$command='if(isset($this->'.$fld['varname'].')) { ';
			$command.='$this->Value[\''.escapesq($fieldname).'\'] = $this->'.$fld['varname'].';';
			$command.=' }';
			eval($command);
			foreach($this->Value as $field=>$value)
			{
				if (strtoupper($field)!=strtoupper($fieldname))
					continue;
				if (NeedQuotes($fld["nType"]))
					$dal_where.= AddFieldWrappers($fieldname)."='".db_addslashes($value) . "' and ";
				else
					$dal_where.= AddFieldWrappers($fieldname)."=".(0+$value) . " and ";
				break;
			}
		}
//	cleanup
		$this->Reset();
//	construct and run SQL
		if ($dal_where)
			$dal_where = " where ".substr($dal_where,0,-5);
		$dalSQL = "select * from ".AddTableWrappers($this->m_TableName).$dal_where;
		$rs = db_query($dalSQL,$conn);
		return $rs;
	}
}

class class_tb_specgroup extends tDALTable
{
	var $GroupID;
	var $Description;

	function class_tb_specgroup()
	{
		$this->m_TableName = "tb_specgroup";
	}
}
$dal->tb_specgroup = new class_tb_specgroup();
class class_tb_specfeedhabit extends tDALTable
{
	var $FeedHabitID;
	var $Description;

	function class_tb_specfeedhabit()
	{
		$this->m_TableName = "tb_specfeedhabit";
	}
}
$dal->tb_specfeedhabit = new class_tb_specfeedhabit();
class class_vw_antinutritional extends tDALTable
{
	var $IngredientID;
	var $IName;
	var $Description;
	var $AntiID;
	var $AntiFactor;
	var $ToxicLevel;
	var $TreatmentID;
	var $Treatment;
	var $IDSourceID;
	var $DataSource;
	var $PartUsedID;
	var $PartUsed;

	function class_vw_antinutritional()
	{
		$this->m_TableName = "vw_antinutritional";
	}
}
$dal->vw_antinutritional = new class_vw_antinutritional();
class class_vw_digestibility extends tDALTable
{
	var $IngredientID;
	var $IName;
	var $Description;
	var $SpeciesID;
	var $SpecName;
	var $CommonName;
	var $DigestTypeID;
	var $DigestibilityType;
	var $DValue;
	var $Country;
	var $DataSource;

	function class_vw_digestibility()
	{
		$this->m_TableName = "vw_digestibility";
	}
}
$dal->vw_digestibility = new class_vw_digestibility();
class class_users extends tDALTable
{
	var $ID;
	var $user;
	var $pass;

	function class_users()
	{
		$this->m_TableName = "users";
	}
}
$dal->users = new class_users();
class class_vw_species extends tDALTable
{
	var $SpeciesID;
	var $SpecName;
	var $CommonName;
	var $Hybrid;
	var $Variety;
	var $Family;
	var $Group;
	var $Genus;
	var $Environment;
	var $FeedHabit;
	var $Country;
	var $SpecYear;

	function class_vw_species()
	{
		$this->m_TableName = "vw_species";
	}
}
$dal->vw_species = new class_vw_species();
class class_vw_feedspec extends tDALTable
{
	var $FeedID;
	var $FName;
	var $BrandName;
	var $Technology;
	var $FeedYear;
	var $Stage;
	var $FCountryID;
	var $CountryOrigin;
	var $FIDSourceID;
	var $FisDetail;
	var $FDataSource;
	var $FeedTypeID;
	var $FeedType;
	var $SpeciesID;
	var $SpecName;
	var $CommonName;
	var $Hybrid;
	var $Variety;
	var $Family;
	var $Group;
	var $Genus;
	var $Environment;
	var $FeedHabit;
	var $Country;
	var $SpecYear;

	function class_vw_feedspec()
	{
		$this->m_TableName = "vw_feedspec";
	}
}
$dal->vw_feedspec = new class_vw_feedspec();
class class_vw_feedanalysis extends tDALTable
{
	var $FeedID;
	var $FName;
	var $BrandName;
	var $Technology;
	var $FeedYear;
	var $Stage;
	var $FCountryID;
	var $CountryOrigin;
	var $FIDSourceID;
	var $FisDetail;
	var $FDataSource;
	var $FeedTypeID;
	var $FeedType;
	var $FeedAnalysisTypeID;
	var $FeedAnalysisType;
	var $FATTagName;
	var $UnitID;
	var $UnitName;
	var $UnitSymbol;
	var $UnitDecimal;
	var $FAValue;
	var $isShownDetail;

	function class_vw_feedanalysis()
	{
		$this->m_TableName = "vw_feedanalysis";
	}
}
$dal->vw_feedanalysis = new class_vw_feedanalysis();
class class_vw_feedingredient extends tDALTable
{
	var $FeedID;
	var $FName;
	var $FisDetail;
	var $IngredientID;
	var $IName;
	var $IisDetail;
	var $FValue;

	function class_vw_feedingredient()
	{
		$this->m_TableName = "vw_feedingredient";
	}
}
$dal->vw_feedingredient = new class_vw_feedingredient();
class class_vw_ingredient extends tDALTable
{
	var $IngredientID;
	var $IName;
	var $IfeedNo;
	var $Description1;
	var $Description2;
	var $Description3;
	var $IisDetail;
	var $IDSourceID;
	var $DataSource;
	var $CountryID;
	var $ICountry;
	var $IngredientSpecID;
	var $Species;

	function class_vw_ingredient()
	{
		$this->m_TableName = "vw_ingredient";
	}
}
$dal->vw_ingredient = new class_vw_ingredient();
class class_vw_feed extends tDALTable
{
	var $FeedID;
	var $FName;
	var $BrandName;
	var $Technology;
	var $FeedYear;
	var $Stage;
	var $FCountryID;
	var $CountryOrigin;
	var $FIDSourceID;
	var $FisDetail;
	var $FDataSource;
	var $FeedTypeID;
	var $FeedType;

	function class_vw_feed()
	{
		$this->m_TableName = "vw_feed";
	}
}
$dal->vw_feed = new class_vw_feed();
class class_vw_fullingredientelementanalysis extends tDALTable
{
	var $IngredientID;
	var $ElementID;
	var $EName;
	var $CommonName;
	var $TagName;
	var $ElementTypeID;
	var $Description;
	var $UnitID;
	var $UnitName;
	var $UnitSymbol;
	var $UnitDecimal;
	var $IValue;

	function class_vw_fullingredientelementanalysis()
	{
		$this->m_TableName = "vw_fullingredientelementanalysis";
	}
}
$dal->vw_fullingredientelementanalysis = new class_vw_fullingredientelementanalysis();
class class_vw_fullingredientproxanalysis extends tDALTable
{
	var $IngredientID;
	var $ElementTypeID;
	var $Description;
	var $UnitName;
	var $UnitSymbol;
	var $UnitDecimal;
	var $ETValue;

	function class_vw_fullingredientproxanalysis()
	{
		$this->m_TableName = "vw_fullingredientproxanalysis";
	}
}
$dal->vw_fullingredientproxanalysis = new class_vw_fullingredientproxanalysis();
class class_vw_fullfeedproxanalysis extends tDALTable
{
	var $FeedID;
	var $ElementTypeID;
	var $Description;
	var $isShownDetail;
	var $ETTagName;
	var $UnitID;
	var $UnitName;
	var $UnitSymbol;
	var $UnitDecimal;
	var $ETValue;

	function class_vw_fullfeedproxanalysis()
	{
		$this->m_TableName = "vw_fullfeedproxanalysis";
	}
}
$dal->vw_fullfeedproxanalysis = new class_vw_fullfeedproxanalysis();
class class_vw_fullfeedelementanalysis extends tDALTable
{
	var $FeedID;
	var $ElementID;
	var $EName;
	var $CommonName;
	var $TagName;
	var $UnitID;
	var $UnitName;
	var $UnitSymbol;
	var $UnitDecimal;
	var $iValue;

	function class_vw_fullfeedelementanalysis()
	{
		$this->m_TableName = "vw_fullfeedelementanalysis";
	}
}
$dal->vw_fullfeedelementanalysis = new class_vw_fullfeedelementanalysis();

class DalRecordset
{
	
	var $m_rs;
	var $m_fields;
	var $m_eof;
	
	function Fields($field="")
	{
		if(!$field)
			return $this->m_fields;
		return $this->Field($field);
	}
	
	function Field($field)
	{
		if($this->m_eof)
			return false;
		foreach($this->m_fields as $name=>$value)
		{
			if(!strcasecmp($name,$field))
				return $value;
		}
		return false;
	}
	function DalRecordset($rs)
	{
		$this->m_rs=$rs;
		$this->MoveNext();
	}
	function EOF()
	{
		return $this->m_eof;
	}
	
	function MoveNext()
	{
		if(!$this->m_eof)
			$this->m_fields=db_fetch_array($this->m_rs);
		$this->m_eof = !$this->m_fields;
		return !$this->m_eof;
	}
}

function cutprefix($table)
{
	$pos=strpos($table,".");
	if($pos===false)
		return $table;
	return substr($table,$pos+1);
}

function escapesq($str)
{
	return str_replace(array("\\","'"),array("\\\\","\\'"),$str);
}

?>