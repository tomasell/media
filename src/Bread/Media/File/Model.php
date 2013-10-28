<?php
namespace Bread\Media\File;

use Bread\Configuration\Manager as Configuration;
use Bread\DAV\Properties;
use Bread\DAV;
use Bread\REST\Routing\URI\Template;


class Model extends DAV\Model
{

    protected $id;

    protected $name;

    protected $data;

    protected $size;

    protected $type;

    public function href($variable = array())
    {
        return $variable[0] . $this->name;
    }

    public function getLiveProperties()
    {
        return array(
            'getcontentlanguage' => 'it-IT',
            'getcontentlength' => isset($this->size) ? $this->size : 0,
            'getcontenttype' => isset($this->type) ? $this->type : null,
            'getetag' => isset($this->name) ? md5($this->name) : uniqid(),
            'resourcetype' => null,
            'supportedlock' => 'default'
        );
    }
}

Configuration::defaults('Bread\Media\File\Model', array(
    'keys' => array(
        'id'
    ),
    'properties' => array(
        'id' => array(
            'type' => 'integer',
            'strategy' => 'autoincrement'
        ),
        'data' => array(
            'type' => 'this'
        ),
        'name' => array(
            'type' => 'string'
        ),
        'size' => array(
            'type' => 'string'
        ),
        'type' => array(
            'type' => 'string'
        )
    ),
    'storage' => array(
        'options' => array(
            'table' => 'files'
        )
    ),
    'uri_template' => '/files{/name}{.accept}'
));