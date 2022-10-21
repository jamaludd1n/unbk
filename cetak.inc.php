<?php 
require_once('plugins/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
/**
* 
*/
class Cetak extends Dompdf
{
	public $is_download = false;
	public $title;

	public function __construct($title, $is_download){
		parent::__construct();
		$this->is_download = $is_download;
		$this->title = $title;
	}

	public function _loadHtml($html){
		$html_ 	  = "<style type='text/css'>
                    table{
                      margin:0 auto;
                      border-collapse:collapse;
                    }
                    .table tbody tr td, .table tbody tr th {
                      padding: 10px;
                      border-top: 1px solid #eee;
                      border-bottom: 1px solid #eee; }

                    .table tbody tr.primary td, .table tbody tr.primary th {
                      background-color: #1f91f3;
                      color: #fff; }

                    .table tbody tr.success td, .table tbody tr.success th {
                      background-color: #2b982b;
                      color: #fff; }

                    .table tbody tr.info td, .table tbody tr.info th {
                      background-color: #00b0e4;
                      color: #fff; }

                    .table tbody tr.warning td, .table tbody tr.warning th {
                      background-color: #ff9600;
                      color: #fff; }

                    .table tbody tr.danger td, .table tbody tr.danger th {
                      background-color: #fb483a;
                      color: #fff; }

                    .table thead tr th {
                      padding: 10px;
                      border-bottom: 1px solid #eee; }

                    .table-bordered {
                      border-top: 1px solid #eee; }
                      .table-bordered tbody tr td, .table-bordered tbody tr th {
                        padding: 10px;
                        border: 1px solid #eee; }
                      .table-bordered thead tr th {
                        padding: 10px;
                        border: 1px solid #eee; }
                          </style>";
		$html_ .= $html;
		return $this->loadHtml($html_);
	}

	public function ok(){
		if($this->is_download === TRUE){
			return $this->stream($this->title, ["Attachment" => "attachment"]);
		}else{
			return $this->stream($this->title, ["Attachment" => "inline"]);
		}
	}
}

?>