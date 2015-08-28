<?php
/** @package    AuthExample::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");

/**
 * RoleMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the RoleDAO to the role datastore.
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
class RoleMap implements IDaoMap
{
	/**
	 * Returns a singleton array of FieldMaps for the Role object
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
			$fm["Id"] = new FieldMap("Id","role","r_id",true,FM_TYPE_INT,10,null,true, false);
			$fm["Name"] = new FieldMap("Name","role","r_name",false,FM_TYPE_VARCHAR,45,null,false, false);
			$fm["CanAdmin"] = new FieldMap("CanAdmin","role","r_can_admin",false,FM_TYPE_TINYINT,4,null,false, false);
			$fm["CanEdit"] = new FieldMap("CanEdit","role","r_can_edit",false,FM_TYPE_TINYINT,4,null,false, false);
			$fm["CanWrite"] = new FieldMap("CanWrite","role","r_can_write",false,FM_TYPE_TINYINT,4,null,false, false);
			$fm["CanRead"] = new FieldMap("CanRead","role","r_can_read",false,FM_TYPE_TINYINT,4,null,false, false);
		}
		return $fm;
	}

	/**
	 * Returns a singleton array of KeyMaps for the Role object
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
			$km["u_role"] = new KeyMap("u_role", "Id", "User", "RoleId", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return $km;
	}

}

?>