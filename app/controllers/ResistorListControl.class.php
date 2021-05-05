<?php

namespace app\controllers;

use app\forms\ResistorListForm;
use PDOException;

class ResistorListControl {

	private $form; //dane formularza

	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->form = new ResistorListForm();
	}

	//validacja danych przed zapisem (nowe dane lub edycja)
	public function validateSave() {
		//0. Pobranie parametrów z walidacją
		$this->form->id = getFromRequest('id',true,'Błędne wywołanie aplikacji');
		$this->form->volt1 = getFromRequest('v1',true,'Błędne wywołanie aplikacji');
		$this->form->volt2 = getFromRequest('v2',true,'Błędne wywołanie aplikacji');
		$this->form->amps = getFromRequest('amp',true,'Błędne wywołanie aplikacji');
                $this->form->resis = getFromRequest('resistor',true,'Błędne wywołanie aplikacji');

		if ( getMessages()->isError() ) return false;

		// 1. sprawdzenie czy wartości wymagane nie są puste
		if (empty(trim($this->form->volt1))) {
			getMessages()->addError('Wprowadź napięcie zasilania');
		}
		if (empty(trim($this->form->volt2))) {
			getMessages()->addError('Wprowadź napięcie przewodzenia diody');
		}
		if (empty(trim($this->form->amps))) {
			getMessages()->addError('Wprowadź prąd przewodzenia diody');
		}

		if ( getMessages()->isError() ) return false;
		
		return ! getMessages()->isError();
	}

	//validacja danych przed wyswietleniem do edycji
	public function validateEdit() {
		//pobierz parametry na potrzeby wyswietlenia danych do edycji
		//z widoku listy osób (parametr jest wymagany)
		$this->form->id = getFromRequest('id',true,'Błędne wywołanie aplikacji');
		return ! getMessages()->isError();
	}
	
	public function action_resistorNew(){
		$this->generateView();
	}

	public function action_resistorDelete(){		
		// 1. walidacja id osoby do usuniecia
		if ( $this->validateEdit() ){
			
			try{
				// 2. usunięcie rekordu
				getDB()->delete("resistors",[
					"id" => $this->form->id
				]);
				getMessages()->addInfo('Pomyślnie usunięto rekord');
			} catch (PDOException $e){
				getMessages()->addError('Wystąpił błąd podczas usuwania rekordu');
				if (getConf()->debug) getMessages()->addError($e->getMessage());			
			}	
		}
		
		// 3. Przekierowanie na stronę listy osób
		forwardTo('resistorList');		
	}

	public function action_resistorSave(){
			
		// 1. Walidacja danych formularza (z pobraniem)
		if ($this->validateSave()) {
			// 2. Zapis danych w bazie
			try {
				
				//2.1 Nowy rekord
				if ($this->form->id == '') {
					//sprawdź liczebność rekordów - nie pozwalaj przekroczyć 20
					$count = getDB()->count("resistors");
					if ($count <= 10) {
						getDB()->insert("resistors", [
							"volt1" => $this->form->volt1,
							"volt2" => $this->form->volt2,
							"amps" => $this->form->amps,
                                                        "resistor" => $this->form->resis
						]);
					} else { //za dużo rekordów
						// Gdy za dużo rekordów to pozostań na stronie
						getMessages()->addInfo('Ograniczenie: Zbyt dużo rekordów. Aby dodać nowy usuń wybrany wpis.');
						$this->generateView(); //pozostań na stronie edycji
						exit(); //zakończ przetwarzanie, aby nie dodać wiadomości o pomyślnym zapisie danych
					}
				}
				getMessages()->addInfo('Pomyślnie zapisano rekord');

			} catch (PDOException $e){
				getMessages()->addError('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
				if (getConf()->debug) getMessages()->addError($e->getMessage());			
			}
			
			// 3b. Po zapisie przejdź na stronę listy osób (w ramach tego samego żądania http)
			forwardTo('resistorList');

		} else {
			// 3c. Gdy błąd walidacji to pozostań na stronie
			$this->generateView();
		}		
	}
	
	public function generateView(){
		getSmarty()->assign('form',$this->form); // dane formularza dla widoku
		getSmarty()->assign('page_title','Lista wyników');
                getSmarty()->assign('page_description','Kalkulator umożliwiający dobranie odpowiedniego rezystora do diody LED.');
                getSmarty()->assign('button','Do listy');
                getSmarty()->assign('menubtn1','Kalkulator');
                getSmarty()->assign('menubtn2','Lista wyników');
                getSmarty()->assign('menuLogout','Wyloguj');
                getSmarty()->assign('author','Zaprojektowany przez: Dawid Gruszecki');
                getSmarty()->display('resistorList.tpl');
	}
}
?>