<?php

// Set timeout
set_time_limit(10000);

// Inculde thư viện PHPCrawl
include("libs/PHPCrawler.class.php");
include("simple_html_dom.php");


// Extend the class PHPCrawler and cài đè phương thức handleDocumentInfo()
class MyCrawler extends PHPCrawler 
{
	// Các bạn cài đè phương thức handleDocumentInfo() để xử lý tất cả các thông tin thu tập được.
  function handleDocumentInfo(PHPCrawlerDocumentInfo $DocInfo) 
  {

    // Lấy toàn bộ url của website
    echo "Page requested: ".$DocInfo->url."</br>";
    
	// lấy file html từ các links crawler được.
	$html = file_get_html($DocInfo->url);

	if(is_object($html)){
		
		// Trả về đối tượng nếu tìm được, hoặc null nếu không.
	    $t = $html->find("href", 0);
	    if($t){
		  $title = $t->innertext;
	    }
	  
	    echo "href: ".$title."</br></br></br>";
	    $html->clear(); 
	    unset($html);
	}
	
    flush();
  } 
}

// Tạo đối tượng crawler và bắt đầu tiến trình thu thập dữ liệu

$crawler = new MyCrawler();

// set URL mà ta muốn crawler
$crawler->setURL("http://ivhunter.com/");

// Chỉ lấy các file mà nội dung là "text/html"
$crawler->addContentTypeReceiveRule("#text/html#");

// Một bộ lọc cho phép ta không lấy các link ảnh, css hoặc javascript
$crawler->addURLFilterRule("#(jpg|gif|png|pdf|jpeg|svg|css|js)$# i");

// Trong quá trình crawler, lưu trữ và gửi cookie giống như ta vào bằng trinh duyệt
$crawler->enableCookieHandling(true);

// Thiết lập dung lượng(bytes) thu thập được trong quá trình crawler
$crawler->setTrafficLimit(1000 * 1024);

// Nào, chạy thôi, hehe, :))
$crawler->go();

// Sau khi quá trình crawler kết thúc, ghi lại báo cáo!!

$report = $crawler->getProcessReport();

if (PHP_SAPI == "cli") $lb = "\n";
else $lb = "<br />";
    
echo "Summary:".$lb;
echo "Links followed: ".$report->links_followed.$lb;
echo "Documents received: ".$report->files_received.$lb;
echo "Bytes received: ".$report->bytes_received." bytes".$lb;
echo "Process runtime: ".$report->process_runtime." sec".$lb; 
?>