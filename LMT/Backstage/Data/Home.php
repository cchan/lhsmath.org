<?php
/*
 * LMT/Backstage/Data/Home.php
 * LHS Math Club Website
 *
 * Displays a home page for the data section
 */

require_once '../../../.lib/lmt-functions.php';
backstage_access();

show_page();





function show_page() {
	global $body_onload;
	$body_onload = 'document.forms[\'lmtSearchAll\'].Query.focus()';
	
	global $jquery_function;
	$jquery_function = <<<HEREDOC
      //<![CDATA[
      $.widget( "custom.catcomplete", $.ui.autocomplete, {
        _renderMenu: function( ul, items ) {
          var self = this,
          currentCategory = "";
          $.each( items, function( index, item ) {
            if ( item.category != currentCategory ) {
              ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
              currentCategory = item.category;
            }
            self._renderItem( ul, item );
          });
        }
      });
      $(function() {
        $( "#autocomplete" ).catcomplete({
          source: "../Autocomplete?School&Team&Individual"
        });
      });
      //]]>
HEREDOC;
	
	lmt_page_header('Data Home');
	echo <<<HEREDOC
      <h1>Data Home</h1>
      
      <div class="text-centered b">WARNING: Please be careful when changing information through the Data pages.
      When in doubt (or if you think you might have messed something up), ask the Tech Czar.</div>
      
      <h3>Search</h3>
      <form id="lmtSearchAll" method="get" action="../Search"><div>
        <input type="text" id="autocomplete" name="Query" size="35" />
        <input type="hidden" name="Scope" value="School Team Individual" />
        <input type="hidden" name="From" value="Data Home" />
        <input type="hidden" name="Return" value="Data" />
        <input type="submit" value="Search" />
      </div></form>
      
      <h3>View Data</h3>
      <table class="contrasting">
        <tr><td><a href="List?Schools">Schools &amp; Coaches</a></td></tr>
        <tr><td><a href="List?Teams">Teams</a></td></tr>
        <tr><td><a href="List?Individuals">All Individuals</a></td></tr>
        <tr><td><a href="List?Unaffiliated">Unaffiliated Individuals</a></td></tr>
      </table>
      
      <h3 class="smbottom">Add</h3>
      <span class="small b" style="color: #d00;">(Can cause major problems. Ask the Tech Czar first, really!)</span>
      <div class="halfbreak"></div>
      ...<a href="Add?School">a School</a><br />
      ...<a href="Add?Team">a Team</a><br />
      ...<a href="Add?Individual">an Individual</a><br />
      ...<a href="Undelete">Undelete</a>
HEREDOC;
}

?>