<?php
namespace Portfolio\Form;

use Zend\Form\Form;
// use Zend\InputFilter\InputFilter;
// use Zend\Stdlib\Hydrator\ClassMethods;
// use Zend\Stdlib\Hydrator\ObjectProperty;

class PortfolioForm extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'portfoliofieldset',
             'type' => 'Portfolio\Form\PortfolioFieldset',
             'options' => array(
                 'use_as_base_fieldset' => true,
             ),
         ));
        $this->add(array(
            'name' => 'thumb_file',
            'type' => 'file',
            'options' => array(
                'label' => 'Thumb Image',
                // 'destination' => '/home/frogprincess/Websites/lilypad_zf2/public_lilypad/lilypad.net/images'
            ),
        ));
        $this->add(array(
            'name' => 'lightbox_file',
            'type' => 'file',
            'options' => array(
                'label' => 'Lightbox Image',
                // 'destination' => '/home/frogprincess/Websites/lilypad_zf2/public_lilypad/lilypad.net/images'
            ),
        ));
        $this->add(array(
            'name' => 'banner_file',
            'type' => 'file',
            'options' => array(
                'label' => 'Banner Image',
                // 'destination' => '/home/frogprincess/Websites/lilypad_zf2/public_lilypad/lilypad.net/images'
            ),
        ));
        /*
        // Prevents form being submitted from automated scripts.
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf'
        ));*/
        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Save',
                'class' =>  'btn btn-default'
            )
        ));
    }
}
