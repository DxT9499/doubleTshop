<?php
namespace DxT\News\Block;
class Index extends \Magento\Framework\View\Element\Template
{
	public function __construct(\Magento\Framework\View\Element\Template\Context $context)
	{
		parent::__construct($context);
	}

    public function getNews()
	{
        $url = "https://24h.com.vn/upload/rss/thoitrang.rss";

        // $arrContextOptions=array(
        //     "ssl"=>array(
        //         "verify_peer"=>false,
        //         "verify_peer_name"=>false,
        //     ),
        // );
        $content = file_get_contents($url);
        $xml = simplexml_load_string($content);

        return $xml;
	}
    
}