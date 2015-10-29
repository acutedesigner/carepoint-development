<?php

if(!class_exists('carepointTextToPDF'))
{

class carepointTextToPDF
{

	private $post_title;
	private $post_content;
	private $pdf;

	public function __construct()
	{
		if ( !wp_verify_nonce( $_REQUEST['nonce'], "cp_ttpdf_nonce"))
		{
			// NOTE! Want this to go to 404 error page
			exit("No naughty business please");
		}

		// Include the ttpdf class
		require_once(CPT_PLUGIN_DIR . 'assets/tcpdf/tcpdf.php');

   		$this->get_post_content();
   		$this->setup_pdf();
	}

	/**
	 * 
	 * get_post_content gets the post from the $_GET param post_id
	 * 
	 */
	
	public function get_post_content()
	{
		//echo "get_post_content";
		$the_post = get_post($_REQUEST['post_id']);

		//print_r($the_post);

		$this->post_title = $the_post->post_title;
		$this->post_content = $the_post->post_content;
	}

	public function setup_pdf()
	{
		//echo "setup_pdf";
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle($this->post_title);
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// // set default header data
		// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

		// // set header and footer fonts
		// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// // set default monospaced font
		// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// // set margins
		// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// // set auto page breaks
		// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// // set image scale factor
		// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// // set font
		// $pdf->SetFont('dejavusans', '', 10);

		// add a page
		$pdf->AddPage();

		// output the HTML content
		$pdf->writeHTML('<h1>'.$this->post_title.'</h1>'.$this->post_content, true, false, true, false, '');

		// reset pointer to the last page
		$pdf->lastPage();

		//Close and output PDF document
		$pdf->Output('example_006.pdf', 'I');
	}

}

/**
 * cp_ttpdf instaiates the carepointTextToPDF class
 * 	
 * @return PDF of the current post
 */

function cp_ttpdf()
{
	$carepointTextToPDF = new carepointTextToPDF;
}

add_action("wp_ajax_cp_ttpdf", "cp_ttpdf");


/**
 *
 *	This function loads a button into the single.php template
 *	ready for user interact to download a PDF.
 *
 * 	@param int $post_id ID of the current post
 * 
 */

function cp_ttpdf_button($post_id)
{
	$nonce = wp_create_nonce("cp_ttpdf_nonce");
	$link = admin_url('admin-ajax.php?action=cp_ttpdf&post_id='.$post_id.'&nonce='.$nonce);
	echo '<li><a class="cp_ttpdf_button tooltip" target="blank" title="Download article to PDF" href="' . $link . '"><i class="fa fa-file-pdf-o"></i></a></li>';
}

}




