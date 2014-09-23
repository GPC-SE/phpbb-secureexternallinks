<?php
/**
*
* @package phpBB Extension - GPC Secure External Links
* @copyright (c) 2014 Robet Heim
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace gpc\secureexternallinks\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_footer'	=> 'setup_base_url_and_whitelist',
		);
	}

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper	$helper		Controller helper object
	* @param \phpbb\template			$template	Template object
	*/
	public function __construct(\phpbb\controller\helper $helper, \phpbb\template\template $template)
	{
		$this->helper = $helper;
		$this->template = $template;
	}

	public function setup_base_url_and_whitelist($event)
	{
		$base_url = $this->helper->route("gpc_secureexternallinks_ref");
		$this->template->assign_var('GPC_SECURE_EXTERNAL_LINKS_BASE_URL', $base_url);

		$whitelist = "penspinning.de,youtube.com,imageshack.us,imagebanana.com,photobucket.com,tinypic.com,directupload.net,bilder-hochladen.net,deviantart.net,yfrog.com,abload.de,google.de,upsb.info,penwish.com,google.com,penspinning.ch,spsc.es,penspinning.pl,penspinning-tr.com,swespin.se,hkpsa.com,kitcat-tricks.net";
		$this->template->assign_var('GPC_SECURE_EXTERNAL_LINKS_WHITELIST', $whitelist);
	}

}
