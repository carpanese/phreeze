<?php
/** @package    AuthExample::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");

/**
 * UserMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the UserDAO to the user datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package AuthExample::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class UserMap implements IDaoMap
{
	/**
	 * Returns a singleton array of FieldMaps for the User object
	 *
	 * @access public
	 * @return array of FieldMaps
	 */
	public static function GetFieldMaps()
	{
		static $fm = null;
		if ($fm == null)
		{
			$fm = Array();
			$fm["Id"] = new FieldMap("Id","user","a_id",true,FM_TYPE_INT,10,null,true, false);
			$fm["RoleId"] = new FieldMap("RoleId","user","a_role_id",false,FM_TYPE_INT,10,null,false, false);
			$fm["Username"] = new FieldMap("Username","user","a_username",false,FM_TYPE_VARCHAR,150,null,false, false);
			$fm["Password"] = new FieldMap("Password","user","a_password",false,FM_TYPE_VARCHAR,150,null,false, false);
			$fm["FirstName"] = new FieldMap("FirstName","user","a_first_name",false,FM_TYPE_VARCHAR,45,null,false, false);
			$fm["LastName"] = new FieldMap("LastName","user","a_last_name",false,FM_TYPE_VARCHAR,45,null,false, false);
		}
		return $fm;
	}

	/**
	 * Returns a singleton array of KeyMaps for the User object
	 *
	 * @access public
	 * @return array of KeyMaps
	 */
	public static function GetKeyMaps()
	{
		static $km = null;
		if ($km == null)
		{
			$km = Array();
			$km["u_role"] = new KeyMap("u_role", "RoleId", "Role", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return $km;
	}

}

?>