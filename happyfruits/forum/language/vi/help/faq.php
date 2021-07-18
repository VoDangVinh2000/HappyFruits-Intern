<?php
/**
*
* help/faq [Vietnamese]
*
* @package language
* @version 1.76
* @copyright (c) 2006 nedka
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

/**
* DEVELOPERS PLEASE NOTE
*
* All language files should use UTF-8 as their encoding and the files must not contain a BOM.
*
* Placeholders can now contain order information, e.g. instead of
* 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
* translators to re-order the output of data while ensuring it remains correct
*
* You do not need this where single placeholders are used, e.g. 'Message %d' is fine
* equally where a string contains only two placeholders which are used to wrap text
* in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
*
* Some characters you may want to copy & paste:
* ’ » “ ” …
*/

$lang = array_merge($lang, array(
	'HELP_FAQ_ATTACHMENTS_ALLOWED_ANSWER'	=> 'Mỗi quản trị viên trong diễn đàn có thể cho phép hoặc cấm sử dụng một loại tập tin đính kèm nào đó. Nếu bạn không chắc chắn về những loại tập tin đính kèm nào được phép sử dụng, hãy liên hệ với người quản trị để được giúp đỡ.',
	'HELP_FAQ_ATTACHMENTS_ALLOWED_QUESTION'	=> 'Những loại tập tin đính kèm nào tôi được phép sử dụng trong diễn đàn?',
	'HELP_FAQ_ATTACHMENTS_OWN_ANSWER'		=> 'Để tìm danh sách các tập tin mà bạn đã đính kèm, bạn hãy chuyển đến bảng thiết lập cá nhân của mình và bấm vào liên kết trong phần tập tin đính kèm.',
	'HELP_FAQ_ATTACHMENTS_OWN_QUESTION'		=> 'Làm thế nào tôi có thể xem lại tất cả tập tin đính kèm của mình?',

	'HELP_FAQ_BLOCK_ATTACHMENTS'	=> 'Những câu hỏi về tập tin đính kèm',
	'HELP_FAQ_BLOCK_BOOKMARKS'		=> 'Những câu hỏi về chức năng đánh dấu và theo dõi chủ đề',
	'HELP_FAQ_BLOCK_FORMATTING'		=> 'Những câu hỏi về định dạng bài viết và các loại chủ đề',
	'HELP_FAQ_BLOCK_FRIENDS'		=> 'Những câu hỏi về thiết lập quan hệ bạn bè và danh sách chặn',
	'HELP_FAQ_BLOCK_GROUPS'			=> 'Những câu hỏi về cấp bậc thành viên và nhóm',
	'HELP_FAQ_BLOCK_ISSUES'			=> 'Những câu hỏi về hệ thống phpBB',
	'HELP_FAQ_BLOCK_LOGIN'			=> 'Những câu hỏi về đăng ký tài khoản và đăng nhập',
	'HELP_FAQ_BLOCK_PMS'			=> 'Những câu hỏi về tin nhắn',
	'HELP_FAQ_BLOCK_POSTING'		=> 'Những câu hỏi về chức năng gửi bài',
	'HELP_FAQ_BLOCK_SEARCH'			=> 'Những câu hỏi về chức năng tìm kiếm',
	'HELP_FAQ_BLOCK_USERSETTINGS'	=> 'Những câu hỏi về thiết lập cá nhân',

	'HELP_FAQ_BOOKMARKS_DIFFERENCE_ANSWER'		=> 'Trong phiên bản phpBB 3.0, chức năng đánh dấu chủ đề tương tự như việc bạn đánh dấu các trang web trong trình duyệt của mình. Bạn không được thông báo mỗi khi chủ đề này được cập nhật. Kể từ phiên bản phpBB 3.1, dù chỉ đánh dấu chủ đề bạn cũng có thể chọn nhận thông báo nếu chủ đề đó có bài viết mới. Chức năng theo dõi cũng tương tự như thế nhưng bạn có thể chọn theo dõi cả một chuyên mục, thay vì chỉ từng chủ đề riêng lẻ. Tùy chọn nhận thông báo khi đánh dấu hay theo dõi nội dung có thể được thay đổi từ bảng thiết lập cá nhân của bạn, tại phần “Thiết lập hệ thống”.',
	'HELP_FAQ_BOOKMARKS_DIFFERENCE_QUESTION'	=> 'Theo dõi chủ đề và đánh dấu chủ đề khác nhau như thế nào?',
	'HELP_FAQ_BOOKMARKS_FORUM_ANSWER'			=> 'Để theo dõi một chuyên mục, bạn hãy bấm vào liên kết “Theo dõi chuyên mục” ở cuối trang khi vào xem chuyên mục đó.',
	'HELP_FAQ_BOOKMARKS_FORUM_QUESTION'			=> 'Làm thế nào tôi theo dõi các chuyên mục?',
	'HELP_FAQ_BOOKMARKS_REMOVE_ANSWER'			=> 'Để ngưng việc theo dõi này, bạn hãy chuyển đến bảng thiết lập cá nhân, bấm vào liên kết đến từng đối tượng đang theo dõi và chọn tùy chọn ngừng theo dõi.',
	'HELP_FAQ_BOOKMARKS_REMOVE_QUESTION'		=> 'Làm thế nào tôi có thể ngưng việc theo dõi của mình?',
	'HELP_FAQ_BOOKMARKS_TOPIC_ANSWER'			=> 'Để đánh dấu hay theo dõi một chủ đề, tại trang chủ đề đang xem, từ trình đơn “Công cụ chủ đề” xuất hiện ở đầu và cuối trang, hãy chọn tùy chọn đánh dấu hay theo dõi chủ đề đó.<br />Nếu đánh dấu vào tùy chọn “Thông báo cho tôi khi có bài trả lời” khi đang gửi bài trong một chủ đề tức là bạn đã chọn theo dõi chủ đề đó.',
	'HELP_FAQ_BOOKMARKS_TOPIC_QUESTION'			=> 'Làm thế nào tôi đánh dấu hay theo dõi các chủ đề?',

	'HELP_FAQ_FORMATTING_ANNOUNCEMENT_ANSWER'		=> 'Thông báo thường chứa những thông tin quan trọng trong chuyên mục mà bạn đang xem và bạn nên xem qua chúng ngay khi có thể. Những thông báo luôn xuất hiện đầu mỗi trang của chuyên mục mà chúng được gửi lên. Giống như những thông báo chung, thiết lập cấp phép liên quan đến thông báo được chỉ định bởi người quản trị.',
	'HELP_FAQ_FORMATTING_ANNOUNCEMENT_QUESTION'		=> 'Thông báo là gì?',
	'HELP_FAQ_FORMATTING_BBOCDE_ANSWER'				=> 'BBCode là một dạng thức bổ sung đặc biệt của mã HTML, cho phép bạn điều khiển và định dạng tốt hơn những đối tượng liên quan trong một bài viết. Việc bạn có sử dụng BBCode được hay không là tùy vào quyết định của người quản trị. Bạn cũng có thể vô hiệu các thẻ BBCode với lựa chọn xuất hiện trong phần soạn bài viết. Bản thân BBCode tương tự gần giống như kiểu mẫu của HTML nhưng các thẻ lệnh được đóng mở bằng dấu [ và ] thay vì &lt; và &gt;. Để tìm hiểu nhiều thông tin hơn về BBCode, bạn hãy tham khảo tài liệu hướng dẫn sử dụng BBCode từ liên kết có trong trang gửi bài.',
	'HELP_FAQ_FORMATTING_BBOCDE_QUESTION'			=> 'BBCode là gì?',
	'HELP_FAQ_FORMATTING_GLOBAL_ANNOUNCE_ANSWER'	=> 'Thông báo chung chứa những thông tin quan trọng và bạn nên xem qua chúng ngay khi có thể. Những thông báo chung luôn xuất hiện đầu trang trong tất cả các chuyên mục và bên trong bảng thiết lập cá nhân của bạn. Thiết lập cấp phép liên quan đến thông báo chung được chỉ định bởi người quản trị.',
	'HELP_FAQ_FORMATTING_GLOBAL_ANNOUNCE_QUESTION'	=> 'Thông báo chung là gì?',
	'HELP_FAQ_FORMATTING_HTML_ANSWER'				=> 'Câu trả lời là không. Bạn không thể sử dụng mã HTML trong diễn đàn cũng như bất cứ đoạn mã nào gửi trả kịch bản như ngôn ngữ HTML. Hầu hết những định dạng bài viết mà bạn muốn sử dụng bằng mã HTML đều có thể dễ dàng sử dụng thay thế bằng các thẻ BBCode tương ứng.',
	'HELP_FAQ_FORMATTING_HTML_QUESTION'				=> 'Tôi có thể sử dụng mã HTML được không?',
	'HELP_FAQ_FORMATTING_ICONS_ANSWER'				=> 'Biểu tượng bài viết là những hình ảnh mà người gửi bài đã chọn đi kèm với mỗi bài viết để nhấn mạnh nội dung của những bài viết này. Việc bạn có thể sử dụng biểu tượng bài viết khi gửi bài hay không tùy thuộc vào thiết lập cấp phép của người quản trị dành cho bạn.',
	'HELP_FAQ_FORMATTING_ICONS_QUESTION'			=> 'Biểu tượng bài viết là gì?',
	'HELP_FAQ_FORMATTING_IMAGES_ANSWER'				=> 'Câu trả lời là có. Bạn có thể gửi hình ảnh vào trong bài viết của mình. Nếu người quản trị cho phép sử dụng chức năng đính kèm tập tin, bạn có thể tải ngay những hình ảnh này lên diễn đàn. Còn nếu không, bạn phải sử dụng hình ảnh liên kết đến từ một máy chủ lưu trữ khác có thể truy cập được, ví dụ như <code>http://www.example.com/my-picture.gif</code>. Bạn không thể sử dụng liên kết đến những hình ảnh được lưu trữ trong máy tính của mình nếu như nó không phải là một máy chủ có thể truy cập được. Bạn cũng không thể sử dụng liên kết đến những hình ảnh được lưu trữ yêu cầu phải xác thực mới có thể xem được, ví dụ như dịch vụ Hotmail, Yahoo! Mail… hay những website được bảo vệ bằng mật khẩu. Để hiển thị hình ảnh trong bài viết, bạn hãy sử dụng thẻ BBCode [img] trong phần soạn bài viết.',
	'HELP_FAQ_FORMATTING_IMAGES_QUESTION'			=> 'Tôi có thể gửi hình trong bài viết?',
	'HELP_FAQ_FORMATTING_LOCKED_ANSWER'				=> 'Chủ đề bị khóa là chủ đề mà các thành viên không còn có thể trả lời được và bất kì bình chọn nào trong những chủ đề này cũng sẽ tự động kết thúc. Những chủ đề như thế có thể bị khóa vì nhiều lý do khác nhau và được thực hiện bởi điều hành viên hay quản trị viên. Bạn cũng có thể tự khóa chủ đề của chính mình tùy thuộc vào thiết lập cấp phép mà bạn được chỉ định bởi người quản trị.',
	'HELP_FAQ_FORMATTING_LOCKED_QUESTION'			=> 'Chủ đề bị khóa là gì?',
	'HELP_FAQ_FORMATTING_SMILIES_ANSWER'			=> 'Biểu tượng vui là những hình ảnh nhỏ dùng để biểu thị cảm xúc hiện tại của bạn với một mã tượng trưng riêng biệt, ví dụ như :) tượng trưng cho vui trong khi :( lại tượng trưng cho buồn. Bạn có thể xem toàn bộ biểu tượng vui được phép sử dụng bằng cách bấm vào liên kết <em>Xem toàn bộ</em> tại phần chọn biểu tượng vui. Việc bạn lạm dụng chèn quá nhiều biểu tượng vui trong bài viết sẽ làm cho bài viết đó ít người đọc đi và người điều hành có thể sẽ phải sửa lại chúng hay nghiêm khắc hơn là xóa bài viết đó đi. Người quản trị cũng có thể giới hạn số lượng hình biểu tượng vui mà bạn có thể sử dụng trong mỗi bài viết.',
	'HELP_FAQ_FORMATTING_SMILIES_QUESTION'			=> 'Biểu tượng vui là gì?',
	'HELP_FAQ_FORMATTING_STICKIES_ANSWER'			=> 'Chú ý luôn xuất hiện sau các thông báo bên trong chuyên mục và chỉ hiển thị trong trang đầu tiên. Các chú ý cũng thường có một vài thông tin quan trọng vì thế bạn cũng nên đọc chúng ngay khi có thể. Giống như các thông báo, thiết lập cấp phép liên quan đến chú ý được chỉ định bởi người quản trị.',
	'HELP_FAQ_FORMATTING_STICKIES_QUESTION'			=> 'Chú ý là gì?',

	'HELP_FAQ_FRIENDS_BASIC_ANSWER'		=> 'Bạn có thể sử dụng những danh sách này để tổ chức quản lí các người dùng khác trong hệ thống. Những người dùng được thêm vào trong danh sách bạn bè sẽ được liệt kê trong bảng thiết lập cá nhân của bạn để bạn có thể biết nhanh trạng thái trực tuyến của họ và gửi tin nhắn. Nếu giao diện hỗ trợ, các bài viết từ những thành viên này đều được tô sáng nổi bật. Nếu bạn thêm một người dùng vào danh sách chặn của mình thì bất kì bài viết nào của họ theo mặc định trong hệ thống sẽ ẩn đi đối với bạn.',
	'HELP_FAQ_FRIENDS_BASIC_QUESTION'	=> 'Danh sách bạn bè và danh sách chặn là gì?',
	'HELP_FAQ_FRIENDS_MANAGE_ANSWER'	=> 'Bạn có thể thêm người khác vào danh sách của mình theo hai cách. Trong mỗi trang thông tin cá nhân của họ, có một liên kết để bạn thêm vào danh sách bạn bè hay chặn của mình. Ngoài ra, trong bảng thiết lập cá nhân của mình, bạn có thể thêm trực tiếp bằng cách nhập vào tên tài khoản của họ. Bạn cũng có thể gỡ bỏ người khác ra khỏi danh sách của mình ngay tại trang này.',
	'HELP_FAQ_FRIENDS_MANAGE_QUESTION'	=> 'Làm thế nào tôi có thể thêm/gỡ bỏ ai đó trong danh sách bạn bè hay chặn của mình?',

	'HELP_FAQ_GROUPS_ADMINISTRATORS_ANSWER'		=> 'Quản trị viên là những thành viên có quyền hạn cao nhất trong việc điều khiển toàn bộ mọi hoạt động của hệ thống. Những thành viên này có thể điều khiển tất cả các chức năng của hệ thống, bao gồm: thiết lập cấp phép, cấm thành viên, tạo nhóm hay các điều hành viên… tùy thuộc vào thiết lập cấp phép của người sáng lập dành cho các quản trị viên này. Họ cũng có đầy đủ quyền hạn của điều hành viên trong tất cả các chuyên mục và cũng tùy thuộc vào thiết lập cấp phép của người sáng lập.',
	'HELP_FAQ_GROUPS_ADMINISTRATORS_QUESTION'	=> 'Quản trị viên là ai?',
	'HELP_FAQ_GROUPS_COLORS_ANSWER'				=> 'Điều này xảy ra bởi vì người quản trị đã chỉ định một màu sắc khác nhau cho tất cả các thành viên trong mỗi nhóm để mọi người dễ dàng biết được những thành viên nào thuộc nhóm này.',
	'HELP_FAQ_GROUPS_COLORS_QUESTION'			=> 'Tại sao một vài nhóm xuất hiện với màu sắc khác nhau?',
	'HELP_FAQ_GROUPS_DEFAULT_ANSWER'			=> 'Nếu bạn là thành viên của nhiều nhóm khác nhau, nhóm mặc định của bạn sẽ được sử dụng để quyết định màu nhóm và danh hiệu của nhóm nào được hiển thị như thông tin cá nhân mặc định của bạn. Người quản trị có thể chỉ định thiết lập cấp phép cho bạn được quyền thay đổi nhóm mặc định của mình từ bảng thiết lập cá nhân của bạn.',
	'HELP_FAQ_GROUPS_DEFAULT_QUESTION'			=> '“Nhóm mặc định” là gì?',
	'HELP_FAQ_GROUPS_MODERATORS_ANSWER'			=> 'Điều hành viên là những cá nhân thành viên riêng lẻ hay nhóm gồm nhiều thành viên có nhiệm vụ quản lí thường xuyên hoạt động của các chuyên mục mỗi ngày. Họ có quyền sửa hay xóa các bài viết và khóa, mở khóa, di chuyển, xóa hay di chuyển các chủ đề trong chuyên mục mà họ quản lí. Thông thường, các quản trị viên có thể ngăn cản một vài thành viên cố ý gửi những bài viết vi phạm nội qui của diễn đàn hay câu bài, gửi những bài nhảm nhí, có nội dung thiếu văn hóa…',
	'HELP_FAQ_GROUPS_MODERATORS_QUESTION'		=> 'Điều hành viên là ai?',
	'HELP_FAQ_GROUPS_TEAM_ANSWER'				=> 'Trang này cung cấp cho bạn một danh sách về những người điều hành diễn đàn, bao gồm cả các quản trị viên và điều hành viên với những thông tin chi tiết khác về các chuyên mục mà họ quản lí.',
	'HELP_FAQ_GROUPS_TEAM_QUESTION'				=> 'Liên kết “Ban điều hành” là gì?',
	'HELP_FAQ_GROUPS_USERGROUPS_ANSWER'			=> 'Nhóm là tổ chức gồm nhiều thành viên nhằm phân chia cộng đồng thành nhiều khu vực quản lí khác nhau để các quản trị viên có thể làm việc dễ dàng với họ. Mỗi thành viên có thể tham gia vào nhiều nhóm khác nhau và mỗi nhóm có thể được chỉ định thiết lập cấp phép riêng biệt. Điều này tạo thuận lợi cho các quản trị viên có thể thay đổi thiết lập cấp phép cho nhiều thành viên chỉ một lần, ví dụ như thay đổi thiết lập cấp phép của điều hành viên hay cho phép những thành viên nào được truy cập vào một chuyên mục cá nhân.',
	'HELP_FAQ_GROUPS_USERGROUPS_JOIN_ANSWER'	=> 'Bạn có thể xem thông tin của tất cả các nhóm bằng cách bấm vào liên kết “Nhóm” bên trong bảng thiết lập cá nhân của bạn. Nếu bạn muốn tham gia vào một nhóm nào đó, hãy bấm vào nút yêu cầu thích hợp. Tuy nhiên, không phải tất cả các nhóm đều cho phép tự do tham gia vào. Một vài nhóm yêu cầu việc tham gia vào nhóm của bạn phải được chấp thuận bởi trưởng nhóm, một số khác thì đã cố định và thậm chí có một số nhóm ẩn cả tư cách thành viên đối với bạn. Nếu là nhóm tự do, bạn hãy tham gia bằng cách bấm vào nút yêu cầu thích hợp. Nếu nhóm yêu cầu việc tham gia của bạn phải được chấp thuận bởi trưởng nhóm, bạn hãy gửi yêu cầu tham gia cũng bằng cách bấm vào nút yêu cầu thích hợp. Trưởng nhóm sẽ cần phải chấp thuận yêu cầu tham gia của bạn và có thể sẽ hỏi bạn lý do vì sao bạn muốn tham gia vào nhóm của họ. Vì thế, xin bạn đừng quấy rầy trưởng nhóm nếu họ từ chối yêu cầu tham gia của bạn bởi vì họ có lý do của riêng mình.',
	'HELP_FAQ_GROUPS_USERGROUPS_JOIN_QUESTION'	=> 'Thông tin về nhóm nằm ở đâu và làm sao để tôi tham gia vào một nhóm?',
	'HELP_FAQ_GROUPS_USERGROUPS_LEAD_ANSWER'	=> 'Trưởng nhóm thông thường được chỉ định khi nhóm này được tạo ra ban đầu bởi quản trị viên. Nếu bạn muốn tạo ra một nhóm mới do mình đảm nhiệm, việc đầu tiên bạn làm là hãy liên hệ với người quản trị bằng cách gửi tin nhắn cá nhân.',
	'HELP_FAQ_GROUPS_USERGROUPS_LEAD_QUESTION'	=> 'Làm sao để tôi có cơ hội trở thành trưởng nhóm?',
	'HELP_FAQ_GROUPS_USERGROUPS_QUESTION'		=> 'Nhóm là gì?',

	'HELP_FAQ_ISSUES_ADMIN_ANSWER'			=> 'Tất cả người dùng trên hệ thống có thể vào trang “Liên hệ” để thực hiện việc này, nếu nó được người quản trị cho phép sử dụng.<br />Ngoài ra, nếu bạn đã đăng ký thành viên có thể sử dụng liên kết “Ban điều hành”.',
	'HELP_FAQ_ISSUES_ADMIN_QUESTION'		=> 'Làm thế nào tôi có thể liên hệ người quản trị?',
	'HELP_FAQ_ISSUES_FEATURE_ANSWER'		=> 'Chương trình này được phát triển và thuộc bản quyền của <em>công ty phpBB</em>. Nếu bạn cảm thấy một chức năng mới cần được thêm vào, hãy vui lòng ghé thăm <a href="https://www.phpbb.com/ideas/">trang ý tưởng</a> của phpBB, nơi mà bạn có thể bình chọn cho những ý tưởng đang được đề xuất hoặc đề nghị thêm chức năng mới.',
	'HELP_FAQ_ISSUES_FEATURE_QUESTION'		=> 'Tại sao hệ thống không có những chức năng khác?',
	'HELP_FAQ_ISSUES_LEGAL_ANSWER'			=> 'Bất kì người quản trị nào được liệt kê trong trang “Ban điều hành” đều là người thích hợp cho bạn cần liên hệ hay gửi các thắc mắc của mình. Nếu như việc liên hệ này không có phản hồi nào, bạn nên liên hệ với người quản lí tên miền này bằng cách thực hiện <a href="http://www.google.com/search?q=whois">tra cứu trên miền</a> hoặc nếu website này đang chạy trên một dịch vụ lưu trữ Web miễn phí như Yahoo!, free.fr, f2s.com… thì bạn hãy thử liên hệ với người quản lí hay bộ phận giải quyết các vi phạm của dịch vụ đó. Bạn cần lưu ý rằng <em>công ty phpBB</em> hoàn toàn <strong>không liên quan và không chịu trách nhiệm</strong> đến bất kì vấn đề nào xảy ra trong website này ở bất kì đâu và với bất kì ai sử dụng chương trình này. Sẽ hoàn toàn vô nghĩa nếu bạn tìm cách liên hệ với <em>công ty phpBB</em> về các vấn đề liên quan đến pháp luật, các trách nhiệm pháp lý, những bài viết nói xấu lẫn nhau… nếu nó <strong>không liên quan trực tiếp</strong> đến website phpBB.com hoặc những chương trình riêng biệt của chính phpBB. Nếu bạn gửi email cho <em>công ty phpBB</em> về <strong>bất kì vấn đề nào phát sinh từ bên thứ ba</strong> trong việc sử dụng chương trình này của người dùng cuối thì có thể bạn sẽ nhận được một hồi âm ngắn gọn hoặc không có sự phản hồi nào.',
	'HELP_FAQ_ISSUES_LEGAL_QUESTION'		=> 'Tôi phải liên hệ với ai về việc lạm dụng và vi phạm pháp luật liên quan đến website này?',
	'HELP_FAQ_ISSUES_WHOIS_PHPBB_ANSWER'	=> 'Chương trình này với những chức năng ban đầu của nó đã được phát triển, phát hành và thuộc bản quyền của <a href="https://www.phpbb.com/">công ty phpBB</a>. Nó được phát hành dưới những điều khoản sử dụng của giấy phép <em>GNU General Public License</em>, phiên bản 2 (GPL-2.0) và được phép tự do phân phối lại. Ghé thăm <a href="https://www.phpbb.com/about/">trang giới thiệu phpBB</a> để tìm hiểu thêm thông tin.',
	'HELP_FAQ_ISSUES_WHOIS_PHPBB_QUESTION'	=> 'Ai đã viết và phát triển hệ thống này?',

	'HELP_FAQ_LOGIN_AUTO_LOGOUT_ANSWER'				=> 'Nếu bạn không đánh dấu chọn vào lựa chọn <em>Đăng nhập tự động</em> khi bạn đăng nhập, hệ thống sẽ chỉ cho phép bạn đăng nhập vào trong thời điểm hiện tại. Điều này sẽ giúp ngăn cản việc lạm dụng tài khoản của bạn bởi một ai đó. Để vẫn luôn trong trạng thái đã đăng nhập, hãy đánh dấu vào lựa chọn trên một lần trong khi đăng nhập. Điều này không được khuyến cáo sử dụng nếu bạn đang truy nhập vào hệ thống từ một máy tính dùng chung, ví dụ như trong thư viện, tiệm Internet, phòng vi tính trong trường học. Nếu bạn không nhìn thấy lựa chọn trên thì có nghĩa là người quản trị đã vô hiệu chức năng này.',
	'HELP_FAQ_LOGIN_AUTO_LOGOUT_QUESTION'			=> 'Tại sao tôi thường xuyên bị thoát ra khỏi hệ thống?',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANSWER'			=> 'Có một vài lý do dẫn đến việc này. Trước tiên, hãy chắc chắn rằng tên tài khoản và mật khẩu của bạn đã nhập vào chính xác. Nếu bạn đã nhập chính xác mà vẫn không thể đăng nhập được, hãy liên hệ với người quản trị để chắc chắn rằng bạn không bị cấm tham gia. Cũng có thể, người quản lí website đã cấu hình sai hệ thống ở một chỗ nào đó và họ cần bạn thông báo để biết mà tiến hành khắc phục.',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANYMORE_ANSWER'	=> 'Có thể người quản trị đã ngưng kích hoạt hoặc xóa tài khoản của bạn ra khỏi hệ thống vì một vài lý do nào đó. Thông thường, một vài diễn đàn sẽ xóa định kỳ các tài khoản không hoạt động trong một thời gian dài để giảm bớt dung lượng của cơ sở dữ liệu trong hệ thống. Nếu đúng như thế, bạn hãy cố gắng đăng ký trở lại và tham gia thảo luận nhiệt tình hơn với mọi người.',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANYMORE_QUESTION'	=> 'Tôi đã từng đăng ký trước đây nhưng bây giờ không thể đăng nhập được nữa!',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_QUESTION'			=> 'Tại sao tôi không thể đăng nhập được?',
	'HELP_FAQ_LOGIN_CANNOT_REGISTER_ANSWER'			=> 'Có thể người quản lí website đã cấm địa chỉ IP của bạn hoặc không cho phép sử dụng tên tài khoản mà bạn đang định sử dụng để đăng ký mới. Cũng có thể người quản lí website đã cho tạm ngưng đăng ký mới bằng cách vô hiệu chức năng này trong hệ thống vì một lý do nào đó. Bạn hãy liên hệ với người quản trị để được giúp đỡ.',
	'HELP_FAQ_LOGIN_CANNOT_REGISTER_QUESTION'		=> 'Tại sao tôi không thể đăng ký tài khoản?',
	'HELP_FAQ_LOGIN_COPPA_ANSWER'					=> 'COPPA là tên viết tắt từ <strong>Child Online Privacy and Protection Act</strong>. Đây là một luật lệ ban hành vào năm 1998 trong hệ thống pháp luật của Mỹ. Luật lệ này yêu cầu các website có những hoạt động thu thập thông tin từ trẻ vị thành niên dưới 13 tuổi phải được sự đồng ý của cha mẹ hay người bảo hộ của chúng hoặc sử dụng một vài biện pháp khác từ hệ thống kiến thức bảo hộ pháp luật trong việc cho phép thu thập những thông tin cá nhân có thể nhận biết từ một trẻ vị thành niên dưới 13 tuổi. Nếu bạn chắc chắn rằng mình hay một vài người khác thuộc diện qui định trong điều khoản này hoặc website mà bạn đang đăng ký thành viên có áp dụng điều khoản này, bạn hãy liên hệ với các luật sư tư vấn pháp lý để tìm kiếm sự giúp đỡ. Lưu ý rằng công ty phpBB không thể đưa ra cho bạn bất kì một lời khuyên nào về pháp luật và cũng đừng liên hệ với chúng tôi về những vấn đề này ngoại trừ một vài nguyên tắc chung bên dưới.',
	'HELP_FAQ_LOGIN_COPPA_QUESTION'					=> 'Điều khoản COPPA là gì?',
	'HELP_FAQ_LOGIN_DELETE_COOKIES_ANSWER'			=> 'Thao tác này sẽ xóa tất cả các cookie được tạo ra bởi hệ thống phpBB trên máy tính của bạn. Việc tạo ra các cookie này là nhằm giữ cho việc xác thực và đăng nhập vào hệ thống của bạn luôn ở trong trạng thái sẵn sàng đồng thời nó cũng đi kèm với một vài chức năng khác từ hệ thống như việc đánh dấu những chủ đề/bài viết đã xem nếu thiết lập này được thiết lập bởi người quản trị. Nếu bạn gặp rắc rối trong quá trình đăng nhập hay thoát khỏi hệ thống, việc xóa cookie này có thể sẽ giúp bạn thoát khỏi rắc rối đó.',
	'HELP_FAQ_LOGIN_DELETE_COOKIES_QUESTION'		=> 'Liên kết “Xóa hết cookie” có tác dụng gì?',
	'HELP_FAQ_LOGIN_LOST_PASSWORD_ANSWER'			=> 'Đừng lo lắng! Tuy mật khẩu của bạn không thể phục hồi lại được nhưng có thể được tạo lại dễ dàng. Trong trang đăng nhập, bạn hãy bấm vào liên kết <em>Quên mật khẩu</em>. Hãy làm theo hướng dẫn của công cụ này và bạn sẽ có thể đăng nhập trở lại vào hệ thống một cách nhanh chóng.',
	'HELP_FAQ_LOGIN_LOST_PASSWORD_QUESTION'			=> 'Tôi đã quên mật khẩu của mình!',
	'HELP_FAQ_LOGIN_REGISTER_ANSWER'				=> 'Bạn có thể không cần phải làm như thế nhưng đôi khi bạn cần phải đăng ký mới có thể gửi bài trong diễn đàn, tùy theo yêu cầu của người quản trị. Tuy nhiên, việc đăng ký làm thành viên sẽ giúp bạn sử dụng được hết tất cả các chức năng mà hệ thống chỉ dành cho những ai đã đăng ký và không dành cho khách sử dụng, ví dụ như hình đại diện, gửi tin nhắn, gửi email đến các người dùng khác, tham gia vào các nhóm… Bạn chỉ mất vài phút để hoàn tất việc đăng ký, vì vậy hãy đăng ký làm thành viên của chúng tôi.',
	'HELP_FAQ_LOGIN_REGISTER_CONFIRM_ANSWER'		=> 'Trước tiên, hãy kiểm tra tên tài khoản và mật khẩu của bạn. Nếu tất cả đều chính xác thì có thể bạn rơi vào một trong hai trường hợp sau: Nếu yêu cầu COPPA được bật trong hệ thống và bạn đã xác định mình dưới 13 tuổi khi đăng ký thành viên thì bạn cần phải làm theo những hướng dẫn đã được gửi sau đó. Nếu bạn không rơi vào trường hợp trên thì có thể tài khoản của bạn chưa được kích hoạt. Một vài diễn đàn bắt buộc tài khoản phải được kích hoạt sau khi đăng ký thành công, có thể bạn được yêu cầu tự làm việc này hoặc chờ người quản trị kích hoạt trước khi bạn có thể đăng nhập vào hệ thống. Khi bạn đăng ký thành công, bạn sẽ được thông báo có phải kích hoạt tài khoản của mình hay không. Nếu bạn nhận được một email yêu cầu kích hoạt thì hãy làm theo hướng dẫn trong đó. Nếu bạn không nhận được email nào, có thể bạn đã cung cấp sai địa chỉ email của mình khi đăng ký hoặc địa chỉ email này bị chặn bởi các công cụ quét thư rác. Lý do của việc bắt buộc phải kích hoạt tài khoản này là để hạn chế sự lạm dụng của một vài người muốn quấy phá hệ thống. Nếu bạn chắc chắn mình đã nhập đúng địa chỉ email, hãy cố gắng liên hệ với người quản trị.',
	'HELP_FAQ_LOGIN_REGISTER_CONFIRM_QUESTION'		=> 'Tôi đã đăng ký nhưng không thể đăng nhập được',
	'HELP_FAQ_LOGIN_REGISTER_QUESTION'				=> 'Tại sao tôi cần phải đăng ký tài khoản?',

	'HELP_FAQ_PMS_CANNOT_SEND_ANSWER'	=> 'Có ba lý do cho việc này: Bạn chưa đăng ký làm thành viên hoặc đã là thành viên nhưng chưa đăng nhập vào hệ thống, quản trị viên đã tắt chức năng gửi tin nhắn trong hệ thống hoặc đã không cho phép bạn sử dụng chức năng gửi tin nhắn trong hệ thống. Bạn có thể liên hệ với người quản trị để biết thêm thông tin chi tiết.',
	'HELP_FAQ_PMS_CANNOT_SEND_QUESTION'	=> 'Tôi không thể gửi tin nhắn được!',
	'HELP_FAQ_PMS_SPAM_ANSWER'			=> 'Chúng tôi thật sự xin lỗi bạn khi nghe điều này. Chức năng gửi email từ hệ thống này đã cố gắng bảo vệ và kiểm tra những thành viên khi gửi email giống như khi họ gửi bài. Bạn nên gửi email đến người quản trị với bản sao toàn bộ của email quấy phá mà bạn nhận được. Điều quan trọng là nhớ đính kèm cả tiêu đề email có chứa thông tin chi tiết về thành viên đã gửi email cho bạn. Quản trị viên sẽ có hành động cụ thể để xử lí việc này.',
	'HELP_FAQ_PMS_SPAM_QUESTION'		=> 'Tài khoản email của tôi toàn nhận được thư rác từ một ai đó trong hệ thống!',
	'HELP_FAQ_PMS_UNWANTED_ANSWER'		=> 'Bạn có thể thiết lập tự động xóa tin nhắn từ một người dùng bằng cách sử dụng thiết lập nội qui tin nhắn trong bảng thiết lập cá nhân. Nếu bạn nhận được những tin nhắn lừa đảo, xâm phạm tính riêng tư, xúc phạm đến danh dự của mình từ một thành viên nào đó, bạn hãy báo cáo tin nhắn đó cho người điều hành biết bởi vì họ có quyền hạn ngăn cản một thành viên có thể gửi tin nhắn.',
	'HELP_FAQ_PMS_UNWANTED_QUESTION'	=> 'Tôi nhận được những tin nhắn không mong muốn!',

	'HELP_FAQ_POSTING_BUMP_ANSWER'					=> 'Bằng cách bấm vào liên kết “Đẩy chủ đề lên” khi bạn đang xem chủ đề đó, bạn có thể “đẩy” chủ đề đó lên đầu danh sách hiển thị trong chuyên mục tại trang đầu tiên. Tuy nhiên, nếu bạn không nhìn thấy liên kết này thì có nghĩa là chức năng đẩy chủ đề đã bị vô hiệu hoặc quãng thời gian giới hạn giữa hai lần “đẩy” chưa hết. Bạn cũng có thể “đẩy” chủ đề lên trên danh sách thật dễ dàng bằng việc trả lời chủ đề này. Tuy nhiên, hãy chắc chắn rằng nội qui của diễn đàn cho phép làm điều đó.',
	'HELP_FAQ_POSTING_BUMP_QUESTION'				=> 'Làm sao để tôi có thể đẩy chủ đề của mình lên trên danh sách chuyên mục?',
	'HELP_FAQ_POSTING_CREATE_ANSWER'				=> 'Để tạo một chủ đề mới trong chuyên mục, bạn hãy bấm vào nút “Chủ đề mới”. Tương tự, bấm vào nút “Trả lời” để gửi bài trả lời trong một chủ đề. Bạn có thể được yêu cầu phải đăng nhập trước khi gửi bài. Những chức năng của công cụ gửi bài mà bạn có thể sử dụng được liệt kê cuối mỗi trang xem chuyên mục hay trang xem chủ đề. Ví dụ như: <em>Bạn có thể tạo chủ đề mới trong chuyên mục này, Bạn có thể tham gia bình chọn trong chuyên mục này…</em>',
	'HELP_FAQ_POSTING_CREATE_QUESTION'				=> 'Làm sao để tôi tạo chủ đề mới hay gửi bài trả lời?',
	'HELP_FAQ_POSTING_DRAFT_ANSWER'					=> 'Đây là chức năng cho phép bạn lưu lại những đoạn nội dung mà mình đang soạn dang dở để hoàn tất và gửi đi lúc khác. Để nạp lại những nội dung đã lưu này, bạn hãy chuyển đến bảng thiết lập cá nhân của mình.',
	'HELP_FAQ_POSTING_DRAFT_QUESTION'				=> 'Nút “Lưu” trong phần gửi bài có tác dụng gì?',
	'HELP_FAQ_POSTING_EDIT_DELETE_ANSWER'			=> 'Nếu bạn không phải là quản trị viên hay điều hành viên, bạn chỉ có thể sửa hay xóa những bài viết của chính mình mà thôi. Bạn có thể sửa một bài viết bằng cách bấm vào nút sửa bài trong bài viết tương ứng, thỉnh thoảng bạn có thể bị hạn chế thời gian sửa bài sau khi gửi bài viết. Nếu có một ai đó đã trả lời bài viết này, khi quay lại xem chủ đề, bạn sẽ thấy một dòng chữ bên dưới bài viết hiển thị tổng số lần mà bạn đã sửa cùng với ngày giờ sửa. Dòng chữ này chỉ xuất hiện nếu có một ai đó trả lời bài viết và nó sẽ không xuất hiện nếu như các quản trị viên hay điều hành viên sửa bài viết này. Có thể họ sẽ để lại một ghi chú nêu rõ lý do vì sao sửa bài viết của bạn theo quan điểm của họ. Bạn cũng cần lưu ý rằng những người dùng bình thường sẽ không được phép xóa một bài viết đã được trả lời dù rằng đó là bài viết của họ.',
	'HELP_FAQ_POSTING_EDIT_DELETE_QUESTION'			=> 'Làm sao để tôi sửa hay xóa một bài viết?',
	'HELP_FAQ_POSTING_FORUM_RESTRICTED_ANSWER'		=> 'Một vài chuyên mục có thể bị giới hạn chỉ dành cho một vài thành viên hay nhóm nhất định. Để có thể nhìn thấy chúng hiển thị, xem, gửi bài… bạn cần phải được thiết lập cấp phép đặc biệt. Vì thế, bạn hãy liên hệ với điều hành viên hay quản trị viên để yêu cầu họ cho phép bạn truy cập vào.',
	'HELP_FAQ_POSTING_FORUM_RESTRICTED_QUESTION'	=> 'Tại sao tôi không thể truy cập vào một chuyên mục?',
	'HELP_FAQ_POSTING_NO_ATTACHMENTS_ANSWER'		=> 'Thiết lập cấp phép có thể đính kèm tập tin được chỉ định cho mỗi một chuyên mục, mỗi một nhóm hay cá nhân mỗi thành viên. Quản trị viên có thể đã không cho phép đính kèm tập tin trong chuyên mục mà bạn đang gửi bài hoặc có lẽ chỉ có một vài nhóm nhất định mới được phép đính kèm tập tin. Hãy liên hệ với người quản trị nếu bạn không chắc chắn lý do tại sao mình không thể đính kèm tập tin.',
	'HELP_FAQ_POSTING_NO_ATTACHMENTS_QUESTION'		=> 'Tại sao tôi không thể đính kèm tập tin?',
	'HELP_FAQ_POSTING_POLL_ADD_ANSWER'				=> 'Số lượng đối tượng bình chọn tối đa bạn có thể tạo được thiết lập bởi quản trị viên. Nếu bạn cảm thấy rằng bấy nhiêu đối tượng bình chọn đó vẫn chưa đủ cho bình chọn cần tạo của mình, bạn có thể liên hệ với người quản trị về việc này.',
	'HELP_FAQ_POSTING_POLL_ADD_QUESTION'			=> 'Tại sao tôi không thể thêm vào nhiều hơn nữa số lượng đối tượng bình chọn?',
	'HELP_FAQ_POSTING_POLL_CREATE_ANSWER'			=> 'Khi bạn đang tạo một chủ đề mới hoặc đang sửa bài viết đầu tiên của một chủ đề, nếu bạn được cấp phép tạo bình chọn, bạn sẽ nhìn thấy phần “Tạo bình chọn” bên dưới phần soạn thảo nội dung bài viết. Nếu bạn không nhìn thấy phần này thì có nghĩa là bạn không được cấp phép để tạo bình chọn. Bạn phải nhập tiêu đề cho bình chọn trong phần “Câu hỏi bình chọn” và ít nhất là hai đối tượng bình chọn với mỗi đối tượng xác định trên một dòng trong khung văn bản. Bạn cũng có thể thiếp lập tổng số đối tượng bình chọn mà thành viên có thể lựa chọn trong phần “Lựa chọn tối đa của mỗi người dùng”, giới hạn thời gian tham gia bình chọn (nhập số <strong>0</strong> cho bình chọn không giới hạn thời gian) và cho phép người bình chọn có thể thay đổi lại lựa chọn khác khi đã tham gia vào bình chọn rồi.',
	'HELP_FAQ_POSTING_POLL_CREATE_QUESTION'			=> 'Làm sao để tôi tạo một bình chọn?',
	'HELP_FAQ_POSTING_POLL_EDIT_ANSWER'				=> 'Giống như những bài viết, các bình chọn chỉ có thể được sửa bởi chính người tạo ra nó, điều hành viên hay quản trị viên. Để sửa một bình chọn, trước hết bạn hãy bấm vào nút sửa bài ứng với bài viết đầu tiên của chủ đề có bình chọn đi kèm muốn sửa. Nếu chưa có ai tham gia bình chọn, bạn có thể xóa bình chọn này hoặc sửa đổi bất kì đối tượng bình chọn nào. Tuy nhiên, nếu bình chọn đã có người tham gia rồi thì chỉ có điều hành viên hoặc quản trị viên mới có quyền sửa hay xóa nó. Điều này nhằm để ngăn cản một vài người muốn thay đổi tính khách quan của một bình chọn bằng cách thay đổi những đối tượng bình chọn đã được người khác bình chọn.',
	'HELP_FAQ_POSTING_POLL_EDIT_QUESTION'			=> 'Làm sao để tôi sửa hay xóa một bình chọn?',
	'HELP_FAQ_POSTING_QUEUE_ANSWER'					=> 'Người quản trị có thể quyết định những chuyên mục nào khi có bài gửi mới cần phải được kiểm duyệt nội dung trước khi đăng lên bài viết đó. Cũng có thể người quản trị đã đặt bạn vào một nhóm cần phải được xét duyệt nội dung bài viết trước khi gửi. Bạn hãy liên hệ với người quản trị để biết thêm thông tin.',
	'HELP_FAQ_POSTING_QUEUE_QUESTION'				=> 'Tại sao bài viết của tôi cần phải được duyệt?',
	'HELP_FAQ_POSTING_REPORT_ANSWER'				=> 'Nếu người quản trị cho phép bạn sử dụng chức năng này, hãy chuyển đến bài viết mà bạn muốn báo cáo và bạn sẽ nhìn thấy một nút bấm dành cho việc báo cáo bài viết. Bấm vào nút này, bạn sẽ được hướng dẫn từng bước để hoàn tất việc báo cáo bài viết của mình.',
	'HELP_FAQ_POSTING_REPORT_QUESTION'				=> 'Làm sao tôi có thể báo cáo bài viết đến người điều hành?',
	'HELP_FAQ_POSTING_SIGNATURE_ANSWER'				=> 'Để đính kèm chữ ký cá nhân sau mỗi bài viết của mình, trước tiên, bạn cần phải tạo chữ ký này trong bảng thiết lập cá nhân của bạn. Sau khi tạo, bạn hãy đánh dấu vào ô lựa chọn <em>Đính kèm chữ ký cá nhân (Có thể thay đổi trong phần thiết lập cá nhân)</em> dưới phần soạn nội dung bài viết mỗi khi gửi bài để thêm vào chữ ký cá nhân của mình. Bạn cũng có thể thiết lập mặc định tự động chèn chữ ký cá nhân này đến tất cả bài viết của mình bằng cách chọn <samp>Có</samp> trong lựa chọn <em>Luôn đính kèm chữ ký cá nhân của tôi</em> trong phần thiết lập cá nhân của bạn. Cho dù đã chọn như thế, bạn vẫn có thể quyết định không đính kèm chữ ký này trong một số bài viết riêng lẻ bằng việc bỏ dấu chọn trong lựa chọn <em>Đính kèm chữ ký cá nhân (Chữ ký có thể thay đổi từ phần thiết lập cá nhân)</em> dưới phần soạn nội dung bài viết mỗi khi gửi bài sau này.',
	'HELP_FAQ_POSTING_SIGNATURE_QUESTION'			=> 'Làm sao để tôi đính kèm chữ ký cá nhân sau mỗi bài viết của mình?',
	'HELP_FAQ_POSTING_WARNING_ANSWER'				=> 'Mỗi quản trị viên có những qui định riêng dành cho website của mình. Nếu bạn vi phạm một trong những nội qui của họ, bạn có thể sẽ nhận được một cảnh cáo. Bạn cần lưu ý rằng đây là quyết định của chính người quản trị tại diễn đàn mà bạn tham gia và công ty phpBB không có liên quan gì trong việc đưa ra những cảnh cáo này. Hãy liên hệ với người quản trị nếu bạn không chắc chắn lý do tại sao mình lại nhận được một cảnh cáo.',
	'HELP_FAQ_POSTING_WARNING_QUESTION'				=> 'Tại sao tôi lại nhận được một cảnh cáo?',

	'HELP_FAQ_SEARCH_BLANK_ANSWER'			=> 'Việc tìm kiếm của bạn có quá nhiều kết quả dẫn đến hao tổn tài nguyên của máy chủ. Bạn hãy vui lòng sử dụng chức năng “Tìm kiếm nâng cao”, xác định càng nhiều điều kiện tìm kiếm và những chuyên mục nào thực sự cần tìm bên trong càng tốt.',
	'HELP_FAQ_SEARCH_BLANK_QUESTION'		=> 'Tại sao tìm kiếm của tôi lại hiện ra một trang trắng?',
	'HELP_FAQ_SEARCH_FORUM_ANSWER'			=> 'Nhập vào từ khóa bạn cần tìm trong khung tìm kiếm xuất hiện trên trang chủ, trang xem chuyên mục hoặc trang xem chủ đề. Để sử dụng chức năng tìm kiếm nâng cao, bạn hãy bấm vào liên kết “Tìm kiếm nâng cao” luôn xuất hiện đầu mỗi trang trong hệ thống. Cách thức truy cập vào công cụ tìm kiếm còn có thể phụ thuộc vào giao diện bạn đang sử dụng.',
	'HELP_FAQ_SEARCH_FORUM_QUESTION'		=> 'Làm thế nào tôi có thể tìm kiếm một hay nhiều chuyên mục?',
	'HELP_FAQ_SEARCH_MEMBERS_ANSWER'		=> 'Bạn hãy chuyển đến trang “Thành viên” và bấm vào liên kết “Tìm một thành viên”.',
	'HELP_FAQ_SEARCH_MEMBERS_QUESTION'		=> 'Làm thế nào tôi có thể tìm kiếm các thành viên?',
	'HELP_FAQ_SEARCH_NO_RESULT_ANSWER'		=> 'Việc tìm kiếm của bạn quá chung chung và đính kèm nhiều điều kiện tìm kiếm phổ biến nên không được lập chỉ mục tìm kiếm bởi hệ thống phpBB. Bạn hãy vui lòng xác định nhiều tìm kiện tìm kiếm và sử dụng những tùy chọn có thể trong trang tìm kiếm nâng cao.',
	'HELP_FAQ_SEARCH_NO_RESULT_QUESTION'	=> 'Tại sao tìm kiếm của tôi không có kết quả?',
	'HELP_FAQ_SEARCH_OWN_ANSWER'			=> 'Bạn có thể xem lại các bài viết của mình từ 3 liên kết sau: “Bài viết của bạn” trong bảng thiết lập cá nhân, “Tìm các bài viết của thành viên” tại chính trang thông tin cá nhân của mình hoặc “Tiện ích” từ trình đơn có ở đầu mỗi trang. Để xem lại danh sách chủ đề mình đã tạo, hãy sử dụng chức năng tìm kiếm nâng cao và điền vào các tùy chọn tìm kiếm thích hợp.',
	'HELP_FAQ_SEARCH_OWN_QUESTION'			=> 'Làm thế nào tôi có thể xem lại các chủ đề và bài viết của mình?',

	'HELP_FAQ_USERSETTINGS_AVATAR_ANSWER'				=> 'Có hai hình ảnh có thể được hiển thị kèm theo tên tài khoản trong phần xem bài viết. Một trong hai hình có thể là hình ảnh thể hiện danh hiệu hiện tại của bạn. Thông thường, chúng là những hình ngôi sao hay hình khối hiển thị tùy thuộc vào số lượng bài viết mà bạn đã gửi hay trạng thái, vị trí, chức vụ… của bạn trong hệ thống. Hình còn lại, thường lớn hơn, được gọi là hình đại diện. Đây là những hình ảnh thể hiện cá tính và phong cách riêng của mỗi thành viên.',
	'HELP_FAQ_USERSETTINGS_AVATAR_DISPLAY_ANSWER'		=> 'Từ bảng thiết lập cá nhân của mình, tại phần “Thông tin cá nhân”, bạn có thể tạo cho mình một hình đại diện bằng 1 trong 4 cách sau: chọn hình có sẵn trên hệ thống, liên kết từ một địa chỉ URL khác, tải lên từ máy tính của bạn hoặc sử dụng dịch vụ Gravatar. Điều này còn tùy thuộc vào người quản trị có cho phép sử dụng hình đại diện hay không và sử dụng theo cách nào. Nếu không thể sử dụng hình đại diện, bạn hãy liên hệ với người quản trị.',
	'HELP_FAQ_USERSETTINGS_AVATAR_DISPLAY_QUESTION'		=> 'Làm sao để tôi chọn cho mình một hình đại diện?',
	'HELP_FAQ_USERSETTINGS_AVATAR_QUESTION'	=> 'Hình ảnh đi kèm tên tài khoản của tôi là gì?',
	'HELP_FAQ_USERSETTINGS_CHANGE_SETTINGS_ANSWER'		=> 'Nếu bạn đã đăng ký tài khoản, tất cả thiết lập cá nhân của bạn đều được lưu giữ trong cơ sở dữ liệu của hệ thống. Để thay đổi chúng, bạn hãy truy cập vào bảng thiết lập cá nhân của mình. Liên kết này thường hiện ra ở đầu mỗi trang. Bảng điều khiển này cũng sẽ giúp bạn thay đổi tất cả thiết lập và thông tin cá nhân của mình.',
	'HELP_FAQ_USERSETTINGS_CHANGE_SETTINGS_QUESTION'	=> 'Làm sao để tôi thay đổi thiết lập cá nhân của mình?',
	'HELP_FAQ_USERSETTINGS_EMAIL_LOGIN_ANSWER'			=> 'Chỉ có những ai đã đăng ký mới được phép gửi email đến các thành viên khác trong hệ thống từ công cụ gửi email và chỉ khi người quản trị đã kích hoạt công cụ này. Điều này nhằm để ngăn cản những kẻ quấy phá ẩn danh dùng công cụ gửi email của hệ thống để gây rối.',
	'HELP_FAQ_USERSETTINGS_EMAIL_LOGIN_QUESTION'		=> 'Khi tôi bấm vào liên kết email của một thành viên, tôi được yêu cầu phải đăng nhập!',
	'HELP_FAQ_USERSETTINGS_HIDE_ONLINE_ANSWER'			=> 'Trong bảng thiết lập cá nhân của mình, tại phần “Thiết lập hệ thống”, bạn hãy tìm đến lựa chọn <em>Luôn ẩn trạng thái trực tuyến của tôi</em>. Nếu bạn chọn <samp>Có</samp>, bạn sẽ chỉ xuất hiện trực tuyến đối với các quản trị viên, các điều hành viên hoặc với chính mình. Bạn sẽ được tính như là một thành viên ẩn.',
	'HELP_FAQ_USERSETTINGS_HIDE_ONLINE_QUESTION'		=> 'Làm sao để tên tài khoản của tôi không xuất hiện trong danh sách các thành viên trực tuyến?',
	'HELP_FAQ_USERSETTINGS_LANGUAGE_ANSWER'				=> 'Có thể quản trị viên chưa cài đặt ngôn ngữ mà bạn dùng vào hệ thống hay đơn giản là chưa từng có ai phiên dịch hệ thống này sang ngôn ngữ của bạn. Hãy cố gắng yêu cầu người quản trị cài đặt ngôn ngữ của bạn vào hệ thống nếu nó có sẵn. Nếu chưa có, bạn có thể đề nghị cùng tham gia phiên dịch hệ thống sang ngôn ngữ của bạn. Bạn có thể tìm hiểu thêm thông tin về các ngôn ngữ cho hệ thống này tại website của công ty <a href="https://www.phpbb.com/">phpBB</a>&reg;.',
	'HELP_FAQ_USERSETTINGS_LANGUAGE_QUESTION'			=> 'Ngôn ngữ của tôi không có trong danh sách hỗ trợ!',
	'HELP_FAQ_USERSETTINGS_RANK_ANSWER'					=> 'Danh hiệu xuất hiện bên dưới tên tài khoản của bạn, tượng trưng cho số lượng bài viết mà bạn đã gửi hoặc dùng để xác định một vài tài khoản người dùng đặc biệt, ví dụ như điều hành viên và quản trị viên. Thông thường, bạn không thể thay đổi trực tiếp danh hiệu của mình ở bất cứ diễn đàn nào mà quản trị viên đã thiết lập cho bạn. Xin bạn đừng lạm dụng việc gửi nhiều bài viết vô ích và nhảm nhí để mong tăng danh hiệu thành viên của mình. Hầu hết mọi diễn đàn sẽ không khoan dung cho việc làm này và đơn giản là các quản trị viên hay điều hành viên chỉ cần hạ thấp số lượng bài viết của bạn xuống.',
	'HELP_FAQ_USERSETTINGS_RANK_QUESTION'				=> 'Danh hiệu là gì và làm sao tôi có thể thay đổi danh hiệu của mình?',
	'HELP_FAQ_USERSETTINGS_SERVERTIME_ANSWER'			=> 'Nếu bạn chắc chắn đã thiết lập múi giờ chính xác mà thời gian vẫn chạy sai thì có thể giờ trên máy chủ đã chạy không chính xác. Người quản trị sẽ cần phải chỉnh sửa lại điều này nếu như bạn thông báo sớm cho họ biết.',
	'HELP_FAQ_USERSETTINGS_SERVERTIME_QUESTION'			=> 'Tôi đã thay đổi múi giờ nhưng thời gian vẫn chạy sai!',
	'HELP_FAQ_USERSETTINGS_TIMEZONE_ANSWER'				=> 'Nếu được thiết lập, thời gian có thể được hiển thị với một múi giờ khác múi giờ tại nơi bạn đang sống. Nếu rơi vào trường hợp này, bạn nên thay đổi lại múi giờ cho phù hợp trong bảng thiết lập cá nhân của mình theo từng khu vực xác định, ví dụ như <em>London, Paris, New York, Sydney…</em> Bạn cũng cần lưu ý rằng thiết lập thay đổi lại múi giờ cũng như hầu hết những thiết lập cá nhân khác, chỉ dành cho những ai đã đăng ký. Vì thế, nếu bạn vẫn chưa đăng ký làm thành viên của chúng tôi thì đây là thời điểm thích hợp cho bạn thực hiện điều này!',
	'HELP_FAQ_USERSETTINGS_TIMEZONE_QUESTION'			=> 'Thời gian trên hệ thống chạy không chính xác!',
));
