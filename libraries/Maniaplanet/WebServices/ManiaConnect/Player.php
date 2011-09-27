<?php
/**
 * Maniaplanet Web Services SDK for PHP
 *
 * @see		    http://code.google.com/p/maniaplanet-ws-sdk/
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @author      $Author$:
 * @version     $Revision$:
 * @date        $Date$:
 */

namespace Maniaplanet\WebServices\ManiaConnect;

/**
 * The base class for using OAuth2.
 */
class Player extends Client
{

	/**
	 * This is the first method to call when you have an authorization code. 
	 * It will retrieve an access token if possible and then call the service to
	 * retrieve a basic object about the authentified player. 
	 * 
	 * You do not need any special scope to call this service, as long as you 
	 * have an access token.
	 * 
	 * If an access token is not found, it will return false
	 * 
	 * @return object A player object or false if no access token is found
	 */
	function getPlayer()
	{
		$player = $this->getVariable('player');
		if(!$player)
		{
			if($this->getAccessToken())
			{
				$player = $this->executeOAuth2('GET', '/player/');
				$this->setVariable('player', $player);
			}
		}
		return $player;
	}

	/**
	 * Returns an object containing the online status and the dedicated server 
	 * info on which the player is playing, if applicable.
	 * 
	 * Scope needed: online_status
	 * 
	 * @return object
	 */
	function getOnlineStatus()
	{
		return $this->execute('GET', '/player/status/');
	}

	/**
	 * Returns the email associated with the player's account.
	 * 
	 * Scope needed: email
	 * 
	 * @return string
	 */
	function getEmail()
	{
		return $this->execute('GET', '/player/email/');
	}

	/**
	 * Returns the buddies of the player as an array of player objects
	 * 
	 * Scope needed: buddies
	 * 
	 * @return array[object]
	 */
	function getBuddies()
	{
		return $this->execute('GET', '/player/buddies/');
	}

	/**
	 * Gets the list of the player's registered dedicated servers and their 
	 * online statuses.
	 * 
	 * Scope needed: dedicated
	 * 
	 * @return array[object]
	 */
	function getDedicated()
	{
		return $this->execute('GET', '/player/dedicated/');
	}

	/**
	 * Gets the list of the player's registered Manialinks.
	 * 
	 * Scope needed: manialinks
	 * 
	 * @return array[object]
	 */
	function getManialinks()
	{
		return $this->execute('GET', '/player/manialinks/');
	}

}

?>