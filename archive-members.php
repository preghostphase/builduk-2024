<?php get_header(); ?>
<?php get_template_part('templates/parts/banner'); ?>

<main id="primary" class="members">

    <div class="members__wrapper">

    <div class="members__filters" style="display: none;">
        <div class="members__filters-form">
            <form method="GET" id="filter-form">

            <div class="members__filters-form-categories">

                <?php
                $member_terms = get_terms([
                    'taxonomy' => 'members_category',
                    'hide_empty' => false,
                ]);

                foreach ($member_terms as $member_term) : ?>

                <label>
                    <input type="checkbox" name="members_category[]" value="<?php echo $member_term->slug; ?>"
                    <?php if(isset($_GET['members_category']) && in_array($member_term->slug, $_GET['members_category'])) echo 'checked'; ?>/>
                    <span class="checkmark"></span>
                    <?php echo $member_term->name; ?>
                </label>

                <?php endforeach; ?>

                </div>

                <div class="members__filters-form-buttons">

                <button class="button" type="submit" id="filter-button">Filter</button>
                <button class="button" type="button" id="reset-button">Reset</button>

                </div>

            </form>
        </div>

        <div class="members__filters-results" id="members-results">

            <div id="filter-info" class="members__filters-results-info">
                Showing all members
            </div>

            <?php
            // Display all members initially
            $args = array(
                'post_type'      => 'members',
                'posts_per_page' => -1,
            );

            $loop = new WP_Query($args);

            ?>
           <?php if ($loop->have_posts()) : ?>
                <?php while ($loop->have_posts()) : ?>
                    <?php 
                        $loop->the_post(); 
                        $member_logo = get_field('member_logo');
                        $member_url = get_field('member_url');
                        $member_keys = get_the_terms(get_the_ID(), 'members_keys');
                    ?>
                
                        <a href="<?php echo $member_url; ?>" class="members__filters-results-item">
                            <div class="members__filters-results-item-logo">
                                <img alt="<?php the_title(); ?>" src="<?php echo $member_logo; ?>" />
                            </div>
                            <?php if ($member_keys && !is_wp_error($member_keys)) : ?>
                                <div class="members__filters-results-item-keys">
                                    <?php foreach ($member_keys as $key) : 
                                        // Get the 'colour' custom field associated with this term
                                        $colour = get_field('colour', 'members_keys_' . $key->term_id);
                                    ?>
                                        <div class="members__filters-results-item-keys-item" style="color: <?php echo esc_attr($colour); ?>;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path fill="<?php echo esc_attr($colour); ?>" d="M0 0h20v20H0z" data-name="Rectangle 39"/><path fill="#fff" d="m15.572 5.815-1.015-1.323a.608.608 0 0 0-1.014 0L8.65 10.886 6.457 8.014a.608.608 0 0 0-1.014 0L4.432 9.338a1.056 1.056 0 0 0-.209.662 1.055 1.055 0 0 0 .209.661l2.7 3.523 1.01 1.324a.608.608 0 0 0 1.014 0l1.015-1.324 5.4-7.046a1.056 1.056 0 0 0 .209-.662 1.056 1.056 0 0 0-.209-.662" data-name="Path 10"/></svg>
                                           <span class="sr-only"><?php echo esc_html($key->name); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </a>
                <?php endwhile; ?>
           <?php else : ?>
                <p>No members found.</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('filter-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting the traditional way

        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('members-results').innerHTML = xhr.responseText;

                // Update filter info text box
                var selectedFilters = [];
                var checkboxes = document.querySelectorAll('input[name="members_category[]"]:checked');
                checkboxes.forEach(function(checkbox) {
                    selectedFilters.push(checkbox.nextElementSibling.nextElementSibling.textContent.trim());
                });

                if (selectedFilters.length > 0) {
                    document.getElementById('filter-info').innerText = 'Showing results for: ' + selectedFilters.join(', ');
                } else {
                    document.getElementById('filter-info').innerText = 'Showing all members';
                }
            }
        };
        formData.append('action', 'filter_members'); // Add action for WP to handle
        xhr.send(formData);
    });

    document.getElementById('reset-button').addEventListener('click', function() {
        // Clear all checkboxes
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });

        // Create a new FormData object with no selections
        var formData = new FormData();
        formData.append('action', 'filter_members'); // Ensure the same action is used

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('members-results').innerHTML = xhr.responseText;

                // Update filter info text box to default
                document.getElementById('filter-info').innerText = 'Showing all members';
            }
        };
        xhr.send(formData); // Send the empty formData to reset the view
    });

    </script>

    <div  class="members__categories">


    <?php
        // Get all custom taxonomy terms
        $categoryTerms = get_terms(array(
            'taxonomy' => 'members_category',
            'hide_empty' => true,
        ));

        if ( !empty( $categoryTerms ) && !is_wp_error( $categoryTerms ) ) : ?>
            <div class="members__categories-grid">
                <?php foreach ( $categoryTerms as $categoryTerm ) : 
                    // Get the 'category_image' ACF field for the current term
                    $category_image = get_field('category_image', 'members_category_' . $categoryTerm->term_id);
                ?>

               
                        <a href="<?php echo esc_url( get_term_link( $categoryTerm ) ); ?>" class="members__categories-grid-item">

                            <h2 class="members__categories-grid-item-title"><?php echo esc_html( $categoryTerm->name ); ?></h2>

              
                                <?php if (is_array($category_image) && isset($category_image['url'])) : ?>
                                    <div class="members__categories-grid-item-image">
                                        <img src="<?php echo esc_url( $category_image['url'] ); ?>" alt="<?php echo esc_attr( $category_image['alt'] ); ?>" />
                                    </div>
                                <?php else : ?>
                                    <div class="members__categories-grid-item-image"><span class="sr-only">Overlay</span></div>
                                <?php endif; ?>
                       

                        </a>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p><?php esc_html_e( 'No members categories found.', 'text-domain' ); ?></p>
        <?php endif; ?>

    </div>

    <?php
        // Get all custom taxonomy terms
        $membershipKeys = get_terms(array(
            'taxonomy' => 'members_keys',
            'hide_empty' => true,
        ));
    ?>

    <div class="members__keys">
        <h3>Membership Keys</h3>

        <?php
    // Get all custom taxonomy terms
    $categoryKeys = get_terms(array(
        'taxonomy' => 'members_keys',
        'hide_empty' => true,
    ));

    if ( !empty($categoryKeys) && !is_wp_error($categoryKeys) ) : ?>
        <div class="members__keys-grid">
            <?php foreach ( $categoryKeys as $categoryKey ) : 

                $key_colour = get_field('colour', 'members_keys_' . $categoryKey->term_id);
                ?>

                <div class="members__keys-grid-item">
                <div class="members__keys-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                        <path fill="<?php echo esc_attr($key_colour); ?>" d="M0 0h20v20H0z" data-name="Rectangle 39"/>
                        <path fill="#fff" d="m15.572 5.815-1.015-1.323a.608.608 0 0 0-1.014 0L8.65 10.886 6.457 8.014a.608.608 0 0 0-1.014 0L4.432 9.338a1.056 1.056 0 0 0-.209.662 1.055 1.055 0 0 0 .209.661l2.7 3.523 1.01 1.324a.608.608 0 0 0 1.014 0l1.015-1.324 5.4-7.046a1.056 1.056 0 0 0 .209-.662 1.056 1.056 0 0 0-.209-.662" data-name="Path 10"/>
                    </svg>
                </div>

                    <div class="members__keys-grid-item-main" style="background-color: <?php echo esc_attr($key_colour); ?>;">
                        <h2 class="members__keys-grid-item-main-title"><?php echo esc_html( $categoryKey->name ); ?></h2>
                    </div>

                    <div class="members__keys-grid-item-secondary" style="background-color: <?php echo esc_attr(lighten_color($key_colour, 80)); ?>;">
                        <?php if( have_rows('requirements', 'members_keys_' . $categoryKey->term_id) ): ?>
                        
                            <?php while( have_rows('requirements', 'members_keys_' . $categoryKey->term_id) ): the_row(); 
                                $requirement = get_sub_field('requirement');
                                ?>
                                <p><?php echo esc_html($requirement); ?></p>
                            <?php endwhile; ?>
            
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    <?php else : ?>
        <p><?php esc_html_e( 'No membership keys found.', 'text-domain' ); ?></p>
    <?php endif; ?>


    </div>

    </div>

</main>

<?php get_footer(); ?>
