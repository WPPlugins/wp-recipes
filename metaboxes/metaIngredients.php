<? include($_SERVER['DOCUMENT_ROOT'] . "/wp-content/plugins/42A-recipes/42A-recipes-data.php"); ?>
<div class="my_meta_control">
  <p>
	  <em>Total ingredients: <? echo count($meta['recipeIngredient']); ?></em><br />
<!--    <pre><? print_r($meta['recipeIngredient']); ?></pre> -->
  </p>

  <table cellpadding="0" cellpadding="0" id="ingredients">
    <tr>
      <th class="colIngrAmount">Amount</th>
      <th class="colIngrUnit">Unit</th>
      <th class="colIngrTitle">Title</th>
      <th class="colIngrActions"></th>
    </tr>
<?
  if($meta['recipeIngredient']){
    foreach ($meta['recipeIngredient'] as $key=>$value) {
?>
    <tr id="ingredient-<? echo $key; ?>">
      <td class="colIngrAmount">
        <input type="text" class="ingredAmount" name="_my_meta[recipeIngredient][<? echo $key; ?>][amount]" value="<?php if(!empty($meta['recipeIngredient'][$key][amount])) echo $meta['recipeIngredient'][$key][amount]; ?>"/>
      </td>
      <td class="colIngrUnit">
        <select name="_my_meta[recipeIngredient][<? echo $key; ?>][unit]" id="_my_meta[recipeIngredient][<? echo $key; ?>][unit]" class="ingredUnit">
          <option value="">Select Unit</option>
<? foreach ($recipesUnits as $unitKey=>$unitValue) { ?>
          <option<?php if($meta['recipeIngredient'][$key][unit] == $unitKey){ echo " selected=\"selected\" ";} ?> value="<? echo $unitKey ?>"><? echo $unitValue ?></option>
<? } ?>
        </select>
      </td>
      <td class="colIngrTitle">
        <input type="text" class="ingredTitle" name="_my_meta[recipeIngredient][<? echo $key; ?>][title]" value="<?php if(!empty($meta['recipeIngredient'][$key][title])) echo $meta['recipeIngredient'][$key][title]; ?>"/>
      </td>
      <td class="colIngrActions">
        <button class="ingredientDelete">X</button>
      </td>
    </tr>
<?
    }
  }
  else {
?>
    <tr id="ingredient-1">
      <td class="colIngrAmount">
        <input type="text" class="ingredAmount" name="_my_meta[recipeIngredient][1][amount]" value=""/>
      </td>
      <td class="colIngrUnit">
        <select class="ingredAmount" name="_my_meta[recipeIngredient][1][unit]" id="_my_meta[recipeIngredient][1][unit]">
          <option value="">Select Unit</option>
<? foreach ($recipesUnits as $key=>$value) { ?>
          <option value="<? echo $key ?>"><? echo $value ?></option>
<? } ?>
        </select>
        <input type="hidden" class="ingredUnit" name="_my_meta[recipeIngredient][1][unit]" value=""/>
      </td>
      <td class="colIngrTitle">
        <input type="text" class="ingredTitle" name="_my_meta[recipeIngredient][1][title]" value=""/>
      </td>
      <td class="colIngrActions">
        <button class="ingredientDelete">X</button>
      </td>
    </tr>
<?
  }
?>
  </table>
  <button id="ingredientAdd">Add ingredient</button>

  <script type="text/javascript">
    jQuery("button.ingredientDelete").live('click', function() {
      if (jQuery("table#ingredients tr").length <= 2) {
        alert("At least one ingredient is needed!");
      }
      else {
//        alert("Deleted :)");
        jQuery(this).parent().parent().addClass("delete");
        jQuery(this).parent().parent().fadeOut('20000', function(){
          jQuery(this).find("input").val("");
        });
      }
      return false;
    }); 


    jQuery("button#ingredientAdd").live('click', function() {
      var ingrLastID = parseInt(jQuery("table#ingredients tr").last().attr("id").replace("ingredient-", ""));
      var ingrNewID = parseInt(ingrLastID+1);

      var newRow =  '\
        <tr id="ingredient-' + ingrNewID + '">\
          <td class="colIngrAmount">\
            <input type="text" class="ingredAmount" name="_my_meta[recipeIngredient][' + ingrNewID + '][amount]" value="">\
          </td>\
          <td class="colIngrUnit">\
            <select name="_my_meta[recipeIngredient][' + ingrNewID + '][unit]" id="_my_meta[recipeIngredient][' + ingrNewID + '][unit]" class="ingredUnit">\
              <option value="">Select Unit</option>\
<? foreach ($recipesUnits as $unitKey=>$unitValue) { ?>
              <option value="<? echo $unitKey ?>"><? echo $unitValue ?></option>\
<? } ?>
            </select>\
          </td>\
          <td class="colIngrTitle">\
            <input type="text" class="ingredTitle" name="_my_meta[recipeIngredient][' + ingrNewID + '][title]" value="">\
          </td>\
          <td class="colIngrActions">\
            <button class="ingredientDelete">X</button>\
          </td>\
        </tr>\
      ';

//      alert(newRow)
//      alert("last ingredient id: " + ingrLastID + "\nnew ingredient id: " + ingrNewID)

      jQuery("table#ingredients tbody").append(newRow);
      return false;
    })
  </script>

</div>