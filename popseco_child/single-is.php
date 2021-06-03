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
                    <h2 class="navn"></h2>
                    <p class="kortbeskrivelse"></p>


                    <section id="sektion_02">
                        <div class="row">
                            <div class="col">
                                <img src="" alt="" class="single-billede">
                            </div>
                            <div class="col">
                                <h2 class="sektion_02_h2">A taste of summer</h2>
                                <p class="beskrivelse"></p>
                                <h3 class="prissen"></h3>
                                <button class="buynow">Buy now</button>
                            </div>
                        </div>
                    </section>


                    <section id="sektion_03">
                        <div class="row">
                            <div class="col">
                                <img src="" alt="organic ice" class="billede01">
                            </div>
                            <div class="col">
                                <img src="" alt="organic ice" class="billede02">
                            </div>
                        </div>
                    </section>

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
                    document.querySelector(".single-billede").src = is.billede.guid;
                    document.querySelector(".billede01").src = is.billede01.guid;
                    document.querySelector(".billede02").src = is.billede02.guid;
                    document.querySelector(".beskrivelse").textContent = is.beskrivelse;
                    document.querySelector(".kortbeskrivelse").textContent = is.kortbeskrivelse;
                    document.querySelector(".prissen").innerHTML = is.pris;
                    //                    Dette gør sørger for at nå vi klikker på tilbage knappen kommer vi tilbage til page-product
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
