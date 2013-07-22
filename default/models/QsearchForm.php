<?php
class QsearchForm extends Zend_Form
{
    public function __construct($options=null)
    {
        parent::__construct($options);
        $this->setName('Qsearch');
        
        $set=new Zend_Form_Element_Select('set');
        $section=new Zend_Form_Element_Select('section');
        
        $page=new Zend_Form_Element_Hidden('page');
        $submit=new Zend_Form_Element_Submit('submit');
        $this->addElements(array($set,$section,$page,$submit));
    }
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
