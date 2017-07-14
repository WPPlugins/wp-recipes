<?php get_header(); ?>

		<div id="container">
			<div id="content" role="main">


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<? $meta_values = get_post_meta(get_the_ID(), "_my_meta", true); ?>

        <div id="nav-above" class="navigation">
          <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
          <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
        </div>

        <div id="post-<?php the_ID(); ?>" class="hrecipe">
          <h1 class="entry-title summary fn"><?php the_title(); ?></h1>
					<div class="entry-meta">
            Waardering: <abbr class="rating" title="<? echo $meta_values["recipeRating"]; ?>"><? echo $meta_values["recipeRating"]; ?></abbr> | 
            Gang: <? echo $meta_values["recipesCourseType"]; ?> | 
            Aantal personen: <? echo $meta_values["recipeServings"]; ?> | 
            Voorbereiding: <? echo $meta_values["recipeTimePrep"]; ?> min. | 
            Kooktijd: <? echo $meta_values["recipeTimeCook"]; ?> min.
            <br />
<?php echo get_the_term_list(get_the_ID(), 'origin', 'Herkomst: ', ' &raquo; ', ''); ?>
             | 
<?php echo get_the_term_list(get_the_ID(), 'mealtype', 'Type gerecht: ', ' &raquo; ', ''); ?>
					</div><!-- .entry-meta -->

          <div class="entry-content">
<?php the_post_thumbnail(); ?>
            <?php the_content(); ?>

            <h3>Ingredienten:</h3>
            <ul>
<?
  if($meta_values['recipeIngredient']){
    foreach ($meta_values['recipeIngredient'] as $key=>$value) {
?>
              <li><?
  echo $meta_values['recipeIngredient'][$key][amount] . " ";
  include($_SERVER['DOCUMENT_ROOT'] . "/wp-content/plugins/42A-recipes/42A-recipes-data.php");
  foreach ($recipesUnits as $unitKey=>$unitValue) { 
    if($unitKey == $meta_values['recipeIngredient'][$key][unit]){
      if($unitValue != "Stuk"){
        echo $unitValue . " ";
      }
    }
  } 
  echo $meta_values['recipeIngredient'][$key][title];
?></li>
<?
    }
  }
?>
            </ul>

            <h3>Bereidingswijze:</h3>
            <ol>
<?
  if($meta_values['recipeInstruction']){
    foreach ($meta_values['recipeInstruction'] as $key=>$value) {
?>
              <li><? echo $meta_values['recipeInstruction'][$key][title]; ?></li>
<?
    }
  }
?>
            </ol>


          </div><!-- .entry-content -->

          <div class="entry-utility">
            <?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
          </div>
        </div>

        <div id="nav-below" class="navigation">
          <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
          <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
        </div>

<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
