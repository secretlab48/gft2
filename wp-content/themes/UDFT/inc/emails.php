<?php


function get_service_list ( $service ) {

    $out = '<table><tbody>';

    $services = new WP_Query( array( 'post_type' => 'service', 'posts_per_page' => -1, 'tax_query' => array( 'relation' => 'OR', array( 'taxonomy' => 'service_cat', 'field' => 'slug', 'terms' => array( $service ) ) ), 'meta_key' => 'sort_number', 'orderby' => 'meta_value', 'order' => 'ASC' ) );
    foreach ( $services->posts as $service ) {
        $out .=
            '<tr><td style="padding-top:0;padding-bottom:0;"><a href="' . get_permalink( $service->ID ) . '" style="color:#23376c; font-size : 10px; line-height : 11px;">' . get_the_title( $service->ID ) . '</a></td></tr>';
    }

    $out .= '</tbody></table>';

    return $out;

}


function get_pages_list ( ) {

    $out = '<table><tbody>';

    $titles = array( 'Über uns', 'News', 'Partnerschaft', 'Karriere' );
    $pages = array();

    foreach ( $titles as $title ) {
        $pages[] = get_page_by_title( $title );
    }
    foreach ( $pages as $p ) {
        $out .=
            '<tr><td style="padding-top:0;padding-bottom:0;"><a href="' . get_permalink( $p->ID ) . '" style="color:#23376c; font-size : 10px; line-height : 11px;">' . get_the_title( $p->ID ) . '</a></td></tr>';
    }

    $out .= '</tbody></table>';

    return $out;

}


function get_email_header() {

    $ssd = get_stylesheet_directory_uri();

    $out =
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                 <html xmlns:v="urn:schemas-microsoft-com:vml" lang="en-US">
                     <head>
                         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                         <title>israel2</title>
                     </head>
                     <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="padding: 0;">
		                 <div id="wrapper" dir="ltr" style="background-color: #f7f7f7; margin: 0; padding: 70px 0 70px 0; width: 100%; -webkit-text-size-adjust: none;">';

    $out .=
        '<table width="100%" cellspacing="0" celloadding="0">
                 <tbody>
                     <tr>
                         <td style="padding:0">
                             <table style="margin:0 auto" width="600" cellspacing="0" cellpadding="0" align="center">
                                 <tbody>
                                     <tr>
                                         <td style="padding:0 0 0 0;" bgcolor="#ffffff">
                                             <table width="600" align="center" cellspacing="0" cellpadding="0">
                                                 <tbody>
                                                     <tr>
                                                         <td height="30" bgcolor="#23376c"></td>
                                                     </tr>
                                                     <tr>
                                                         <td align="center" valign="center">
                                                             <a href="' .  site_url() . '" target="_blanc"><img src="' . $ssd . '/img/emails/logo_360_140.jpg" style="vertical-align:top;" width="180"></a>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td align="center" valign="center">
                                                             <img src="' . $ssd . '/img/emails/email_bg.jpg" style="vertical-align:top;" width="600">
                                                         </td>
                                                     </tr>
                                                 </tbody>
                                             </table>
                                         </td>
                                     </tr>';


    return $out;


}




function get_email_footer() {

    $ssd = get_stylesheet_directory_uri();

    $out =
                             '<tr>
                                 <td style="padding:10px 0 10px 0;" bgcolor="#ffffff">
                                     <table width="600" align="center" cellspacing="0" cellpadding="0">
                                         <tbody>
                                             <tr>
                                                 <td width="10%" valign="top">
                                                     <a href="' .  site_url() . '" target="_blanc"><img src="' . $ssd . '/img/emails/logo_360_140.jpg" style="vertical-align:top;" width="90"></a>
                                                 </td>
                                                 <td width="30%" valign="top">
                                                     <table>
                                                         <tbody>
                                                             <tr>
                                                                 <td><span style="border-bottom:2px solid #ffed00; font-size : 15px; color : #23376c">Dienstleistungen</span></td>
                                                             </tr>
                                                             <tr>
                                                                 <td>' .
                                                                     get_service_list( 'sicherheitsdienstleistungen' ) .
                                                                 '</td>
                                                             </tr>
                                                         </tbody>
                                                     </table>                                                    
                                                 </td>
                                                 <td width="30%" valign="top">
                                                     <table>
                                                         <tbody>
                                                             <tr>
                                                                 <td><span style="border-bottom:2px solid #ffed00; font-size : 15px; color : #23376c">Technishe Lösungen</span></td>
                                                             </tr>
                                                             <tr>
                                                                 <td>' .
                                                                     get_service_list( 'sicherheitslosungen' ) .
                                                                 '</td>
                                                             </tr>
                                                         </tbody>
                                                     </table>                                                    
                                                 </td>
                                                 <td width="30%" valign="top">
                                                     <table>
                                                         <tbody>
                                                             <tr>
                                                                 <td><span style="border-bottom:2px solid #ffed00; font-size : 15px; color : #23376c">Technishe Lösungen</span></td>
                                                             </tr>
                                                             <tr>
                                                                 <td>' .
                                                                     get_pages_list() .
                                                                 '</td>
                                                             </tr>
                                                         </tbody>
                                                     </table>    
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </td>
             </tr>
         </tbody>
     </table>';


    return $out;

}




function get_email_content( $data ) {

    global $gft;

    $content = '';
    $i = 0;
    foreach( $data['data'] as $name => $value ) {
        $color = ( ( $i % 2 ) == 0 ) ? '#f4f4f4' : '#ffffff';
        $content .=
             '<tr bgcolor="' . $color . '">
                 <td width="50%" style="padding:10px 0 10px 20px;">' . $name . '</td>
                 <td width="50%" style="padding:10px 20px 10px 0">' . $value . '</td>
             </tr>';
        $i++;
    }


    $out =
        '<tr>
             <td>
                 <table width="100%" bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" style="color:#000000">
                     <tbody>
                         <tr>
                             <td align="center" style="font-size:32px;padding:15px 20px 15px 20px;">
                                 Vielen Dank für Ihre Anfrage 
                             </td>
                         </tr>
                         <tr>
                             <td align="center" style="font-size:22px;font-weight:900;padding: 0 20px 15px 20px;">
                                 Anbei erhalten Sie nochmals eine Übersicht Ihrer angebenen Date 
                             </td>
                         </tr>
                         <tr>
                             <td>
                                 <table width="100%" cellpadding="0" cellspacing="0"><tbody>' .
                                     $content .
                                 '</tbody></table>
                             </td>
                         </tr>
                         <tr>
                             <td align="center" style="font-size:22px;padding-bottom:15px;padding-top:15px;">Nach Prüfung Ihrer Daten werden wir uns umgehend mit Ihnen in Verbindung setzen</td>
                         </tr>
                         <tr>
                            <td>
                                <table width="100%" bgcolor="#f4f4f4">
                                    <tbody>
                                        <tr>
                                            <td width="50%" style="font-size:18px;font-weight:700;padding:25px 20px 15px 20px;">Adresse GFT</td>
                                            <td width="50%" style="font-size:18px;font-weight:700;padding:25px 20px 15px 20px;">Kontakt GFT</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" valign="top" style="font-size:14px;padding:0 20px 25px 20px;">
                                                Gesellschaft für Telekommunikation<br>und Alarmauswertung mbH<br> Ehrenbreitsteiner Str. 20<br>80993 München, Deutschland' .
                                            '</td>
                                             <td width="50%" valign="top" style="font-size:14px;padding:0 20px 25px 20px;">
                                                 Tel: <a href="tel:' . preg_replace( '/\s|\+|\(|\)/', '', $gft['site-phone'] ) . '">' . preg_replace( '/\+|\(|\)/', '', $gft['site-phone'] ) .'</a><br>
                                                 E-Mail: <a href="mailto:' . $gft['site-email'] . '">' . $gft['site-email'] . '</a>
                                             </td>   
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                         </tr>
                     </tbody>
                 </table>
             </td>
         </tr>';

    return $out;

}

