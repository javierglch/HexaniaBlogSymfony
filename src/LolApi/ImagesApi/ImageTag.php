<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LolApi\ImagesApi;

/**
 * ImageTag
 * Es la clase para construir el tag de la imagen
 * @author Javier
 */
class ImageTag {

    /** @var string */
    public $src;

    /** @var string */
    public $alt;

    /** @var string */
    public $title;

    /** @var array */
    public $aAttributes;

    /**
     * @param string $src
     * @param string $title
     * @param string $alt
     * @param array $aAttributes
     */
    public function __construct($src, $title, $alt, $aAttributes) {
        $this->src = $src;
        $this->title = $title;
        $this->alt = $alt;
        $this->aAttributes = $aAttributes;
    }

    /**
     * Construye el string en codigo html de la imagen
     * @param bool $withlink
     * @return string
     */
    public function toString($withlink = false) {
        $aAttrs = [];
        foreach ($this->aAttributes as $key => $value) {
            $aAttrs[] = $key . '="' . $value . '"';
        }

        $imgtag = '<img src="' . $this->src . '" alt="' . $this->alt . '" title="' . $this->title . '" ' . implode(' ', $aAttrs) . '>';
        return $withlink ? '<a href="' . $this->src . '">' . $imgtag . '</a>' : $imgtag;
    }

    public function __toString() {
        return $this->toString(false);
    }

}
