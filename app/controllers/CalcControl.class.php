<?php
namespace app\controllers;

use app\forms\CalcForm;
use app\transfer\CalcResistor;

class CalcControl {

	private $form;
	private $resistor;
		
	public function __construct(){
		$this->form = new CalcForm();
		$this->resistor = new CalcResistor();
	}
        
        public function getParams() {
                $this->form->v1 = getFromRequest('v1');
                $this->form->v2 = getFromRequest('v2');
                $this->form->amp = getFromRequest('amp');
        }
        
        public function validate() {
                if (!(isset($this->form->v1) && isset($this->form->v2) && isset($this->form->amp))) return false;
    
                if ($this->form->v1 == "") getMessages()->addError ('Nie podano napięcia zasilania!');
                if ($this->form->v2 == "") getMessages()->addError ('Nie podano napięcia przewodzenia!');
                if ($this->form->amp == "") getMessages()->addError ('Nie podano prądu przewodzenia!');
    
                if (! getMessages()->isError()){

                    if (!is_numeric($this->form->v1)) getMessages()->addError ('Błędny zapis napięcia zasilania!');
                    if (!is_numeric($this->form->v2)) getMessages()->addError ('Błędny zapis napięcia przewodzenia!');
                    if (!is_numeric($this->form->amp)) getMessages()->addError ('Błędny zapis prądu przewodzenia!');
                }
    
                if (! getMessages()->isError()){
                    if ($this->form->v1 <= $this->form->v2) getMessages()->addError ('Wartość napięcia zasilania musi być większa od wartości napięcia przewodzenia!');
                }
    
                return ! getMessages()->isError();
        }
        
        public function action_calcCompute() {
            
                $this->getparams();
                
                if ($this->validate()) {
    
                    $this->form->v1 = doubleval($this->form->v1);
                    $this->form->v2 = doubleval($this->form->v2);
                    $this->form->amp = doubleval ($this->form->amp);
                    getMessages()->addInfo('Parametry poprawne.');

                    $this->resistor->resistor = ($this->form->v1 - $this->form->v2) / ($this->form->amp / 1000);
                    getMessages()->addInfo('Wykonano obliczenia.');
                }
                
                $this->generateView();
        }
        
        public function action_calcShow(){
		getMessages()->addInfo('Witaj w kalkulatorze');
		$this->generateView();
	}
        
        public function generateView(){
		
                getSmarty()->assign('page_title','Kalkulator');
                getSmarty()->assign('page_description','Kalkulator umożliwiający dobranie odpowiedniego rezystora do diody LED.');
                getSmarty()->assign('page_header','Kalkulator rezystora diody LED');
                getSmarty()->assign('author','Zaprojektowany przez: Dawid Gruszecki');
                
                getSmarty()->assign('user',unserialize($_SESSION['user']));

                getSmarty()->assign('form',$this->form);
                getSmarty()->assign('resistor',$this->resistor);
                getSmarty()->assign('button','Do kalkulatora');
                getSmarty()->assign('menubtn','Kalkulator');
                getSmarty()->assign('menuLogout','Wyloguj');

                getSmarty()->display('calcView.tpl');
	}
}
?>