<div id="singleis">
    <?php
/**
 * Author:          Andrei Baicus <andrei@themeisle.com>
 * Created on:      28/08/2018
 *
 * @package Neve
 */

$container_class = apply_filters( 'neve_container_class_filter', 'container', 'single-post' );

get_header();

?>
    <div class="<?php echo esc_attr( $container_class ); ?> single-post-container">
        <section id="primary" class="content-area">
            <main id="main" class="site-main">


                <div id="tilbage_knap">
                    <button class="valgt">Tilbage</button>
                </div>
                <article class="is_article">
                    <img src="" alt="" class="billede">
                    <div class="text_div2">
                        <h2 class="navn"></h2>
                        <h2 class="prissen"></h2>
                        <p class="beskrivelse"></p>
                    </div>
                </article>
            </main>

            <script>
                let pod;

                let denvalgteis = <?php echo get_the_ID() ?>;
                const dbUrl = "http://helenajakobsen.com/02_kea/02_semester/eksamen%20/popseco/index.php/wp-json/wp/v2/is/" + denvalgteis;


                async function getJSON() {
                    const data = await fetch(dbUrl);
                    is = await data.json();
                    visIs();
                }

                function visIs() {
                    console.log(is.billede.guid);
                    document.querySelector(".navn").textContent = is.title.rendered;
                    document.querySelector(".billede").src = is.billede.guid;
                    document.querySelector(".beskrivelse").textContent = is.beskrivelse;
                    document.querySelector(".prissen").innerHTML = is.pris;
                    document.querySelector(".valgt").addEventListener("click", tilbageTilMenu);
                }

                function tilbageTilMenu() {
                    console.log("tilbageTilMenu");
                    history.back();

                }

                getJSON();

            </script>


        </section>
    </div>
</div>
<?php

get_footer();
