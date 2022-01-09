<?php
/**
 *
 * @package phpBB Extension - tas2580 SEO URLs
 * @copyright (c) 2016 tas2580 (https://tas2580.net)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace tas2580\seourls\event;

/**
 * Event listener
 */
class base
{

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	public $config;

	/** @var string phpbb_root_path */
	protected $phpbb_root_path;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth				auth					Authentication object
	 * @param \phpbb\config\config			$config					Config Object
	 * @param string						$phpbb_root_path		phpbb_root_path
	 * @access public
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, $phpbb_root_path)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->phpbb_root_path = $phpbb_root_path;
	}

	/**
	 * Generate the SEO link for a topic
	 *
	 * @param	int		$forum_id		The ID of the forum
	 * @param	string	$forum_name		The title of the forum
	 * @param	int		$topic_id		The ID if the topic
	 * @param	string	$topic_title	The title of the topic
	 * @param	int		$start			Optional start parameter
	 * @param	bool	$full			Return the full URL
	 * @return	string	The SEO URL
	 * @access private
	 */
	public function generate_topic_link($forum_id, $forum_name, $topic_id, $topic_title, $start = 0, $full = false)
	{
		if ($full)
		{
			return generate_board_url() . '/' . $this->title_to_url($forum_name) . '-f' . $forum_id . '/' . $this->title_to_url($topic_title) . '-t' . $topic_id . ($start ? '-s' . $start : '') . '.html';
		}
		return $this->phpbb_root_path . $this->title_to_url($forum_name) . '-f' . $forum_id . '/' . $this->title_to_url($topic_title) . '-t' . $topic_id . ($start ? '-s' . $start : '') . '.html';
	}

	/**
	 * Generate the SEO link for a forum
	 *
	 * @param	int		$forum_id		The ID of the forum
	 * @param	string	$forum_name		The title of the forum
	 * @param	int		$start			Optional start parameter
	 * @param	bool	$full			Return the full URL
	 * @return	string	The SEO URL
	 * @access private
	 */
	public function generate_forum_link($forum_id, $forum_name, $start = 0, $full = false)
	{
		if ($full)
		{
			return generate_board_url() . '/' . $this->title_to_url($forum_name) . '-f' . $forum_id . '/' . ($start ? 'index-s' . $start . '.html' : '');
		}
		return $this->phpbb_root_path . $this->title_to_url($forum_name) . '-f' . $forum_id . '/' . ($start ? 'index-s' . $start . '.html' : '');
	}

	/**
	 *
	 * @global	type	$_SID
	 * @param	int		$replies	Replays in the topic
	 * @param	string	$url		URL oft the topic
	 * @return	string				The URL with start included
	 */
	public function generate_lastpost_link($replies, $url)
	{
		$url = str_replace('.html', '', $url);
		$per_page = ($this->config['posts_per_page'] <= 0) ? 1 : $this->config['posts_per_page'];
		$last_post_link = '';
		if (($replies + 1) > $per_page)
		{
			for ($j = 0; $j < $replies + 1; $j += $per_page)
			{
				$last_post_link = $url . '-s' . $j . '.html';
			}
		}
		else
		{
			$last_post_link = $url . '.html';
		}
		return $last_post_link;
	}

	/**
	 * Replace letters to use title in URL
	 *
	 * @param	string	$title	The title to use in the URL
	 * @return	string	Title to use in URLs
	 */
	public static function title_to_url($title)
	{
		$url = mb_strtolower(censor_text(utf8_normalize_nfc(html_entity_decode(strip_tags($title)))));

		// Let's replace
		$trans = array(
			'ỡ' => 'o', 'õ'=> 'o', 'Ố'=> 'o', 'ấ'=> 'a', 'ị'=>'i', 'ầ'=> 'a', 'ả' => 'a', 'ỏ' => 'o', 'ọ' => 'o', 'ể' => 'e', 'ữ' => 'u', 'ạ'=> 'a',
			'ỹ' => 'y', 'ũ' => 'u', 'ủ' => 'u', 'α' => 'a','Ã' => 'a', 'ụ' => 'u', 'ẹ' => 'e',
			'à'=>'a','á'=>'a','ả'=>'a','ã'=>'a','ạ'=>'a',
			'ă'=>'a','ằ'=>'a','ắ'=>'a','ẳ'=>'a','ẵ'=>'a','ặ'=>'a',
			'â'=>'a','ầ'=>'a','ấ'=>'a','ẩ'=>'a','ẫ'=>'a','ậ'=>'a',
			'À'=>'a','Á'=>'a','Ả'=>'a','Ã'=>'a','Ạ'=>'a',
			'Ă'=>'a','Ằ'=>'a','Ắ'=>'a','Ẳ'=>'a','Ẵ'=>'a','Ặ'=>'a',
			'Â'=>'a','Ầ'=>'a','Ấ'=>'a','Ẩ'=>'a','Ẫ'=>'a','Ậ'=>'a',
			'đ'=>'d','Đ'=>'d',
			'è'=>'e','é'=>'e','ẻ'=>'e','ẽ'=>'e','ẹ'=>'e',
			'ê'=>'e','ề'=>'e','ế'=>'e','ể'=>'e','ễ'=>'e','ệ'=>'e',
			'È'=>'e','É'=>'e','Ẻ'=>'e','Ẽ'=>'e','Ẹ'=>'e',
			'Ê'=>'e','Ề'=>'e','Ế'=>'e','Ể'=>'e','Ễ'=>'e','Ệ'=>'e',
			'ì'=>'i','í'=>'i','ỉ'=>'i','ĩ'=>'i','ị'=>'i',
			'Ì'=>'i','Í'=>'i','Ỉ'=>'i','Ĩ'=>'i','Ị'=>'i',
			'ò'=>'o','ó'=>'o','ỏ'=>'o','õ'=>'o','ọ'=>'o',
			'ô'=>'o','ồ'=>'o','ố'=>'o','ổ'=>'o','ỗ'=>'o','ộ'=>'o',
			'ơ'=>'o','ờ'=>'o','ớ'=>'o','ở'=>'o','ỡ'=>'o','ợ'=>'o',
			'Ò'=>'o','Ó'=>'o','Ỏ'=>'o','Õ'=>'o','Ọ'=>'o',
			'Ô'=>'o','Ồ'=>'o','Ố'=>'o','Ổ'=>'o','Ỗ'=>'o','Ộ'=>'o',
			'Ơ'=>'o','Ờ'=>'o','Ớ'=>'o','Ở'=>'o','Ỡ'=>'o','Ợ'=>'o',
			'ù'=>'u','ú'=>'u','ủ'=>'u','ũ'=>'u','ụ'=>'u',
			'ư'=>'u','ừ'=>'u','ứ'=>'u','ử'=>'u','ữ'=>'u','ự'=>'u',
			'Ù'=>'u','Ú'=>'u','Ủ'=>'u','Ũ'=>'u','Ụ'=>'u',
			'Ư'=>'u','Ừ'=>'u','Ứ'=>'u','Ử'=>'u','Ữ'=>'u','Ự'=>'u',
			'ỳ'=>'y','ý'=>'y','ỷ'=>'y','ỹ'=>'y','ỵ'=>'y',
			'Y'=>'y','Ỳ'=>'y','Ý'=>'y','Ỷ'=>'y','Ỹ'=>'y','Ỵ'=>'y',
			'`' => '', '“' => '-', '”'=>'-'

		);
		$url = str_replace(array_keys($trans), $trans, $url);

		$url = preg_replace('/[^\w\d]/', '-', $url);
		$url = preg_replace('/[-]{2,}/', '-', $url);
		$url = trim($url, '-');

		$url = substr($url, 0, 50); // Max length for a title in URL
		return urlencode($url);
	}

	/**
	 * Get the topics post count or the forums post/topic count based on permissions
	 *
	 * @param $mode            string    One of topic_posts, forum_posts or forum_topics
	 * @param $data            array    Array with the topic/forum data to calculate from
	 * @param $forum_id        int        The forum id is used for permission checks
	 * @return int    Number of posts/topics the user can see in the topic/forum
	 */
	public function get_count($mode, $data, $forum_id)
	{
		if (!$this->auth->acl_get('m_approve', $forum_id))
		{
			return (int) $data[$mode . '_approved'];
		}

		return (int) $data[$mode . '_approved'] + (int) $data[$mode . '_unapproved'] + (int) $data[$mode . '_softdeleted'];
	}
}
