<?php
namespace de\mulchprod\kajona\modulegenerator\model;

use de\mulchprod\kajona\modulegenerator\controller\ConfigManager;

class PropertyConfig {

    private $strName = "";
    private $bitIndexable = false;
    private $bitMandatory = false;
    private $bitTemplateExport = false;


    public function getAsPropertyDefinition() {
        $strReturn  = "\n";
        $strReturn .= "    /**\n";
        $strReturn .= "     * @var string\n";
        $strReturn .= "     * @targetTable ".ConfigManager::getCurrentConfig()->getXXMODULENAME().".".ConfigManager::getCurrentConfig()->getXXRECORDNAME()."_".$this->getStrName()."\n";
        $strReturn .= "     * @fieldType text\n";

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
            return "<div>%%".$this->getPropertyVariableName()."%%</div>";
        }

        return "";
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
        return "str".ucfirst($this->getStrName());
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



}