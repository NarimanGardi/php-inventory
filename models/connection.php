<?php

class Connection{

	public static function connect(){

		$link = new PDO("mysql:host=localhost;dbname=pos-english", "root", "");

		$link -> exec("set names utf8");

		return $link;
	}

}
