<?php
namespace Portfolio\Form;

use Portfolio\Model\Portfolio;
use Portfolio\Mapper\PortfolioMapper;
use Zend\Form\Fieldset;

class PortfolioFieldset extends Fieldset {

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $this->setHydrator(new PortfolioMapper()); // ArraySerializable is the default
        $this->setObject(new Portfolio());

        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'thumb',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'lightbox',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'banner',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'title',
            'type' => 'text',
            'options' => array(
                'label' => 'Title'
            ),
            'attributes' => array(
                'required' => 'required',
                'size' => 63
            )
        ));
        $this->add(array(
            'name' => 'short_title',
            'type' => 'text',
            'options' => array(
                'label' => 'Short Title'
            ),
            'attributes' => array(
                'required' => 'required',
                'size' => 63
            )
        ));
        $this->add(array(
            'name' => 'client',
            'type' => 'text',
            'options' => array(
                'label' => 'Client'
            ),
            'attributes' => array(
                'size' => 63
            )
        ));
        $this->add(array(
            'name' => 'tools',
            'type' => 'text',
            'options' => array(
                'label' => 'Tools'
            ),
            'attributes' => array(
                'size' => 63
            )
        ));
        $this->add(array(
            'name' => 'url',
            'type' => 'text',
            'options' => array(
                'label' => 'Url'
            ),
            'attributes' => array(
                'size' => 63
            )
        ));
        $this->add(array(
            'name' => 'url_text',
            'type' => 'text',
            'options' => array(
                'label' => 'Url Title'
            ),
            'attributes' => array(
                'size' => 63
            )
        ));
        $this->add(array(
            'name' => 'html',
            'type' => 'textarea',
            'options' => array(
                'label' => 'HTML'
            )
        ));
        $this->add(array(
            'name' => 'sort',
            'type' => 'text',
            'options' => array(
                'label' => 'Sort'
            )
        ));
        $this->add(array(
            'name' => 'hide',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Hide'
            )
        ));
    }

    // /**
    // * @return array
    // */
    // public function getInputFilterSpecification() {
    //     return array('title' => array(
    //              'required' => false,
    //          ),);
    // }
}