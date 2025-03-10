<?php if ( get_row_layout() == 'team_members_block' ) : ?>
<div class="page-builder-block">
    <div class="page-builder-block-wrapper">
        <div class="team-members-block">
            <div class="team-members-block__wrapper">
                <?php if(get_sub_field('block_title')) : ?>
                    <h2 class="team-members-block__title" data-aos="fade-up"><?php echo get_sub_field('block_title'); ?></h2>
                <?php endif; ?>


                <?php if( have_rows('team_members') ): ?>
                    <div class="team-members-block__grid">
                        <?php while( have_rows('team_members') ): the_row(); 
                            $name = get_sub_field('name');
                            $image = get_sub_field('image');
                            $email = get_sub_field('email');
                            $role = get_sub_field('role');
                            $bio = get_sub_field('bio');
                        ?>
                        <?php if($email) : ?>
                            <a href="mailto:<?php echo $email; ?>" class="team-members-block__item" data-aos="fade-up">
                        <?php else : ?>
                            <div class="team-members-block__item" data-aos="fade-up">
                        <?php endif; ?>
                        
                            <?php if($image) : ?>
                                <div class="team-members-block__item-image">
                                    <img alt="" src="<?php echo $image; ?>"/>
                                    <?php if($email) : ?>
                                        <div class="team-members-block__item-email">
                                            <?php load_inline_svg('email')?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                                <div class="team-members-block__item-text">
                                    <?php if($name) : ?>
                                        <h4 class="team-members-block__item-name"><?php echo $name; ?></h4>
                                    <?php endif; ?>
                                    <?php if($role) : ?>
                                        <p class="team-members-block__item-role"><?php echo $role; ?></p>
                                    <?php endif; ?>
                                    <?php if($bio) : ?>
                                        <button class="team-members-block__item-bio-open">Read bio</button>
                                        <div class="team-members-block__item-bio user-content">
                                            <button class="team-members-block__item-bio-close">
                                                <span class="sr-only">Close overlay</span>
                                                <?php load_inline_svg('close')?>
                                            </button>
                                            <?php echo $bio; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            <?php if($email) : ?>
                                </a>
                            <?php else : ?>
                                </div>
                            <?php endif; ?>
                        
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div> 
        </div>
    </div>
</div>


<script>

    let teamMembersBlock = document.querySelectorAll('.team-members-block__item');

    for(let tmb = 0; tmb < teamMembersBlock.length; tmb++){
        let bioOpen = teamMembersBlock[tmb].querySelector('.team-members-block__item-bio-open');
        let bio = teamMembersBlock[tmb].querySelector('.team-members-block__item-bio');
        let bioClose = teamMembersBlock[tmb].querySelector('.team-members-block__item-bio-close');

        bioOpen.addEventListener('click', function(){
            bio.classList.add('visible');
        });

        bioClose.addEventListener('click', function(){
            bio.classList.remove('visible');
        });
    }

</script>
<?php endif; ?>
