<?php
	/*
	|--------------------------------------------------------------------------
	| Routes
	|--------------------------------------------------------------------------
	|
	| Listed below are all the routes that are being used by this application.
	| These routes are grouped in partials by controller type
	| and are sorted based on the file structure of the controller folder. 
	|
	*/

	/**
	 * AuthController routes
	 */
	include('RoutePartials/Auth/_authControllerRoutes.php');

	/**
	 * Passwordontroller routes
	 */
	include('RoutePartials/Auth/_passwordControllerRoutes.php');

	/**
	 * RegistrationController routes
	 */
	include('RoutePartials/Auth/_registrationControllerRoutes.php');

	/**
	 * AutocompleteController routes
	 */
	include('RoutePartials/_autocompleteControllerRoutes.php');

	/**
	 * CarouselController routes
	 */
	include('RoutePartials/_carouselControllerRoutes.php');

	/**
	 * FileController routes
	 */
	include('RoutePartials/_fileControllerRoutes.php');

	/**
	 *  FooterController routes
	 */
	include('RoutePartials/_footerControllerRoutes.php');

	/**
	 * HomeController routes
	 */
	include('RoutePartials/_homeControllerRoutes.php');

	/**
	 * ManagementController routes
	 */
	include('RoutePartials/_managementControllerRoutes.php');

	/**
	 * MenuController routes
	 */
	include ('RoutePartials/_menuControllerRoutes.php');

	/**
	 * NewOnSiteController routes
	 */
	include ('RoutePartials/_newOnSiteRoutes.php');

	/**
	 * NewsController routes
	 */
	include('RoutePartials/_newsControllerRoutes.php');

	/**
	 * PageController routers
	 */
	include ('RoutePartials/_pageControllerRoutes.php');

	/**
	 * PostalController routes
	 */
	include('RoutePartials/_postalControllerRoutes.php');

	/**
	 * PermissionsController routers
	 */
	include ('RoutePartials/_permissionsControllerRoutes.php');

	/**
	 * SearchController routes
	 */
	include('RoutePartials/_searchControllerRoutes.php');

	/**
	 * SidebarController routes
	 */
	include('RoutePartials/_sidebarControllerRoutes.php');

	/**
	 * UserController routes
	 */
	include ('RoutePartials/_userControllerRoutes.php');

	/**
	 * DistrictSectionController routes
	 */
	include ('RoutePartials/_districtSectionRoutes.php');
