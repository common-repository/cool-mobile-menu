<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="wrap">

<?php
if(current_user_can('manage_options')):

$optset = 0; $stky_option = array();
$mid = $mw = $mp = $mpl = $mpr = '';


if(isset($_POST['_ricmmnonce']) && wp_verify_nonce( $_POST['_ricmmnonce'], 'ricmm-nonce' )){
	$riupdate = array();
	if($_POST['menuids']!=''){ $riupdate['menuids'] = absint($_POST['menuids']); }else{ $riupdate['menuids'] = ''; }
	if ( strlen( $_POST['minwidth'] ) < 5 ) { $riupdate['minwidth'] = intval($_POST['minwidth']); }
	if ( strlen( $_POST['ptop'] ) < 4 ) { $riupdate['ptop'] = intval($_POST['ptop']); }
	if ( strlen( $_POST['pleft'] ) < 4 ) { $riupdate['pleft'] = intval($_POST['pleft']); }
	if ( strlen( $_POST['pright'] ) < 4 ) { $riupdate['pright'] = intval($_POST['pright']); }
	
	update_option( 'ri_mobile_menu_id', serialize($riupdate) );
}else{   }

if(get_option( 'ri_mobile_menu_id' )){
	$stky_option = unserialize(get_option( 'ri_mobile_menu_id' ));
	$optset = 1;
	$mid = $stky_option['menuids'];
	$mw = $stky_option['minwidth'];
	$mp = $stky_option['ptop'];
	$mpl = $stky_option['pleft'];
	$mpr = $stky_option['pright'];
}
else{ if(add_option( 'ri_mobile_menu_id' )){  } }
?><form action="" method="post">
	<table class="manage-social wp-list-table widefat fixed striped pages">
    <thead>
    	<tr><td class="column-date"> </td> <td>  </td></tr>
    </thead>
    <tbody>
    	<tr>
        	<td> Mobile Menu : </td> 
            <td> 
            	<select name="menuids" >
                	<option value="">Select Menu</option>
                    <?php
						$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
						foreach ( $menus as $k => $menu ) {
							$sel = '';
							if($menu->term_id==$mid){ $sel = 'selected="selected"'; }
							echo '<option '.$sel.' value="'.$menu->term_id.'">'.$menu->name.'</option>';
						}
					?>
                </select>
            
            	<input type="hidden" name="_ricmmnonce" value="<?php echo wp_create_nonce( 'ricmm-nonce' ); ?>" />
            </td>
        </tr>
        <tr>
        	<td>Maximum device width :</td> <td> <input type="text" name="minwidth" placeholder="in px, eg : 640" value="<?php echo $mw; ?>" />PX</td>
        </tr>
        <tr>
        	<td>Position from top : </td><td> <input type="text" name="ptop" placeholder="in px, eg : 10" value="<?php echo $mp; ?>" />PX </td>
        </tr>
        <tr>
        	<td>Position from left : </td><td> <input type="text" name="pleft" placeholder="in px, eg : 10" value="<?php echo $mpl; ?>" />PX </td>
        </tr>
        <tr>
        	<td>Position from right : </td><td> <input type="text" name="pright" placeholder="in px, eg : 10" value="<?php echo $mpr; ?>" />PX </td>
        </tr>
    </tbody>
    <tfoot><tr> <td colspan="2"><input type="submit" name="ssn" value="Save" /></td></tr></tfoot>
    </table>
    </form>
    <div class="ri_mobile_menu_op">
        <ul>
            
        </ul>
    </div>
    <?php endif; ?>
</div>