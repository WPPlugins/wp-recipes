<div class="my_meta_control">
  <p>
	  <em>Total instruction: <? echo count($meta['recipeInstruction']); ?></em><br />
<!--    <pre><? print_r($meta['recipeInstruction']); ?></pre> -->
  </p>

  <table cellpadding="0" cellpadding="0" id="instructions">
    <tr>
      <th class="colInstrItem">#</th>
      <th class="colInstrTitle">Title</th>
      <th class="colInstrActions"></th>
    </tr>
<?
  if($meta['recipeInstruction']){
    $item = 1;
    foreach ($meta['recipeInstruction'] as $key=>$value) {
?>
    <tr id="instruction-<? echo $key; ?>">
      <td class="colInstrItem"><? echo $item; ?></td>
      <td class="colInstrTitle">
        <input type="text" class="instrTitle" name="_my_meta[recipeInstruction][<? echo $key; ?>][title]" value="<?php if(!empty($meta['recipeInstruction'][$key][title])) echo $meta['recipeInstruction'][$key][title]; ?>"/>
      </td>
      <td class="colInstrActions">
        <button class="instructionDelete">X</button>
      </td>
    </tr>
<?
  //  echo $key . " - " . $value[amount] . " - " . $value[unit] . " - " . $value[title] . "<br />";
      $item++;
    }
  }
  else {
?>
    <tr id="ingredient-1">
      <td class="colInstrItem">1</td>
      <td class="colInstrTitle">
        <input type="text" class="instrTitle" name="_my_meta[recipeInstruction][1][title]" value=""/>
      </td>
      <td class="colInstrActions">
        <button class="instructionDelete">X</button>
      </td>
    </tr>
<?
  }
?>
  </table>
  <button id="instructionAdd">Add instruction</button>

  <script type="text/javascript">
    jQuery("button.instructionDelete").live('click', function() {
      if (jQuery("table#instructions tr").length <= 2) {
        alert("At least one instruction is needed!");
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


    jQuery("button#instructionAdd").live('click', function() {
      var instrLastID = parseInt(jQuery("table#instructions tr").last().attr("id").replace("instruction-", ""));
      var instrLastNo = parseInt(jQuery("table#instructions tr").last().find("td.colInstrItem").text());
      var instrNewID = parseInt(instrLastID+1);

      var newRow =  '\
        <tr id="instruction-' + instrNewID + '">\
          <td class="colInstrItem">' + parseInt(instrLastNo+1) + '</td>\
          <td class="colInstrTitle">\
            <input type="text" class="instrTitle" name="_my_meta[recipeInstruction][' + instrNewID + '][title]" value="">\
          </td>\
          <td class="colInstrActions">\
            <button class="instructionDelete">X</button>\
          </td>\
        </tr>\
      ';

//      alert(newRow)
//      alert("last ingredient id: " + instrLastID + "\nnew ingredient id: " + instrNewID)

      jQuery("table#instructions tbody").append(newRow);
      return false;
    })
  </script>

</div>