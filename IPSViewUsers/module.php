<?php

class IPSViewUsers extends IPSModule
{
	// Internal Store
	protected $userStore;
	
	// -------------------------------------------------------------------------
	public function Create() {
		parent::Create();

		$this->RegisterPropertyString  ('UserList',        '[]');
	}

	// -------------------------------------------------------------------------
	public function RequestAction($Ident, $Value) {
		switch($Ident) {
			default:
				throw new Exception("Invalid ident");
		}
	}
	
	// -------------------------------------------------------------------------
	public function ApplyChanges() {
		parent::ApplyChanges();

		$this->SendDebug('ApplyChanges', 'ApplyChanges ...', 0);
	}

	// -------------------------------------------------------------------------
	public function GetConfigurationForm() {
		$formContent = file_get_contents(__DIR__ . "/form.json");
		$data = json_decode($formContent, true);

		return json_encode($data);
	}

	// -------------------------------------------------------------------------
	protected function BuildUserStore() {
		$this->userStore     = json_decode($this->ReadPropertyString('UserList'), true);

	}

	// -------------------------------------------------------------------------
	public function UserExists($username) {
		$this->BuildUserStore();
		foreach ($this->userStore as &$userRec) {
			if ($userRec["UserName"] == $username) {
				return true;
			}
		}
		return false;
	}

	// -------------------------------------------------------------------------
	public function GetUserViewID($username) {
		$this->BuildUserStore();
		foreach ($this->userStore as &$userRec) {
			if ($userRec["UserName"] == $username) {
				return $userRec["ViewID"];
			}
		}
		throw new Exception("Invalid Username ".$username);
	}
	
	// -------------------------------------------------------------------------
	public function GetUserPwd($username) {
		$this->BuildUserStore();
		foreach ($this->userStore as &$userRec) {
			if ($userRec["UserName"] == $username) {
				return $userRec["UserPwd"];
			}
		}
		throw new Exception("Invalid Username ".$username);
	}

}

?>