<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Blog Plugin
 *
 * Create lists of posts
 * 
 * @author   PyroCMS Dev Team
 * @package  PyroCMS\Core\Modules\Blog\Plugins
 */
class Plugin_Blog extends Plugin
{

	public $version = '1.0.0';
	public $name = array(
		'en' => 'Blog',
        'fa' => 'بلاگ',
	);
	public $description = array(
		'en' => 'A plugin to display information such as blog categories and posts.',
            'fa' => 'یک پلاگین برای نمایش اطلاعاتی مانند مجموعه های بلاگ و پست ها',
        'fr' => 'Un plugin permettant d\'afficher des informations comme les catégories et articles du blog.'
	);

	/**
	 * Returns a PluginDoc array
	 *
	 * @return array
	 */
	public function _self_doc()
	{

		$info = array(
			'customers' => array(
					'description' => array(// a single sentence to explain the purpose of this method
							'en' => ''
					),
					'single' => true,// will it work as a single tag?
					'attributes' => array(
						'limit' => array(
									'type' => 'number',
									'flags' => '',
									'default' => '',
									'required' => false,
								),
							),
			),
		);

		return $info;
	}

	/**
	 * Blog List
	 *
	 * Creates a list of blog posts. Takes all of the parameters
	 * available to streams, sans stream, where, and namespace.
	 *
	 * Usage:
	 * {{ blog:posts limit="5" }}
	 *		<h2>{{ title }}</h2>
	 * {{ /blog:posts }}
	 *
	 * @param	array
	 * @return	array
	 */
	public function customers()
	{
		$limit = $this->attribute('limit', 0);
		
		$this->db->select('id,title,slug,keywords,cover');	
		$this->db->where(array('status'=>'live', 'category_id'=>3));	
		
		$data = $this->db->limit($limit)->order_by('id', 'ASC')->get('blog')->result();
		var_dump($data);
	}
		
}