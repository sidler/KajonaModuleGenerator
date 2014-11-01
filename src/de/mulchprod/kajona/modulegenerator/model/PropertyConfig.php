<?php
namespace de\mulchprod\kajona\modulegenerator\model;

class PropertyConfig {

    private $strName = "";
    private $bitIndexable = false;
    private $bitMandatory = false;
    private $bitTemplateExport = false;

    /**
     * @return boolean
     */
    public function isBitIndexable() {
        return $this->bitIndexable;
    }

    /**
     * @param boolean $bitIndexable
     */
    public function setBitIndexable($bitIndexable) {
        $this->bitIndexable = $bitIndexable;
    }

    /**
     * @return boolean
     */
    public function isBitMandatory() {
        return $this->bitMandatory;
    }

    /**
     * @param boolean $bitMandatory
     */
    public function setBitMandatory($bitMandatory) {
        $this->bitMandatory = $bitMandatory;
    }

    /**
     * @return boolean
     */
    public function isBitTemplateExport() {
        return $this->bitTemplateExport;
    }

    /**
     * @param boolean $bitTemplateExport
     */
    public function setBitTemplateExport($bitTemplateExport) {
        $this->bitTemplateExport = $bitTemplateExport;
    }

    /**
     * @return string
     */
    public function getStrName() {
        return $this->strName;
    }

    /**
     * @param string $strName
     */
    public function setStrName($strName) {
        $this->strName = $strName;
    }



}