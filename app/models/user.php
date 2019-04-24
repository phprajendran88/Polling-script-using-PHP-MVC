<?php

Class User extends Model
{
	protected $table = 'users';
	
	/*
	* will call the parent class construct method to init db object
	*/
	public function __construct()
	{
		parent::__construct();
	}

}