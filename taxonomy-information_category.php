<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary" class="information">
	<div class="information__wrapper">
        
        <div class="information__nav">
        <?php
            // Get all custom taxonomy terms
            $categoryTerms = get_terms(array(
                'taxonomy' => 'information_category',
                'hide_empty' => true,
            ));

            if ( !empty( $categoryTerms ) && !is_wp_error( $categoryTerms ) ) : ?>
                <div class="information__nav-grid">
                    <?php foreach ( $categoryTerms as $categoryTerm ) : 
                        $category_theme = get_field('category_theme', 'information_category_' . $categoryTerm->term_id);
                        $category_image = get_field('category_image', 'information_category_' . $categoryTerm->term_id);
                    ?>

                    <?php 
                        $currentCategory = get_queried_object();
                        $currentCategoryName = $currentCategory->name;
                    ?>

                
                            <a href="<?php echo esc_url( get_term_link( $categoryTerm ) ); ?>" class="information__nav-grid-item <?php echo $currentCategoryName === $categoryTerm->name ? 'active' : ''; ?>" style="background-color: <?php echo $category_theme; ?>; border: 2px solid <?php echo $category_theme; ?>; color: <?php echo $category_theme; ?>;">

                                <h2 class="information__nav-grid-item-title" style="color: <?php echo $category_theme; ?>;"><?php echo esc_html( $categoryTerm->name ); ?></h2>

                            </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p><?php esc_html_e( 'No information categories found.', 'text-domain' ); ?></p>
            <?php endif; ?>

        </div>
        <div class="information__items">
            <?php if ( have_posts() ) :
                $term = get_queried_object(); 
                // Retrieve the custom field value for the 'theme_colour' from the term object
                $theme_colour = get_field('category_theme', $term);
            ?>
                <div class="information__items-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                        $information_link = get_field('information_link');
                        $newTab = get_field('open_link_in_new_tab');
                        $overrideButtonText = get_field('override_button_text');
                    ?>

                    
                    <a class="information__items-grid-item" href="<?php echo $information_link ? $information_link : the_permalink(); ?>" <?php echo $newTab ? 'target="_blank"' : ''; ?>>
                        <div class="information__items-grid-item-main" style="background-color: <?php echo $theme_colour; ?>;">
                            <h2 class="information__items-grid-item-title"><?php the_title(); ?></h2>
                            <div class="information__items-grid-item-excerpt"><?php the_excerpt(); ?></div>
                        </div>
                        <?php if($information_link) : ?>
                            <span class="information__items-grid-item-text" style="color: <?php echo $theme_colour; ?>;"><?php echo $overrideButtonText ? $overrideButtonText : 'Download'; ?></span>
                        <?php else : ?>
                            <span class="information__items-grid-item-text" style="color: <?php echo $theme_colour; ?>;"><?php echo $overrideButtonText ? $overrideButtonText : 'Find out more'; ?></span>
                        <?php endif; ?>
                    </a>

                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>


        <div class="information__search">
        <div class="information__search-text">
            <h3>Can't find what you're looking for?</h3>
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
