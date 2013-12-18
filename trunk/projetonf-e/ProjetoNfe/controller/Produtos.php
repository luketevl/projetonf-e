<?php
class Produtos {

    private $cod;
    private $desc;
    private $ncm;
    private $und;
    private $vr_unitario;

    public function getCod() {
        return $this -> cod;
    }

    public function getDesc() {
        return $this -> desc;
    }

    public function getNcm() {
        return $this -> ncm;
    }

    public function getUnd() {
        return $this -> und;
    }

    public function getVr_unitario() {
        return $this -> vr_unitario;
    }

    public function setCod($value) {
        $this -> cod = $value;
    }

    public function setDesc($value) {
        $this -> desc = $value;
    }

    public function setNcm($value) {
        $this -> ncm = $value;
    }

    public function setUnd($value) {
        $this -> und = $value;
    }

    public function setVr_unitario($value) {
        $this -> vr_unitario = $value;
    }

}
