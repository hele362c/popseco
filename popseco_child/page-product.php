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
        </head>
        <h1 class="overskrift">THE FREEZERS</h1>
        <template>
            <article>
                <img src="" alt="" class="billede">
                <h2 class="isensnavn"></h2>
                <h3 class="pris"></h3>
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
                                <img src="http://helenajakobsen.com/02_kea/02_semester/eksamen%20/popseco/wp-content/themes/popseco_child/billeder/is.png" alt="is">
                            </div>
                            <div class="col">
                                <h2 class="overskriftto">Get a mixed box</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A debitis amet blanditiis saepe laborum, dolorum! Fuga excepturi odio officiis quia iusto, voluptatem tempora cum, non repellendus ipsam tempore odit ex.</p>
                                <button class="buynow_mixbox">Buy now</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="second_section">
                    <div class="section_wrapper">
                        <div class="row">
                            <div class="col">
                                <img src="http://helenajakobsen.com/02_kea/02_semester/eksamen%20/popseco/wp-content/themes/popseco_child/billeder/image01.png" alt="ikke det rigtige billede">
                            </div>
                            <div class="col">
                                <img src="http://helenajakobsen.com/02_kea/02_semester/eksamen%20/popseco/wp-content/themes/popseco_child/billeder/image2.png" alt="ikke det rigtige billede ">
                            </div>
                        </div>
                        <div class="row">
                            <img src="http://helenajakobsen.com/02_kea/02_semester/eksamen%20/popseco/wp-content/themes/popseco_child/billeder/image3.png" alt="ikke det rigtige billede">
                        </div>
                    </div>

                </section>


            </main>



            <script>
                let isene;
                let categories;
                let filterIs = "alle";

                const dbUrl = "http://helenajakobsen.com/02_kea/02_semester/eksamen%20/popseco/index.php/wp-json/wp/v2/is?per_page=100";

                const catUrl = "http://helenajakobsen.com/02_kea/02_semester/eksamen%20/popseco/index.php/wp-json/wp/v2/categories";

                async function getJSON() {
                    const data = await fetch(dbUrl);
                    const catdata = await fetch(catUrl);

                    isene = await data.json();
                    categories = await catdata.json();

                    console.log(categories);
                    visIsene();
                    opretKnapper();
                }

                function opretKnapper() {
                    categories.forEach(cat => {
                        document.querySelector("#filtrering").innerHTML += `<button class="filter" data-is="${cat.id}">${cat.name}</button>`
                    })
                    addEventListenersToButtons();
                };

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
