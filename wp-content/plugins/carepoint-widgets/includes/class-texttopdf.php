<?php

if(!class_exists('carepointTextToPDF'))
{

// Include the ttpdf class
require_once(CPT_PLUGIN_DIR . 'assets/php/tcpdf/tcpdf.php');

class carepointTextToPDF
{

	private $post_id;
	private $post_title;
	private $post_content;
	private $pdf;

	public function __construct()
	{
		
		add_action( 'init', array( $this, 'cpttpdf_add_rewrites' ) );
		register_activation_hook( __FILE__, array( $this, 'cpttpdf_rewrite_activation' ));
		add_filter( 'query_vars', array( $this, 'cpttpdf_rewrite_add_var' ));
		add_action( 'template_redirect', array( $this, 'cpttpdf_catch_form' ));

	}

	public function cpttpdf_add_rewrites()
	{
		add_rewrite_rule(
			'^cp_ttpdf/?([0-9]*)/([a-z0-9]*)/?$',
			'index.php?cp_ttpdf_post_id=$matches[1]&cp_ttpdf_nonce=$matches[2]',
			'top'
		);
	}

	public function cpttpdf_rewrite_activation()
	{
		$this->cpttpdf_add_rewrites();
		flush_rewrite_rules();
	}

	public function cpttpdf_rewrite_add_var( $vars )
	{
	    $vars[] = 'cp_ttpdf_post_id';
	    $vars[] = 'cp_ttpdf_nonce';
	    return $vars;
	}

	public function cpttpdf_catch_form()
	{

		if( get_query_var('cp_ttpdf_post_id')  && wp_verify_nonce( get_query_var('cp_ttpdf_nonce'), "cp_ttpdf_nonce"))
		{

	   		$this->get_post_content();
	   		$this->setup_pdf();
		}

	}

	/**
	 * 
	 * get_post_content gets the post from the $_GET param post_id
	 * 
	 */
	
	public function get_post_content()
	{
		//echo "get_post_content";
		$the_post = get_post(get_query_var('cp_ttpdf_post_id'));

		//print_r($the_post);
		
		define('POST_URL', get_permalink ($the_post->ID));
		
		$this->post_id = $the_post->ID;
		$this->post_title = $the_post->post_title;
		$this->post_content = $the_post->post_content;
	}

	public function setup_pdf()
	{
		//echo "setup_pdf";
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Havering Carepoint');
		$pdf->SetTitle($this->post_title);
		$pdf->SetSubject($this->post_title);

		// set default header data
	 	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '');

		// // set header and footer fonts
		// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// // set default monospaced font
		// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// // set image scale factor
		// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// // set font
		// $pdf->SetFont('dejavusans', '', 10);

		// add a page
		$pdf->AddPage();

		// output the HTML content
		$html = '<h1>'.$this->post_title.'</h1>'.apply_filters('the_content', $this->post_content);

		$html .= '<br/><small>This PDF was downloaded from: <a href="'.get_permalink($this->post_id).'">'.get_permalink($this->post_id).'</a></small>';

		if(get_field('nhs_choices', $this->post_id) != ""):
		$html .= '<style> 
		.nhs-choices-label{
		float: left;
		display: block;
		padding: 5px;
		margin-bottom: 20px;
		border: 3px solid #DFDFDF;}
		</style>
		<table class="nhs-choices-label">
			<tr>
				<td>
					<small>This article is sourced from:</small>
					<img src="'.get_bloginfo("template_url").'/library/images/nhs-choices-logo.jpg" alt="NHS Choices">
				</td>
			</tr>
		</table>';
		endif;


		$pdf->writeHTML($html, true, false, true, false, '');

		// reset pointer to the last page
		$pdf->lastPage();

		//Close and output PDF document
		$pdf->Output($this->post_title.'.pdf', 'I');
	}

}

// Extend the TCPDF class to create custom Header
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = CPT_PLUGIN_DIR.'assets/images/carepoint-logo.png';
        $this->SetFont('helvetica', 'B', 8);
		$this->Cell(0, 40, '', 'B', false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Image($image_file, 15, 10, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

    public function Footer()
    {
		// Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Footer link
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 'T', false, 'L', 0, '', 0, false, 'T', 'M');
    }

}

/**
 * cp_ttpdf instaiates the carepointTextToPDF class
 * 	
 * @return PDF of the current post
 */

$carepointTextToPDF = new carepointTextToPDF;


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
	//$link = admin_url('admin-ajax.php?action=cp_ttpdf&post_id='.$post_id.'&nonce='.$nonce);
	$link = site_url('/cp_ttpdf/'.$post_id.'/'.$nonce);
	echo '<li><a class="cp_ttpdf_button tooltip" target="blank" title="Download article to PDF" href="' . $link . '"><i class="fa fa-file-pdf-o"></i></a></li>';
}

}




