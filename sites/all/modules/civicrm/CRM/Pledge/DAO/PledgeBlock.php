<?php
/*
+--------------------------------------------------------------------+
| CiviCRM version 4.3                                                |
+--------------------------------------------------------------------+
| Copyright CiviCRM LLC (c) 2004-2013                                |
+--------------------------------------------------------------------+
| This file is a part of CiviCRM.                                    |
|                                                                    |
| CiviCRM is free software; you can copy, modify, and distribute it  |
| under the terms of the GNU Affero General Public License           |
| Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
|                                                                    |
| CiviCRM is distributed in the hope that it will be useful, but     |
| WITHOUT ANY WARRANTY; without even the implied warranty of         |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
| See the GNU Affero General Public License for more details.        |
|                                                                    |
| You should have received a copy of the GNU Affero General Public   |
| License and the CiviCRM Licensing Exception along                  |
| with this program; if not, contact CiviCRM LLC                     |
| at info[AT]civicrm[DOT]org. If you have questions about the        |
| GNU Affero General Public License or the licensing of CiviCRM,     |
| see the CiviCRM license FAQ at http://civicrm.org/licensing        |
+--------------------------------------------------------------------+
*/
/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2013
 * $Id$
 *
 */
require_once 'CRM/Core/DAO.php';
require_once 'CRM/Utils/Type.php';
class CRM_Pledge_DAO_PledgeBlock extends CRM_Core_DAO
{
  /**
   * static instance to hold the table name
   *
   * @var string
   * @static
   */
  static $_tableName = 'civicrm_pledge_block';
  /**
   * static instance to hold the field values
   *
   * @var array
   * @static
   */
  static $_fields = null;
  /**
   * static instance to hold the FK relationships
   *
   * @var string
   * @static
   */
  static $_links = null;
  /**
   * static instance to hold the values that can
   * be imported
   *
   * @var array
   * @static
   */
  static $_import = null;
  /**
   * static instance to hold the values that can
   * be exported
   *
   * @var array
   * @static
   */
  static $_export = null;
  /**
   * static value to see if we should log any modifications to
   * this table in the civicrm_log table
   *
   * @var boolean
   * @static
   */
  static $_log = true;
  /**
   * Pledge ID
   *
   * @var int unsigned
   */
  public $id;
  /**
   * physical tablename for entity being joined to pledge, e.g. civicrm_contact
   *
   * @var string
   */
  public $entity_table;
  /**
   * FK to entity table specified in entity_table column.
   *
   * @var int unsigned
   */
  public $entity_id;
  /**
   * Delimited list of supported frequency units
   *
   * @var string
   */
  public $pledge_frequency_unit;
  /**
   * Is frequency interval exposed on the contribution form.
   *
   * @var boolean
   */
  public $is_pledge_interval;
  /**
   * The maximum number of payment reminders to send for any given payment.
   *
   * @var int unsigned
   */
  public $max_reminders;
  /**
   * Send initial reminder this many days prior to the payment due date.
   *
   * @var int unsigned
   */
  public $initial_reminder_day;
  /**
   * Send additional reminder this many days after last one sent, up to maximum number of reminders.
   *
   * @var int unsigned
   */
  public $additional_reminder_day;
  /**
   * class constructor
   *
   * @access public
   * @return civicrm_pledge_block
   */
  function __construct()
  {
    $this->__table = 'civicrm_pledge_block';
    parent::__construct();
  }
  /**
   * returns all the column names of this table
   *
   * @access public
   * @return array
   */
  static function &fields()
  {
    if (!(self::$_fields)) {
      self::$_fields = array(
        'id' => array(
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'required' => true,
        ) ,
        'entity_table' => array(
          'name' => 'entity_table',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Entity Table') ,
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
        ) ,
        'entity_id' => array(
          'name' => 'entity_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Entity Id') ,
          'required' => true,
        ) ,
        'pledge_frequency_unit' => array(
          'name' => 'pledge_frequency_unit',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Pledge Frequency Unit') ,
          'maxlength' => 128,
          'size' => CRM_Utils_Type::HUGE,
        ) ,
        'is_pledge_interval' => array(
          'name' => 'is_pledge_interval',
          'type' => CRM_Utils_Type::T_BOOLEAN,
        ) ,
        'max_reminders' => array(
          'name' => 'max_reminders',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Maximum Number of Reminders') ,
          'default' => '',
        ) ,
        'initial_reminder_day' => array(
          'name' => 'initial_reminder_day',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Initial Reminder Day') ,
          'default' => '',
        ) ,
        'additional_reminder_day' => array(
          'name' => 'additional_reminder_day',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Additional Reminder Days') ,
          'default' => '',
        ) ,
      );
    }
    return self::$_fields;
  }
  /**
   * returns the names of this table
   *
   * @access public
   * @static
   * @return string
   */
  static function getTableName()
  {
    return self::$_tableName;
  }
  /**
   * returns if this table needs to be logged
   *
   * @access public
   * @return boolean
   */
  function getLog()
  {
    return self::$_log;
  }
  /**
   * returns the list of fields that can be imported
   *
   * @access public
   * return array
   * @static
   */
  static function &import($prefix = false)
  {
    if (!(self::$_import)) {
      self::$_import = array();
      $fields = self::fields();
      foreach($fields as $name => $field) {
        if (CRM_Utils_Array::value('import', $field)) {
          if ($prefix) {
            self::$_import['pledge_block'] = & $fields[$name];
          } else {
            self::$_import[$name] = & $fields[$name];
          }
        }
      }
    }
    return self::$_import;
  }
  /**
   * returns the list of fields that can be exported
   *
   * @access public
   * return array
   * @static
   */
  static function &export($prefix = false)
  {
    if (!(self::$_export)) {
      self::$_export = array();
      $fields = self::fields();
      foreach($fields as $name => $field) {
        if (CRM_Utils_Array::value('export', $field)) {
          if ($prefix) {
            self::$_export['pledge_block'] = & $fields[$name];
          } else {
            self::$_export[$name] = & $fields[$name];
          }
        }
      }
    }
    return self::$_export;
  }
}
