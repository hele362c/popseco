<div id="produktside">
    <?php
/**
 * The template for displaying all pages.
 *
 * @package Neve
 * @since   1.0.0
 */
$container_class = apply_filters( 'neve_container_class_filter', 'container', 'single-page' );

get_header();

?>
    <div class="<?php echo esc_attr( $container_class ); ?> single-page-container">

        <head>
            <meta name="robots" content="noindex">
        </head>
        <h1 class="overskrift">THE FREEZERS</h1>
        <template>
            <article>
                <!--               div'en med class'en indeholder det der skal vises i vores "billede med hover tekst effekt"-->

                <div class="image">
                    <img src="" alt="" class="billede">

                    <div class="overlay">
                        <h2 class="isensnavn"></h2>
                        <h3 class="pris"></h3>
                    </div>
                </div>

            </article>
        </template>

        <section id="primary" class="content-area">
            <main id="main" class="site-main">

                <nav id="filtrering">
                    <button class="filter" data-is="alle">all</button>
                </nav>

                <section class="iscontainer"></section>

                <section id="first_section">
                    <h1 class="overskrift">OUR SELECTION</h1>
                    <div class="section_wrapper">
                        <div class="row">
                            <div class="col">
                                <img src="http://helenajakobsen.com/02_kea/02_semester/eksamen%20/popseco/wp-content/themes/popseco_child/billeder/is.png" alt="vegan ice cream">
                            </div>
                            <div class="col">
                                <h2 class="overskriftto">Get a mixed box</h2>
                                <p>Buy a pack of 10 organic freezer pops then there is a taste for everyone and one each. The package consists of</p>
                                <ul>
                                    <li> 4 x Strawberry / Elderflower</li>
                                    <li> 2 x Apple / Ginger</li>
                                    <li> 2 x Blackcurrant / Vanilla</li>
                                    <li> 2 x Passion fruit</li>
                                </ul>
                                <h3 class="box_pris">50 kr.</h3>
                                <button class="buynow_mixbox">Buy now</button>
                            </div>
                        </div>
                    </div>
                </section>
            </main>



            <script>
                let isene;
                let categories;
                let filterIs = "alle";

                //En globale konstante variabler, der hiver fat i vores genererede data fra wp rest API
                const dbUrl = "http://helenajakobsen.com/02_kea/02_semester/eksamen%20/popseco/index.php/wp-json/wp/v2/is";
                const catUrl = "http://helenajakobsen.com/02_kea/02_semester/eksamen%20/popseco/index.php/wp-json/wp/v2/categories";

                //her henter vi vores data fra wp rest api ind på sitet.
                async function getJSON() {
                    const data = await fetch(dbUrl);
                    const catdata = await fetch(catUrl);
                    //fylder vi vores data med json
                    isene = await data.json();
                    categories = await catdata.json();

                    // fremviser arrayet i consolen.
                    console.log(categories);
                    visIsene();
                    opretKnapper();
                }

                //Her oprettes knapperne til filteringen menuen via et forEach tag
                function opretKnapper() {
                    categories.forEach(cat => {
                        document.querySelector("#filtrering").innerHTML += `<button class="filter" data-is="${cat.id}">${cat.name}</button>`
                    })
                    addEventListenersToButtons();
                };



                //hver gang der klikkes på en knap bliver der filtret
                function addEventListenersToButtons() {
                    document.querySelectorAll("#filtrering button").forEach(elm => {
                        elm.addEventListener("click", filtrering);
                    })
                };

                function filtrering() {
                    filterIs = this.dataset.is;
                    console.log(filterIs);

                    visIsene();
                }




                //her køre vi et for.each is der er - køre den de klonet template tages i gennem og til sidst henter Domen for at
                function visIsene() {
                    console.log(isene);
                    let temp = document.querySelector("template");
                    let container = document.querySelector(".iscontainer");
                    container.innerHTML = "";
                    isene.forEach(is => {
                        if (filterIs == "alle" || is.categories.includes(parseInt(filterIs))) {
                            let klon = temp.cloneNode(true).content;
                            klon.querySelector(".billede").src = is.billede.guid;
                            klon.querySelector(".isensnavn").textContent = is.title.rendered;
                            klon.querySelector(".pris").innerHTML = is.pris;


                            klon.querySelector("article").addEventListener("click", () => {
                                location.href = is.link;
                            })
                            container.appendChild(klon);
                        }
                    })

                }
                getJSON();

            </script>

        </section>
    </div>
</div>
<?php get_footer(); ?>
