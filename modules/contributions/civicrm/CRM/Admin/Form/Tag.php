<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 1.4                                                |
 +--------------------------------------------------------------------+
 | Copyright (c) 2005 Donald A. Lobo                                  |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the Affero General Public License Version 1,    |
 | March 2002.                                                        |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the Affero General Public License for more details.            |
 |                                                                    |
 | You should have received a copy of the Affero General Public       |
 | License along with this program; if not, contact the Social Source |
 | Foundation at info[AT]socialsourcefoundation[DOT]org.  If you have |
 | questions about the Affero General Public License or the licensing |
 | of CiviCRM, see the Social Source Foundation CiviCRM license FAQ   |
 | at http://www.openngo.org/faqs/licensing.html                       |
 +--------------------------------------------------------------------+
*/

/**
 *
 *
 * @package CRM
 * @author Donald A. Lobo <lobo@yahoo.com>
 * @copyright Donald A. Lobo (c) 2005
 * $Id$
 *
 */


require_once 'CRM/Admin/Form.php';

/**
 * This class generates form components for Tag
 * 
 */
class CRM_Admin_Form_Tag extends CRM_Admin_Form
{
    /**
     * Function to build the form
     *
     * @return None
     * @access public
     */
     function buildQuickForm( ) {

        if ($this->_action == CRM_CORE_ACTION_DELETE) {
            $this->addButtons( array(
                                     array ( 'type'      => 'next',
                                             'name'      => ts('Delete'),
                                             'isDefault' => true   ),
                                     array ( 'type'      => 'cancel',
                                             'name'      => ts('Cancel') ),
                                     )
                               );
        } else {
            $this->applyFilter('__ALL__', 'trim');
            
            $this->add('text', 'name'       , ts('Name')       ,
                       CRM_Core_DAO::getAttribute( 'CRM_Core_DAO_Tag', 'name' ) );
            $this->addRule( 'name', ts('Please enter a valid name.'), 'required' );

            $this->addRule( 'name', ts('Name already exists in Database.'), 'objectExists', array( 'CRM_Core_DAO_Tag', $this->_id ) );

            $this->add('text', 'description', ts('Description'), 
                       CRM_Core_DAO::getAttribute( 'CRM_Core_DAO_Tag', 'description' ) );
            
            parent::buildQuickForm( ); 
        }
    }

       
    /**
     * Function to process the form
     *
     * @access public
     * @return None
     */
     function postProcess() 
    {
        $params = $ids = array();

        // store the submitted values in an array
        $params = $this->exportValues();
        $ids['tag'] = $this->_id;
        
        if ($this->_action == CRM_CORE_ACTION_DELETE) {
            if ($this->_id  > 0 ) {
                CRM_Core_BAO_Tag::del( $this->_id );
            }
        } else {
            CRM_Core_BAO_Tag::add($params, $ids);
        }        
        
    }//end of function


}

?>
