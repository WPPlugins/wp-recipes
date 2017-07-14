<? include($_SERVER['DOCUMENT_ROOT'] . "/wp-content/plugins/42A-recipes/42A-recipes-data.php"); ?>
<div class="my_meta_control">

  <label for="_my_meta[recipeCourse]">Course Type</label>
  <p>
    <select name="_my_meta[recipesCourseType]" id="_my_meta[recipesCourseType]">
      <option value="">Select Course Type</option>
<? foreach ($recipesCourseType as $key=>$value) { ?>
      <option<?php if($meta['recipesCourseType'] == $key){ echo " selected=\"selected\" ";} ?> value="<? echo $key ?>"><? echo $value ?></option>
<? } ?>
    </select>
  </p>

  <label for="_my_meta[recipeServings]">Number of servings: <strong id="inputRecipeServings"><? if(isset($meta['recipeServings'])){ echo $meta['recipeServings'];} else {echo "1";} ?></strong> <em>(persons)</em></label>
  <p>
    <input type="range" step="1" class="range servings" value="<? if(!isset($meta['recipeServings'])){ echo"1"; } else { echo $meta['recipeServings'];} ?>" min="1" max="10" name="_my_meta[recipeServings]" id="_my_meta[recipeServings]" />
    <script type="text/javascript">
      jQuery("input.servings").change(function(){
        jQuery("#inputRecipeServings").text(jQuery(this).val())
      })
    </script>
  </p>

  <label for="_my_meta[recipeTimePrep]">Preparing time: <strong id="inputRecipeTimePrep"><? if(isset($meta['recipeTimePrep'])){ echo $meta['recipeTimePrep'];} else {echo "0";} ?></strong> <em>(minutes)</em></label>
  <p>
    <input type="range" step="15" class="range timePrep" value="<? if(!isset($meta['recipeTimePrep'])){ echo"0"; } else { echo $meta['recipeTimePrep'];} ?>" min="0" max="240" name="_my_meta[recipeTimePrep]" id="_my_meta[recipeTimePrep]" />
    <script type="text/javascript">
      jQuery("input.timePrep").change(function(){
        jQuery("#inputRecipeTimePrep").text(jQuery(this).val())
      })
    </script>
  </p>

  <label for="_my_meta[recipeTimeCook]">Cooking time: <strong id="inputRecipeTimeCook"><? if(isset($meta['recipeTimeCook'])){ echo $meta['recipeTimeCook'];} else {echo "0";} ?></strong> <em>(minutes)</em></label>
  <p>
    <input type="range" step="15" class="range timeCook" value="<? if(!isset($meta['recipeTimeCook'])){ echo"0"; } else { echo $meta['recipeTimeCook'];} ?>" min="0" max="240" name="_my_meta[recipeTimeCook]" id="_my_meta[recipeTimeCook]" />
    <script type="text/javascript">
      jQuery("input.timeCook").change(function(){
        jQuery("#inputRecipeTimeCook").text(jQuery(this).val())
      })
    </script>
  </p>

  <label for="_my_meta[recipeRating]">Rating: <strong id="inputRecipeRating"><? if(isset($meta['recipeRating'])){ echo $meta['recipeRating'];} else {echo "1";} ?></strong> <em>(stars)</em></label>
  <p>
    <input type="range" step="1" class="range rating" value="<? if(!isset($meta['recipeRating'])){ echo"1"; } else { echo $meta['recipeRating'];} ?>" min="1" max="5" name="_my_meta[recipeRating]" id="_my_meta[recipeRating]" />
    <script type="text/javascript">
      jQuery("input.rating").change(function(){
        jQuery("#inputRecipeRating").text(jQuery(this).val())
      })
    </script>
  </p>

</div>