<?php

	/**
	 * This trunc function will word limit a provided phrase 
	 * depending on the max word count.
	 * 
	 * @param 	String $phrase
	 * @param 	int $max_words
	 * 
	 * @return 	String
	 */
	function trunc($phrase, $max_words) 
	{
	   $phrase_array = explode(' ',$phrase);

	   if(count($phrase_array) > $max_words && $max_words > 0)
	   {
	      $phrase = implode(' ', array_slice($phrase_array, 0, $max_words)) . '...';
	   }

	   return $phrase;
	}

	/**
	 * This parsers helps translating the html checkbox and radio buttons.
	 * This will effectivly turn a string into an actual boolean.
	 * 
	 * @param  	String $value
	 * 
	 * @return 	bool
	 */
    function parseCheckboxOrRadioButton($value)
    {
        if($value === "on" || $value === "true")
        {
            return true;
        }

        return false;
    }

	/**
	 * This parsers helps translating the html select (dropdown) box.
	 * This will effectivly turn a string into an actual null 'value'.
	 * 
	 * @param  	String $value
	 * 
	 * @return 	mixed
	 */
    function parseSelectorField($value)
    {
        if (empty($value))
        {
            return null;
        }
        
        return $value;
    }

    /**
     * Returns the name of the Administrator role as described in the database.
     *
     * @return 	String
     */
    function getAdministratorName()
    {
        return "Administrator";
    }

    /**
     * Returns the name of the Content Manager role as described in the database.
     *
     * @return 	String
     */
    function getContentManagerName()
    {
        return "Content Beheerder";
    }