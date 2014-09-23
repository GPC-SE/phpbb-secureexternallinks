<?php
/**
 *
 * @package phpBB Extension - GPC Secure External Links
 * @copyright (c) 2014 Robet Heim
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace gpc\secureexternallinks\controller;

class main
{
	/* @var \phpbb\request\request */
	protected $request;
	
	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;

	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request			$request
	 * @param \phpbb\controller\helper			$helper
	 * @param \phpbb\template\template			$template
	 */
	public function __construct(\phpbb\request\request $request, \phpbb\controller\helper $helper, \phpbb\template\template $template)
	{
		$this->request = $request;
		$this->helper = $helper;
		$this->template = $template;
	}

	/**
	 * Demo controller for route /ref
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function ref()
	{
		$delay=3;
		$url=urldecode($this->request->variable('url', ''));

		$this->template->assign_var('DELAY', $delay);
		$this->template->assign_var('URL', $url);

		return $this->helper->render('ref.html');
	}
}
