<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary" class="information">


    <?php if (is_tax('information_category') && get_field('category_image', get_queried_object())) : ?>
        
        <?php
            $category_colour = get_field('category_theme', get_queried_object());
            $category_image = get_field('category_image', get_queried_object());
        ?>

        <div class="information__background">
            <div class="information__background-overlay"><span class="sr-only">Overlay</span></div>
            <img alt="" src="<?php echo esc_url($category_image['url']); ?>"/>
        </div>

    <?php endif; ?>


	<div class="information__wrapper">
    
        <div class="information__items">


        <?php
            $args = array(
                'post_type' => 'information', // Adjust if using a custom post type
                'orderby' => 'title',
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'information_category',
                        'field'    => 'term_id',
                        'terms'    => get_queried_object_id(),
                    ),
                ),
                'suppress_filters' => false, // Allows filters to be applied
            );

            $query = new WP_Query( $args );

            if ( $query->have_posts() ) :
                $term = get_queried_object(); 
                $theme_colour = get_field('category_theme', $term);
            ?>

                <div class="information__items-grid">
                    <?php $animCounter = 0; ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                        $information_link = get_field('information_link');
                        $description = get_field('description');
                        $newTab = get_field('open_link_in_new_tab');
                        $overrideButtonText = get_field('override_button_text');
                    ?>
                    
                    <a class="information__items-grid-item" href="<?php echo $information_link ? $information_link : the_permalink(); ?>" <?php echo $newTab ? 'target="_blank"' : ''; ?> style="border-color: <?php echo $theme_colour; ?>;" data-aos="flip-left" data-aos-duration="1000">
                        <div class="information__items-grid-item-main">
                            <h2 class="information__items-grid-item-title" style="color: <?php echo $theme_colour; ?>;"><?php the_title(); ?></h2>
                            <div class="information__items-grid-item-excerpt" style="color: <?php echo $theme_colour; ?>;">
                            <?php echo $description ? '<p>' . $description . '</p>' : the_excerpt(); ?></div>
                        </div>
                        <?php if($information_link) : ?>
                            <span class="information__items-grid-item-text" style="background-color: <?php echo $theme_colour; ?>;"><?php echo $overrideButtonText ? $overrideButtonText : 'Download'; ?></span>
                        <?php else : ?>
                            <span class="information__items-grid-item-text" style="background-color: <?php echo $theme_colour; ?>;"><?php echo $overrideButtonText ? $overrideButtonText : 'Find out more'; ?></span>
                        <?php endif; ?>
                    </a>

                    <?php $animCounter++; ?>

                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>


        <div class="information__search">
        <div class="information__search-text">
            <h5>Can't find what you're looking for?</h5>
            <p>Search our Information Bank</p>
        </div>
        <form class="information__search-form">
            <input type="search" placeholder="Search"/>
            <button type="submit"><span class="sr-only">Search Button</span><?php load_inline_svg('search')?></button>
        </form>
        <div class="information__search-results">

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('.information__search-form');
            var searchInput = form.querySelector('input[type="search"]');
            var resultsContainer = document.querySelector('.information__search-results');
            var debounceTimer;

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                searchInformation();
            });

            // Trigger search on input change with debounce
            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {
                    searchInformation();
                }, 500); // 500ms debounce
            });


            function searchInformation() {
                var searchQuery = searchInput.value.trim();

                // If the search input is empty, clear the results and return
                if (searchQuery === '') {
                    resultsContainer.innerHTML = '';
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 400) {
                        resultsContainer.innerHTML = xhr.responseText;
                    } else {
                        console.error('Error: Could not load search results.');
                    }
                };

                xhr.onerror = function() {
                    console.error('Request failed.');
                };

                xhr.send('action=search_information&query=' + encodeURIComponent(searchQuery));
            }
        });

    </script>
	</div>
</main>

<?php get_footer(); ?>
