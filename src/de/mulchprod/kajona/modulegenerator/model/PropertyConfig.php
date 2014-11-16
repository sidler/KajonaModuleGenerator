<?php
namespace de\mulchprod\kajona\modulegenerator\model;

use de\mulchprod\kajona\modulegenerator\controller\ConfigManager;

class PropertyConfig {

    private $strName = "";
    private $bitIndexable = false;
    private $bitMandatory = false;
    private $bitTemplateExport = false;
    private $strDatatype = "text";
    private $strFieldType = "text";


    public function getAsPropertyDefinition() {

        $strColName = ConfigManager::getCurrentConfig()->getXXMODULENAME()."_".ConfigManager::getCurrentConfig()->getXXRECORDNAME().".".ConfigManager::getCurrentConfig()->getXXRECORDNAME()."_".$this->getStrName();

        $strReturn  = "\n";
        $strReturn .= "    /**\n";
        $strReturn .= "     * @var string\n";
        $strReturn .= "     * @tableColumn ".strtolower($strColName)."\n";
        $strReturn .= "     * @tableColumnDatatype ".$this->strDatatype."\n";
        $strReturn .= "     * @fieldType ".$this->strFieldType."\n";

        if($this->isBitMandatory())
            $strReturn .= "     * @fieldMandatory\n";

        if($this->isBitIndexable())
            $strReturn .= "     * @addSearchIndex\n";

        if($this->isBitTemplateExport())
            $strReturn .= "     * @templateExport\n";



        $strReturn .= "     */\n";
        $strReturn .= "     private \$".$this->getPropertyVariableName(). " = \"\";\n";
        $strReturn .= "\n";

        return $strReturn;
    }

    public function getAsTemplateSnippet() {
        if($this->isBitTemplateExport()) {
            return "<div data-kajona-editable=\"%%strSystemid%%#".$this->getPropertyVariableName()."#plain\">%%".$this->getPropertyVariableName()."%%</div>\n";
        }

        return "";
    }

    public function getAsLanguageProperty() {
        return "\$lang[\"form_".ConfigManager::getCurrentConfig()->getXXMODULENAME()."_".$this->getStrName()."\"] = \"".$this->getStrName()."\";\n";
    }

    public function getAsAccessors() {
        $strReturn  = "\n";
        $strReturn .= "    public function get".ucfirst($this->getPropertyVariableName())."() {\n";
        $strReturn .= "        return \$this->".$this->getPropertyVariableName().";\n";
        $strReturn .= "    }\n";
        $strReturn .= "\n";
        $strReturn .= "    public function set".ucfirst($this->getPropertyVariableName())."(\$".$this->getPropertyVariableName().") {\n";
        $strReturn .= "        \$this->".$this->getPropertyVariableName()." = \$".$this->getPropertyVariableName().";\n";
        $strReturn .= "    }\n";
        $strReturn .= "\n";

        return $strReturn;
    }

    public function getPropertyVariableName() {
        //build the prefix
        $strPrefix = "str";

        if($this->getStrDatatype() == "int")
            $strPrefix = "int";

        if($this->getStrDatatype() == "long")
            $strPrefix = "long";

        if($this->getStrDatatype() == "double")
            $strPrefix = "float";

        return $strPrefix.ucfirst($this->getStrName());
    }

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

    /**
     * @return string
     */
    public function getStrDatatype() {
        return $this->strDatatype;
    }

    /**
     * @param string $strDatatype
     */
    public function setStrDatatype($strDatatype) {
        $this->strDatatype = $strDatatype;
    }

    /**
     * @return string
     */
    public function getStrFieldType() {
        return $this->strFieldType;
    }

    /**
     * @param string $strFieldType
     */
    public function setStrFieldType($strFieldType) {
        $this->strFieldType = $strFieldType;
    }





}