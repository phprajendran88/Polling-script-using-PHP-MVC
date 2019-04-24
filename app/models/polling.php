<?php

Class Polling extends Model
{
	protected $table = 'polling';
	
	/*
	* will call the parent class construct method to init db object
	*/
	public function __construct()
	{
		parent::__construct();
	}

}