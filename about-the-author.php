<?php
/*
Plugin Name: Clemens' About the Author Plugin
Plugin URI: http://www.clemensplainer.com/plugins/about-the-author/
Description: Effizientes "About the Author Plugin" f&uuml;r Wordpress.
Version: 1.1
Author: Clemens Plainer
Author URI: http://www.clemensplainer.com

*/

function author_bio_display($content)

    {
    
    if ( is_single() || is_page () ) //Autor-Box wird nur bei Artikel und Seiten angezeigt
        {
            $description = get_the_author_meta('description'); // Der Variable $description wird die Autor-Beschreibung zugewiesen
            
            if (empty($description)) { //Wenn $description leer ist, soll ein Text angzeigt werden, der den User auffordert, eine Biographie zu speichern
                    $description == "<p></p>Keine Beschreibung.<br />
                    Schreiben Sie unter Admin-Men&uuml; --> Benutzer --> Dein Profil -->
                    Biographische Angaben etwas &uuml;ber sich selbst</p>
                    <p>Infos zum Plugin auf <a href=\"http://www.clemensplainer.com/plugins/about-the-author\">www.clemensplainer.com</a></p>";
                
            }                
        
            $author_box =   // Autor-Box wird definiert
                '<div id="author-box">'.
                    '<h3>&Uuml;ber den Author: '.get_the_author_meta('display_name').'</h3>'


                        .get_avatar( get_the_author_meta('user_email'), '80'). // Der Wert 80 steht für die Pixel-Maße des Avatar-Bildes und ist frei wählbar.


                         $description 

                .'</div>';

            return $content . $author_box;
        } else {
            return $content ;
                }

    }

function author_bio_style()  //Stylsheet (style.css) wird ausgegeben
    {
        $home = get_option('home') . "/" ;
        $path_stylesheet = $home . PLUGINDIR . "/clemens-about-the-author/style.css";
        echo '<link rel="stylesheet" href="'. $path_stylesheet . "\"" .' type="text/css" media="screen" />'."\n";
    }

add_action('the_content', 'author_bio_display'); //Autor box wird zu the_content() hinzugefügt
add_action('wp_head', 'author_bio_style'); //Stylesheet wird in wp_head() eingebunden
