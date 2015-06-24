<?php namespace ResultSystems\Emtudo\Core\Validation;
use KennedyTedesco\Validation\Validator as TedescoValidator;

class Validator extends TedescoValidator{

	const PESSOA_FISICA = 2;
	const PESSOA_JURIDICA = 1;

	public function validatePessoaCpf($attribute, $value, $parameters){
		global $CONFIG_PARCEIRO_CPFCNPJ_REQUIRED;
		$data = $this->getData();

		if($this->isPessoaFisica($data)){
			if ((!isset($CONFIG_PARCEIRO_CPFCNPJ_REQUIRED) || !$CONFIG_PARCEIRO_CPFCNPJ_REQUIRED) && $value=='00000000000')
				return true;
			return $this->validateCpf($attribute, $value, $parameters);
		}

		return true;
	}

	public function validatePessoaCnpj($attribute, $value, $parameters){
		$data = $this->getData();

		if($this->isPessoaJuridica($data)){
			if ((!isset($CONFIG_PARCEIRO_CPFCNPJ_REQUIRED) || !$CONFIG_PARCEIRO_CPFCNPJ_REQUIRED) && $value=='00000000000000')
				return true;
			return $this->validateCnpj($attribute, $value, $parameters);
		}

		return true;
	}

	public function isPessoaFisica($data = []){
		return array_get($data, 'Pessoa_Fisica', null) != self::PESSOA_JURIDICA;
	}
	public function isPessoaJuridica($data = []){
		return array_get($data, 'Pessoa_Fisica', null) != self::PESSOA_FISICA;
	}
}
