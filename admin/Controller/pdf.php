<?php
/**
 * @package Simple, Secure Login
 * @author John Crossley <john@suburbanarctic.com>
 * @copyright John Crossley 2012 
 * @version 2.0
 **/
if(file_exists ('../../../config/config.php')) // prevent ajax call
{
    require_once('../../../vendor/tcpdf/tcpdf_import.php');
	require('../../../config/config.php');

}
else
{
    require_once('../vendor/tcpdf/tcpdf_import.php');
	require('../config/config.php');

}

class MyTCPDF extends TCPDF {

    var $htmlHeaderR,$htmlHeaderL;

    public function setHtmlHeader($htmlHeaderL,$htmlHeaderR) {
        $this->htmlHeaderR = $htmlHeaderR;
        $this->htmlHeaderL = $htmlHeaderL;
    }

    public function Header() {
        $this->writeHTMLCell(
            $w = 90, $h = 0, $x = '', $y = $this->getY(),
            $this->htmlHeaderL, $border = 0, $ln = 0, $fill = 0,
            $reseth = true, $align = 'left', $autopadding = true);
        $this->writeHTMLCell(
            $w = 90, $h = 0, $x = '', $y = '',
            $this->htmlHeaderR, $border = 0, $ln = 1, $fill = 0,
            $reseth = true, $align = 'right', $autopadding = true);
    }

}

class pdf {

    protected $pdf;
	
	public function __construct() {
        $pdf = new MyTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	}

    public function getDossierPdf($id) {
        $pdf = new MyTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        require_once '../../Model/User.php';
        $User = new User;
        require_once '../../Model/Dossiers.php';
        $Dossiers = new Dossiers;
        require_once '../../Model/Intervention.php';
        $Intervention = new Intervention;
        $id_intervenant=$Dossiers->get("id_intervenant",$id);
        $name=$User->get("first_name", $id_intervenant)." ".$User->get("last_name", $id_intervenant);
        $title=$Dossiers->get("title",$id);
        $year=$Dossiers->get("year",$id);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('ENSP Arles');
        $pdf->SetTitle("Dossier - $title");
        $pdf->SetKeywords("TCPDF, PDF, dossier, $title, $year, $name");

        // set default header data
        //$pdf->setHtmlHeader("<span style='text-align:right;'><b>Ecole nationale supérieure de la photographie</b><br />30 av. Victor Hugo - BP 10149<br />13631 Arles, France<br />Téléphone +33 (0)4 90 99 33 33<br />www.ensp-arles.fr</span>");
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        //$pdf->SetHeaderData("../../../../assets/img/header-logo.png", PDF_HEADER_LOGO_WIDTH, "Ecole nationale supérieure de la photographie", "30 av. Victor Hugo - BP 10149\n13631 Arles, France\nTéléphone +33 (0)4 90 99 33 33\nwww.ensp-arles.fr");
        $pdf->setHtmlHeader('<img src="../../../assets/img/header-logo.png" width="250">','<div style="text-align: right; color: red;"><b>Ecole nationale supérieure de la photographie</b><br />30 av. Victor Hugo - BP 10149<br />13631 Arles, France<br />Téléphone +33 (0)4 90 99 33 33<br />www.ensp-arles.fr</div>');


        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+5, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 11, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
        $num_id="";
        if($User->get("ss", $id_intervenant)!=0)
            $num_id.="Numéro de Sécurité Sociale : ".$User->get("ss", $id_intervenant)." <br />";
        if($User->get("siret", $id_intervenant)!=0)
            $num_id.="Numéro de SIRET : ".$User->get("siret", $id_intervenant)." <br />";
        // Set some content to print
        $html = '<div style="text-align: center;"><h1>Contrat de Vacation</h1></div>
        <span style="font-size: 11px; font-weight: 500;">
<b>Visas :</b><br />
<br />
Vu la loi n°84-16 du 11 janvier 1984 modifiée portant dispositions statutaires relatives à la fonction publique de l’État ;<br />
Vu le décret n°86-83 du 17 janvier 1986 relatif aux dispositions générales applicables aux agents non titulaires de l’état ;<br />
Vu le décret n°2003-852 du 3 septembre 2003 érigeant l’Ecole Nationale Supérieure de la Photographie en Établissement Public ;<br />
Vu la délibération du Conseil d’administration de l’ENSP du 18 novembre 2016 relatif aux taux horaires applicables à tous les intervenants de l’ENSP ;<br />
<br />
<br />
Considérant que le recrutement d’un.e intervenant.e extérieur.e est nécessaire aux besoins du service pour effectuer une mission spécifique et ponctuelle à caractère discontinu, rémunérée à la vacation et après service fait,<br />
<br />
<br />
Entre les soussignés :<br />
<br />
L’Ecole  Nationale Supérieure de la  Photographie,  représentée  par  Madame Marta GILI  Directrice d’une part, <br /><br />
et<br /><br />
<b>'.$User->get("civilite", $id_intervenant).' '.$User->get("first_name", $id_intervenant).' '.$User->get("last_name", $id_intervenant).'</b>, né.e le '.implode('/',array_reverse  (explode('-',$User->get("born_date", $id_intervenant)))).' en '.$User->get("born_country", $id_intervenant).',  domicilié.e au '.$User->get("address", $id_intervenant).', '.$User->get("CP", $id_intervenant).' '.$User->get("city", $id_intervenant).' ( '.$User->get("live_country", $id_intervenant).' ) <br />
<br />
'.$num_id.'<br />
<br />
d’autre part,<br />
Il est convenu ce qui suit :<br /><br />
<b><u>Article 1er :</u><br />
'.$User->get("civilite", $id_intervenant).' '.$User->get("first_name", $id_intervenant).' '.$User->get("last_name", $id_intervenant).' </b>est engagé.e en qualité d’intervenant.e extérieur.e au titre de l’article 6 sexies de la loi N°84-16 du 11 janvier 1984 modifiée.<br /><br />
<b><u>Article 2 :</u></b><br />';
$interventions=$Intervention->getAllByDossier($id);
$price=0;
$has_a_FC=false;

foreach ($interventions as $inter) {
    $j=0;
    $hours=0;
    $title_inter="";
    $type="";
    foreach($inter as $element) {
        if($j==2)
            $title_inter=$element;
        if($j==3)
            $type=$element;
        if($j==4)
            $price+=$element;
        if($j==5)
            $hours=$element;
        if($j==8)
        {
            $cursus=$element;
            if($cursus=="Formation Continue")
                $has_a_FC=true;
        }
        $j++;
    }
    
    if($type!="Conférence") {
    $html.='<b>'.$User->get("civilite", $id_intervenant).' '.$User->get("first_name", $id_intervenant).' '.$User->get("last_name", $id_intervenant).'</b> assurera un maximum de '.$hours.' heures d’interventions portant sur '.$title_inter.' ( '.$cursus.' ) dans le cadre du programme de '.$type.' organisé par l’ENSP.<br /> <br /> 
    ';
    } else 
    {
    $html.='<b>'.$User->get("civilite", $id_intervenant).' '.$User->get("first_name", $id_intervenant).' '.$User->get("last_name", $id_intervenant).'</b> assurera son intervention portant sur '.$title_inter.' ( '.$cursus.' ) dans le cadre du programme de '.$type.' organisé par l’ENSP.<br /> <br /> 
    ';
    }
}
$html.='
L’ENSP est responsable de l’organisation générale de l’intervention. L’intervenant.e extérieur.e en accepte le processus et la finalité.<br /> 
<br /> 
L’intervenant.e extérieur.e est responsable du contenu de ses interventions et garantit notamment :<br /> 
●  qu’il.elle n’emprunte aucune oeuvre de quelque nature que ce soit, ou, dans le cas contraire, qu’il.elle le fasse sous sa pleine responsabilité au regard du code de la propriété intellectuelle ;<br /> 
●  que ses interventions ne contiennent aucun élément diffamatoire ou contraire à la loi.<br /> 
L’intervenant.e extérieur.e est tenu.e d’assurer les objets lui appartenant et justifie d’une police d’assurance garantissant sa responsabilité civile individuelle y compris dans le cadre de son intervention qui fait l’objet du présent accord.<br /> 
<br /> 
<b><u>Article 3 :</u></b> Le calendrier prévisionnel de début et de fin des interventions est le suivant :<br /> 
<br /> ';
$explication="";
foreach ($interventions as $inter) {
    $j=0;
    $date="";
    foreach($inter as $element) {
        if($j==1)
            $date=$element;
        if($j==2)
            $title_inter=$element;
        if($j==7 && $element!="")
            $explication.="● Prise en charge des frais de déplacement sur l'intervention : ".$title_inter." ( ".$date." ), sous conditions : <br />
            ".$element."<br />";
        $j++;
    }
    $html.='● '.$date.'<br />';
}
if(empty($explication))
    $explication='La rémunération fixée ci-dessus est exclusive de toute autre indemnité.<br />';
$html.='<br /><b><u>Article 4 :</u></b><br />
Pour ses interventions, <b>'.$User->get("civilite", $id_intervenant).' '.$User->get("first_name", $id_intervenant).' '.$User->get("last_name", $id_intervenant).'</b> percevra  une rémunération de '.$price.' € brut maximum, selon les tarifs fixés par délibération du Conseil d’Administration le 18 Novembre 2016.<br />
La rémunération est versée après service fait dans un délai de 60 jours.<br>
L’ENSP s’acquitte des charges patronales et salariales.<br />
<br />
<b><u>Article 5 :</u></b><br />
'.$explication.'
<br />
<b><u>Article 6 :</u></b><br />
En cas de différend sur la validité, l’interprétation ou l’exécution du présent contrat, les parties s’efforceront de le résoudre à l’amiable. A défaut, le litige sera soumis devant le Tribunal Administratif de Marseille.<br />
';
if($has_a_FC)
    $html.='
    <br /><b><u>Article 7 :</u></b><br />
L’intervenant.e extérieur.e autorise la captation, la fixation, la reproduction et la représentation au public de son image dans le cadre de la communication du projet pédagogique de l’ENSP.<br />
L’intervenant.e extérieur.e autorise toute captation audio et/ou vidéo de ses interventions par l’ENSP pour la diffusion sur son site internet dans une finalité communicationnelle excluant toute exploitation<br />
commerciale.<br />
<br />
L’intervenant.e extérieur.e cède à l’ENSP, les droits d’exploitation de ses interventions captées dans la limite légale de la durée des droits d’auteur, pour le monde entier et pour un usage numérique globalisé à des fins non-commerciales et dans un but strictement pédagogique.<br />
<br />
    
    <br />
    <b><u>Article 8 :</u></b><br />
    <b>'.$User->get("first_name", $id_intervenant).' '.$User->get("last_name", $id_intervenant).'</b> assurera ses interventions en formation continue, selon les modalités suivantes : <br/><br />
        - La commande pédagogique à réaliser par le formateur repose sur le programme de formation ci-joint.<br /><br />
        - Le formateur s\'engage à remettre un déroulement pédagogique et prévois d\'évaluer les compétences des stagiaires.<br /><br />
        - Le formateur s\'engage à prendre connaissance des fiches d\'auto positionnement et de vérifier la cohérence des prérequis avec le profil des stagiaires.<br /><br />
       	- Le formateur évalue les compétences des stagiaires selon les modalités appropriées au contenu de la formation avec une notation sur 20 (QCM, grille d\'appréciation d\'un exercice ou d\'un cas pratique)<br /><br />';
$html.='<br />
<br />
Fait à ARLES, le '.date('d/m/Y', time()).'
<br />
Marta GILI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature de l’intéressé.e<br />
Directrice&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(précédé de la mention « lu et approuvé »)<br />
</span>';
        //$html = '<span style="text-align:justify;">a <u>abc</u> abcdefghijkl (abcdef) abcdefg <b>abcdefghi</b> a ((abc)) abcd abcdef abcdefg <b>abcdefghi</b> a abc abcd abcdef abcdefg <b>abcdefghi</b> a abc abcd abcdef abcdefg <b>abcdefghi</b> a <u>abc</u> abcd abcdef abcdefg <b>abcdefghi</b> a abc \(abcd\) abcdef abcdefg <b>abcdefghi</b> a abc \\\(abcd\\\) abcdef abcdefg <b>abcdefghi</b> a abc abcd abcdef abcdefg <b>abcdefghi</b> a abc abcd abcdef abcdefg <b>abcdefghi</b> a abc abcd abcdef abcdefg abcdefghi a abc abcd <a href="http://tcpdf.org">abcdef abcdefg</a> start a abc before <span style="background-color:yellow">yellow color</span> after a abc abcd abcdef abcdefg abcdefghi a abc abcd end abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi a abc abcd abcdef abcdefg abcdefghi<br />abcd abcdef abcdefg abcdefghi<br />abcd abcde abcdef</span>';
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $first_name=$User->get('first_name', $id_intervenant);
        $last_name=$User->get('last_name', $id_intervenant);
        $pdf->Output("Dossier-$title-$first_name-$last_name.pdf", 'D');
    }

	public function __destruct(){
		
	}
}
?>