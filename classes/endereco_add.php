<?php
namespace PHPMaker2020\sistema;

/**
 * Page class
 */
class endereco_add extends endereco
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{448C0B4B-C32A-40EF-8151-41E96F03E813}";

	// Table name
	public $TableName = 'endereco';

	// Page object name
	public $PageObjName = "endereco_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (endereco)
		if (!isset($GLOBALS["endereco"]) || get_class($GLOBALS["endereco"]) == PROJECT_NAMESPACE . "endereco") {
			$GLOBALS["endereco"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["endereco"];
		}

		// Table object (pessoa)
		if (!isset($GLOBALS['pessoa']))
			$GLOBALS['pessoa'] = new pessoa();

		// Table object (academia)
		if (!isset($GLOBALS['academia']))
			$GLOBALS['academia'] = new academia();

		// Table object (aulas)
		if (!isset($GLOBALS['aulas']))
			$GLOBALS['aulas'] = new aulas();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'endereco');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (pessoa)
		$UserTable = $UserTable ?: new pessoa();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $endereco;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($endereco);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "enderecoview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['idendereco'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->idendereco->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
		$Security->UserID_Loading();
		$Security->loadUserID();
		$Security->UserID_Loaded();
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canAdd()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (IsPasswordExpired())
				$this->terminate(GetUrl("changepwd.php"));
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("enderecolist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate(GetUrl("enderecolist.php"));
					return;
				}
			}
		}

		// Update last accessed time
		if ($UserProfile->isValidUser(CurrentUserName(), session_id())) {
		} else {
			Write($Language->phrase("UserProfileCorrupted"));
			$this->terminate();
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->idendereco->Visible = FALSE;
		$this->idacademia->Visible = FALSE;
		$this->idpessoa->Visible = FALSE;
		$this->CEP->setVisibility();
		$this->UF->setVisibility();
		$this->Cidade->setVisibility();
		$this->Bairro->setVisibility();
		$this->Rua->setVisibility();
		$this->Numero->setVisibility();
		$this->Complemento->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->idacademia);
		$this->setupLookupOptions($this->idpessoa);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("enderecolist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("idendereco") !== NULL) {
				$this->idendereco->setQueryStringValue(Get("idendereco"));
				$this->setKey("idendereco", $this->idendereco->CurrentValue); // Set up key
			} else {
				$this->setKey("idendereco", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Set up master/detail parameters
		// NOTE: must be after loadOldRecord to prevent master key values overwritten

		$this->setupMasterParms();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("enderecolist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "enderecolist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "enderecoview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->idendereco->CurrentValue = NULL;
		$this->idendereco->OldValue = $this->idendereco->CurrentValue;
		$this->idacademia->CurrentValue = NULL;
		$this->idacademia->OldValue = $this->idacademia->CurrentValue;
		$this->idpessoa->CurrentValue = CurrentUserID();
		$this->CEP->CurrentValue = NULL;
		$this->CEP->OldValue = $this->CEP->CurrentValue;
		$this->UF->CurrentValue = NULL;
		$this->UF->OldValue = $this->UF->CurrentValue;
		$this->Cidade->CurrentValue = NULL;
		$this->Cidade->OldValue = $this->Cidade->CurrentValue;
		$this->Bairro->CurrentValue = NULL;
		$this->Bairro->OldValue = $this->Bairro->CurrentValue;
		$this->Rua->CurrentValue = NULL;
		$this->Rua->OldValue = $this->Rua->CurrentValue;
		$this->Numero->CurrentValue = NULL;
		$this->Numero->OldValue = $this->Numero->CurrentValue;
		$this->Complemento->CurrentValue = NULL;
		$this->Complemento->OldValue = $this->Complemento->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'CEP' first before field var 'x_CEP'
		$val = $CurrentForm->hasValue("CEP") ? $CurrentForm->getValue("CEP") : $CurrentForm->getValue("x_CEP");
		if (!$this->CEP->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CEP->Visible = FALSE; // Disable update for API request
			else
				$this->CEP->setFormValue($val);
		}

		// Check field name 'UF' first before field var 'x_UF'
		$val = $CurrentForm->hasValue("UF") ? $CurrentForm->getValue("UF") : $CurrentForm->getValue("x_UF");
		if (!$this->UF->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UF->Visible = FALSE; // Disable update for API request
			else
				$this->UF->setFormValue($val);
		}

		// Check field name 'Cidade' first before field var 'x_Cidade'
		$val = $CurrentForm->hasValue("Cidade") ? $CurrentForm->getValue("Cidade") : $CurrentForm->getValue("x_Cidade");
		if (!$this->Cidade->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Cidade->Visible = FALSE; // Disable update for API request
			else
				$this->Cidade->setFormValue($val);
		}

		// Check field name 'Bairro' first before field var 'x_Bairro'
		$val = $CurrentForm->hasValue("Bairro") ? $CurrentForm->getValue("Bairro") : $CurrentForm->getValue("x_Bairro");
		if (!$this->Bairro->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Bairro->Visible = FALSE; // Disable update for API request
			else
				$this->Bairro->setFormValue($val);
		}

		// Check field name 'Rua' first before field var 'x_Rua'
		$val = $CurrentForm->hasValue("Rua") ? $CurrentForm->getValue("Rua") : $CurrentForm->getValue("x_Rua");
		if (!$this->Rua->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Rua->Visible = FALSE; // Disable update for API request
			else
				$this->Rua->setFormValue($val);
		}

		// Check field name 'Numero' first before field var 'x_Numero'
		$val = $CurrentForm->hasValue("Numero") ? $CurrentForm->getValue("Numero") : $CurrentForm->getValue("x_Numero");
		if (!$this->Numero->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Numero->Visible = FALSE; // Disable update for API request
			else
				$this->Numero->setFormValue($val);
		}

		// Check field name 'Complemento' first before field var 'x_Complemento'
		$val = $CurrentForm->hasValue("Complemento") ? $CurrentForm->getValue("Complemento") : $CurrentForm->getValue("x_Complemento");
		if (!$this->Complemento->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Complemento->Visible = FALSE; // Disable update for API request
			else
				$this->Complemento->setFormValue($val);
		}

		// Check field name 'idendereco' first before field var 'x_idendereco'
		$val = $CurrentForm->hasValue("idendereco") ? $CurrentForm->getValue("idendereco") : $CurrentForm->getValue("x_idendereco");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->CEP->CurrentValue = $this->CEP->FormValue;
		$this->UF->CurrentValue = $this->UF->FormValue;
		$this->Cidade->CurrentValue = $this->Cidade->FormValue;
		$this->Bairro->CurrentValue = $this->Bairro->FormValue;
		$this->Rua->CurrentValue = $this->Rua->FormValue;
		$this->Numero->CurrentValue = $this->Numero->FormValue;
		$this->Complemento->CurrentValue = $this->Complemento->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}

		// Check if valid User ID
		if ($res) {
			$res = $this->showOptionLink('add');
			if (!$res) {
				$userIdMsg = DeniedMessage();
				$this->setFailureMessage($userIdMsg);
			}
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->idendereco->setDbValue($row['idendereco']);
		$this->idacademia->setDbValue($row['idacademia']);
		$this->idpessoa->setDbValue($row['idpessoa']);
		$this->CEP->setDbValue($row['CEP']);
		$this->UF->setDbValue($row['UF']);
		$this->Cidade->setDbValue($row['Cidade']);
		$this->Bairro->setDbValue($row['Bairro']);
		$this->Rua->setDbValue($row['Rua']);
		$this->Numero->setDbValue($row['Numero']);
		$this->Complemento->setDbValue($row['Complemento']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['idendereco'] = $this->idendereco->CurrentValue;
		$row['idacademia'] = $this->idacademia->CurrentValue;
		$row['idpessoa'] = $this->idpessoa->CurrentValue;
		$row['CEP'] = $this->CEP->CurrentValue;
		$row['UF'] = $this->UF->CurrentValue;
		$row['Cidade'] = $this->Cidade->CurrentValue;
		$row['Bairro'] = $this->Bairro->CurrentValue;
		$row['Rua'] = $this->Rua->CurrentValue;
		$row['Numero'] = $this->Numero->CurrentValue;
		$row['Complemento'] = $this->Complemento->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("idendereco")) != "")
			$this->idendereco->OldValue = $this->getKey("idendereco"); // idendereco
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// idendereco
		// idacademia
		// idpessoa
		// CEP
		// UF
		// Cidade
		// Bairro
		// Rua
		// Numero
		// Complemento

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// idendereco
			$this->idendereco->ViewValue = $this->idendereco->CurrentValue;
			$this->idendereco->ViewCustomAttributes = "";

			// idacademia
			$curVal = strval($this->idacademia->CurrentValue);
			if ($curVal != "") {
				$this->idacademia->ViewValue = $this->idacademia->lookupCacheOption($curVal);
				if ($this->idacademia->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`idacademia`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->idacademia->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->idacademia->ViewValue = $this->idacademia->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->idacademia->ViewValue = $this->idacademia->CurrentValue;
					}
				}
			} else {
				$this->idacademia->ViewValue = NULL;
			}
			$this->idacademia->ViewCustomAttributes = "";

			// idpessoa
			$curVal = strval($this->idpessoa->CurrentValue);
			if ($curVal != "") {
				$this->idpessoa->ViewValue = $this->idpessoa->lookupCacheOption($curVal);
				if ($this->idpessoa->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`idpessoa`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->idpessoa->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->idpessoa->ViewValue = $this->idpessoa->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->idpessoa->ViewValue = $this->idpessoa->CurrentValue;
					}
				}
			} else {
				$this->idpessoa->ViewValue = NULL;
			}
			$this->idpessoa->ViewCustomAttributes = "";

			// CEP
			$this->CEP->ViewValue = $this->CEP->CurrentValue;
			$this->CEP->ViewCustomAttributes = "";

			// UF
			$this->UF->ViewValue = $this->UF->CurrentValue;
			$this->UF->ViewCustomAttributes = "";

			// Cidade
			$this->Cidade->ViewValue = $this->Cidade->CurrentValue;
			$this->Cidade->ViewCustomAttributes = "";

			// Bairro
			$this->Bairro->ViewValue = $this->Bairro->CurrentValue;
			$this->Bairro->ViewCustomAttributes = "";

			// Rua
			$this->Rua->ViewValue = $this->Rua->CurrentValue;
			$this->Rua->ViewCustomAttributes = "";

			// Numero
			$this->Numero->ViewValue = $this->Numero->CurrentValue;
			$this->Numero->ViewCustomAttributes = "";

			// Complemento
			$this->Complemento->ViewValue = $this->Complemento->CurrentValue;
			$this->Complemento->ViewCustomAttributes = "";

			// CEP
			$this->CEP->LinkCustomAttributes = "";
			$this->CEP->HrefValue = "";
			$this->CEP->TooltipValue = "";

			// UF
			$this->UF->LinkCustomAttributes = "";
			$this->UF->HrefValue = "";
			$this->UF->TooltipValue = "";

			// Cidade
			$this->Cidade->LinkCustomAttributes = "";
			$this->Cidade->HrefValue = "";
			$this->Cidade->TooltipValue = "";

			// Bairro
			$this->Bairro->LinkCustomAttributes = "";
			$this->Bairro->HrefValue = "";
			$this->Bairro->TooltipValue = "";

			// Rua
			$this->Rua->LinkCustomAttributes = "";
			$this->Rua->HrefValue = "";
			$this->Rua->TooltipValue = "";

			// Numero
			$this->Numero->LinkCustomAttributes = "";
			$this->Numero->HrefValue = "";
			$this->Numero->TooltipValue = "";

			// Complemento
			$this->Complemento->LinkCustomAttributes = "";
			$this->Complemento->HrefValue = "";
			$this->Complemento->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// CEP
			$this->CEP->EditAttrs["class"] = "form-control";
			$this->CEP->EditCustomAttributes = "";
			if (!$this->CEP->Raw)
				$this->CEP->CurrentValue = HtmlDecode($this->CEP->CurrentValue);
			$this->CEP->EditValue = HtmlEncode($this->CEP->CurrentValue);
			$this->CEP->PlaceHolder = RemoveHtml($this->CEP->caption());

			// UF
			$this->UF->EditAttrs["class"] = "form-control";
			$this->UF->EditCustomAttributes = "";
			if (!$this->UF->Raw)
				$this->UF->CurrentValue = HtmlDecode($this->UF->CurrentValue);
			$this->UF->EditValue = HtmlEncode($this->UF->CurrentValue);
			$this->UF->PlaceHolder = RemoveHtml($this->UF->caption());

			// Cidade
			$this->Cidade->EditAttrs["class"] = "form-control";
			$this->Cidade->EditCustomAttributes = "";
			if (!$this->Cidade->Raw)
				$this->Cidade->CurrentValue = HtmlDecode($this->Cidade->CurrentValue);
			$this->Cidade->EditValue = HtmlEncode($this->Cidade->CurrentValue);
			$this->Cidade->PlaceHolder = RemoveHtml($this->Cidade->caption());

			// Bairro
			$this->Bairro->EditAttrs["class"] = "form-control";
			$this->Bairro->EditCustomAttributes = "";
			if (!$this->Bairro->Raw)
				$this->Bairro->CurrentValue = HtmlDecode($this->Bairro->CurrentValue);
			$this->Bairro->EditValue = HtmlEncode($this->Bairro->CurrentValue);
			$this->Bairro->PlaceHolder = RemoveHtml($this->Bairro->caption());

			// Rua
			$this->Rua->EditAttrs["class"] = "form-control";
			$this->Rua->EditCustomAttributes = "";
			if (!$this->Rua->Raw)
				$this->Rua->CurrentValue = HtmlDecode($this->Rua->CurrentValue);
			$this->Rua->EditValue = HtmlEncode($this->Rua->CurrentValue);
			$this->Rua->PlaceHolder = RemoveHtml($this->Rua->caption());

			// Numero
			$this->Numero->EditAttrs["class"] = "form-control";
			$this->Numero->EditCustomAttributes = "";
			if (!$this->Numero->Raw)
				$this->Numero->CurrentValue = HtmlDecode($this->Numero->CurrentValue);
			$this->Numero->EditValue = HtmlEncode($this->Numero->CurrentValue);
			$this->Numero->PlaceHolder = RemoveHtml($this->Numero->caption());

			// Complemento
			$this->Complemento->EditAttrs["class"] = "form-control";
			$this->Complemento->EditCustomAttributes = "";
			if (!$this->Complemento->Raw)
				$this->Complemento->CurrentValue = HtmlDecode($this->Complemento->CurrentValue);
			$this->Complemento->EditValue = HtmlEncode($this->Complemento->CurrentValue);
			$this->Complemento->PlaceHolder = RemoveHtml($this->Complemento->caption());

			// Add refer script
			// CEP

			$this->CEP->LinkCustomAttributes = "";
			$this->CEP->HrefValue = "";

			// UF
			$this->UF->LinkCustomAttributes = "";
			$this->UF->HrefValue = "";

			// Cidade
			$this->Cidade->LinkCustomAttributes = "";
			$this->Cidade->HrefValue = "";

			// Bairro
			$this->Bairro->LinkCustomAttributes = "";
			$this->Bairro->HrefValue = "";

			// Rua
			$this->Rua->LinkCustomAttributes = "";
			$this->Rua->HrefValue = "";

			// Numero
			$this->Numero->LinkCustomAttributes = "";
			$this->Numero->HrefValue = "";

			// Complemento
			$this->Complemento->LinkCustomAttributes = "";
			$this->Complemento->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->CEP->Required) {
			if (!$this->CEP->IsDetailKey && $this->CEP->FormValue != NULL && $this->CEP->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CEP->caption(), $this->CEP->RequiredErrorMessage));
			}
		}
		if ($this->UF->Required) {
			if (!$this->UF->IsDetailKey && $this->UF->FormValue != NULL && $this->UF->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UF->caption(), $this->UF->RequiredErrorMessage));
			}
		}
		if ($this->Cidade->Required) {
			if (!$this->Cidade->IsDetailKey && $this->Cidade->FormValue != NULL && $this->Cidade->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Cidade->caption(), $this->Cidade->RequiredErrorMessage));
			}
		}
		if ($this->Bairro->Required) {
			if (!$this->Bairro->IsDetailKey && $this->Bairro->FormValue != NULL && $this->Bairro->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Bairro->caption(), $this->Bairro->RequiredErrorMessage));
			}
		}
		if ($this->Rua->Required) {
			if (!$this->Rua->IsDetailKey && $this->Rua->FormValue != NULL && $this->Rua->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Rua->caption(), $this->Rua->RequiredErrorMessage));
			}
		}
		if ($this->Numero->Required) {
			if (!$this->Numero->IsDetailKey && $this->Numero->FormValue != NULL && $this->Numero->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Numero->caption(), $this->Numero->RequiredErrorMessage));
			}
		}
		if ($this->Complemento->Required) {
			if (!$this->Complemento->IsDetailKey && $this->Complemento->FormValue != NULL && $this->Complemento->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Complemento->caption(), $this->Complemento->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Check if valid User ID
		$validUser = FALSE;
		if ($Security->currentUserID() != "" && !EmptyValue($this->idpessoa->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validUser = $Security->isValidUserID($this->idpessoa->CurrentValue);
			if (!$validUser) {
				$userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
				$userIdMsg = str_replace("%u", $this->idpessoa->CurrentValue, $userIdMsg);
				$this->setFailureMessage($userIdMsg);
				return FALSE;
			}
		}

		// Check if valid key values for master user
		if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
			$masterFilter = $this->sqlMasterFilter_pessoa();
			if (strval($this->idpessoa->CurrentValue) != "") {
				$masterFilter = str_replace("@idpessoa@", AdjustSql($this->idpessoa->CurrentValue, "DB"), $masterFilter);
			} else {
				$masterFilter = "";
			}
			if ($masterFilter != "") {
				$rsmaster = $GLOBALS["pessoa"]->loadRs($masterFilter);
				$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
				$validMasterKey = TRUE;
				if ($this->MasterRecordExists) {
					$validMasterKey = $Security->isValidUserID($rsmaster->fields['idpessoa']);
				} elseif ($this->getCurrentMasterTable() == "pessoa") {
					$validMasterKey = FALSE;
				}
				if (!$validMasterKey) {
					$masterUserIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedMasterUserID"));
					$masterUserIdMsg = str_replace("%f", $masterFilter, $masterUserIdMsg);
					$this->setFailureMessage($masterUserIdMsg);
					return FALSE;
				}
				if ($rsmaster)
					$rsmaster->close();
			}
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// CEP
		$this->CEP->setDbValueDef($rsnew, $this->CEP->CurrentValue, NULL, FALSE);

		// UF
		$this->UF->setDbValueDef($rsnew, $this->UF->CurrentValue, NULL, FALSE);

		// Cidade
		$this->Cidade->setDbValueDef($rsnew, $this->Cidade->CurrentValue, NULL, FALSE);

		// Bairro
		$this->Bairro->setDbValueDef($rsnew, $this->Bairro->CurrentValue, NULL, FALSE);

		// Rua
		$this->Rua->setDbValueDef($rsnew, $this->Rua->CurrentValue, NULL, FALSE);

		// Numero
		$this->Numero->setDbValueDef($rsnew, $this->Numero->CurrentValue, NULL, FALSE);

		// Complemento
		$this->Complemento->setDbValueDef($rsnew, $this->Complemento->CurrentValue, NULL, FALSE);

		// idacademia
		if ($this->idacademia->getSessionValue() != "") {
			$rsnew['idacademia'] = $this->idacademia->getSessionValue();
		}

		// idpessoa
		if ($this->idpessoa->getSessionValue() != "") {
			$rsnew['idpessoa'] = $this->idpessoa->getSessionValue();
		} elseif (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin
			$rsnew['idpessoa'] = CurrentUserID();
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Show link optionally based on User ID
	protected function showOptionLink($id = "")
	{
		global $Security;
		if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id))
			return $Security->isValidUserID($this->idpessoa->CurrentValue);
		return TRUE;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "academia") {
				$validMaster = TRUE;
				if (($parm = Get("fk_idacademia", Get("idacademia"))) !== NULL) {
					$GLOBALS["academia"]->idacademia->setQueryStringValue($parm);
					$this->idacademia->setQueryStringValue($GLOBALS["academia"]->idacademia->QueryStringValue);
					$this->idacademia->setSessionValue($this->idacademia->QueryStringValue);
					if (!is_numeric($GLOBALS["academia"]->idacademia->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "pessoa") {
				$validMaster = TRUE;
				if (($parm = Get("fk_idpessoa", Get("idpessoa"))) !== NULL) {
					$GLOBALS["pessoa"]->idpessoa->setQueryStringValue($parm);
					$this->idpessoa->setQueryStringValue($GLOBALS["pessoa"]->idpessoa->QueryStringValue);
					$this->idpessoa->setSessionValue($this->idpessoa->QueryStringValue);
					if (!is_numeric($GLOBALS["pessoa"]->idpessoa->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "academia") {
				$validMaster = TRUE;
				if (($parm = Post("fk_idacademia", Post("idacademia"))) !== NULL) {
					$GLOBALS["academia"]->idacademia->setFormValue($parm);
					$this->idacademia->setFormValue($GLOBALS["academia"]->idacademia->FormValue);
					$this->idacademia->setSessionValue($this->idacademia->FormValue);
					if (!is_numeric($GLOBALS["academia"]->idacademia->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "pessoa") {
				$validMaster = TRUE;
				if (($parm = Post("fk_idpessoa", Post("idpessoa"))) !== NULL) {
					$GLOBALS["pessoa"]->idpessoa->setFormValue($parm);
					$this->idpessoa->setFormValue($GLOBALS["pessoa"]->idpessoa->FormValue);
					$this->idpessoa->setSessionValue($this->idpessoa->FormValue);
					if (!is_numeric($GLOBALS["pessoa"]->idpessoa->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "academia") {
				if ($this->idacademia->CurrentValue == "")
					$this->idacademia->setSessionValue("");
			}
			if ($masterTblVar != "pessoa") {
				if ($this->idpessoa->CurrentValue == "")
					$this->idpessoa->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("enderecolist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_idacademia":
					break;
				case "x_idpessoa":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_idacademia":
							break;
						case "x_idpessoa":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>