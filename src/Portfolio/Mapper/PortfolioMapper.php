<?php
// Filename: /module/Portfolio/src/Portfolio/Mapper/PortfolioMapper.php

// Mappers
// Objects that handle all the complexity of mapping the persistance layer namings and
// hierachy of information into the domain model/object graph.
// The mapper, in conjunction with the hydrator, is able to move values in both directions,
// from a column or a row in a database to a property in an object and vice-versa.

namespace Portfolio\Mapper;
use Portfolio\Model\Portfolio;
use Zend\Stdlib\Hydrator\HydratorInterface;

class PortfolioMapper extends Portfolio implements HydratorInterface {

    public function mapToEntity(array $data, Portfolio $object) {
        $object->id = (!empty($data['id'])) ? $data['id'] : null;
        $object->title = (!empty($data['title'])) ? $data['title'] : '';
        $object->short_title = (!empty($data['short_title'])) ? $data['short_title'] : '';
        $object->thumb = (!empty($data['thumb'])) ? $data['thumb'] : '';
        $object->lightbox = (!empty($data['lightbox'])) ? $data['lightbox'] : '';
        $object->client = (!empty($data['client'])) ? $data['client'] : '';
        $object->tools = (!empty($data['tools'])) ? $data['tools'] : '';
        $object->url = (!empty($data['url'])) ? $data['url'] : '';
        $object->url_text = (!empty($data['url_text'])) ? $data['url_text'] : '';
        $object->banner = (!empty($data['banner'])) ? $data['banner'] : '';
        $object->html = (!empty($data['html'])) ? $data['html'] : '';
        $object->sort = (!empty($data['sort'])) ? $data['sort'] : 0;
        $object->hide = (!empty($data['hide'])) ? $data['hide'] : 0;

        return $object;
    }

    public function mapToArray(Portfolio $object) {
        $data = array();
        $data['id'] = (!empty($object->id)) ? $object->id : null;
        $data['title'] = (!empty($object->title)) ? $object->title : '';
        $data['short_title'] = (!empty($object->short_title)) ? $object->short_title : '';
        $data['thumb'] = (!empty($object->thumb)) ? $object->thumb : '';
        $data['lightbox'] = (!empty($object->lightbox)) ? $object->lightbox : '';
        $data['client'] = (!empty($object->client)) ? $object->client : '';
        $data['tools'] = (!empty($object->tools)) ? $object->tools : '';
        $data['url'] = (!empty($object->url)) ? $object->url : '';
        $data['url_text'] = (!empty($object->url_text)) ? $object->url_text : '';
        $data['banner'] = (!empty($object->banner)) ? $object->banner : '';
        $data['html'] = (!empty($object->html)) ? $object->html : '';
        $data['sort'] = (!empty($object->sort)) ? $object->sort : 0;
        $data['hide'] = (!empty($object->hide)) ? $object->hide : 0;

        return $data;
    }

    /**
     * Extract values from an object
     *
     * @param object $object
     * @return array
     */
    public function extract($object) {
        return $this->mapToArray($object);
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param array $data
     * @param object $object
     * @return object
     */
    public function hydrate(array $data, $object) {
        $this->mapToEntity($data, $object);
        return $object;
    }
}