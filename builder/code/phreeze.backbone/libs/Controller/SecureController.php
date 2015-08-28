<?php
/** @package Cargo::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/User.php");

/**
 * SecureExampleController is a sample controller to demonstrate
 * one approach to authentication in a Phreeze app
 *
 * @package Cargo::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class SecureController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
	}
	
	/**
	 * This page requires ExampleUser::$PERMISSION_USER to view
	 */
	public function UserPage()
	{
		$this->RequirePermission(User::$PERMISSION_READ, 
				'Secure.LoginForm', 
				'Login e requerido para acessar essa pagina',
				'Permissao de leitura e obrigatoria');
		
		$this->Assign("currentUser", $this->GetCurrentUser());
		
		$this->Assign('page','userpage');
		$this->Render("Secure");
	}
	
	/**
	 * This page requires ExampleUser::$PERMISSION_ADMIN to view
	 */
	public function AdminPage()
	{
		$this->RequirePermission(User::$PERMISSION_ADMIN, 
				'Secure.LoginForm', 
				'Login e requerido para acessar a pagina de admin',
				'Permissao de admin e requerida');
		
		$this->Assign("currentUser", $this->GetCurrentUser());
		
		$this->Assign('page','adminpage');
		$this->Render("Secure");
	}
	
	/**
	 * Display the login form
	 */
	public function LoginForm()
	{
		$this->Assign("currentUser", $this->GetCurrentUser());
		
		$this->Assign('page','login');
		$this->Render("Secure");
	}
	
	/**
	 * Process the login, create the user session and then redirect to 
	 * the appropriate page
	 */
	public function Login()
	{
		$user = new User($this->Phreezer);
		
		if ($user->Login(RequestUtil::Get('username'), RequestUtil::Get('password')))
		{
			// login success
			$this->SetCurrentUser($user);
			$this->Redirect('Secure.UserPage');
		}
		else
		{
			// login failed
			$this->Redirect('Secure.LoginForm','Usuario e senha invalidos.');
		}
	}
	
	/**
	 * Clear the user session and redirect to the login page
	 */
	public function Logout()
	{
		$this->ClearCurrentUser();
		$this->Redirect("Secure.LoginForm","You are now logged out");
	}

}
?>