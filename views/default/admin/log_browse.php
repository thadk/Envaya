<div class='padded'>
<div id="logbrowser_search_area">
<?php
	
    if ($vars['timelower']) {
        $lowerval = date('r',$vars['timelower']);
    } else {
        $lowerval = "";
    }
    if ($vars['timeupper']) {
        $upperval = date('r',$vars['timeupper']);
    } else {
        $upperval = "";
    }
    if ($vars['user_guid']) {
        if ($user = User::get_by_guid($vars['user_guid']))
            $userval = $user->username;
    } else {
        $userval = "";
    }	

    $form = "";
    
    $form .= "<p>" . __('logbrowser:user');
    $form .= view('input/text',array(
        'name' => 'search_username',
        'value' => $userval 
    )) . "</p>";

    $form .= "<p>" . __('logbrowser:starttime');
    $form .= view('input/text',array(
        'name' => 'timelower',
        'value' => $lowerval 
    )) . "</p>";

    $form .= "<p>" . __('logbrowser:endtime');
    
    $form .= view('input/text',array(
        'name' => 'timeupper',
        'value' => $upperval
    ))  . "</p>";
    
    $form .= view('input/submit',array(
        'value' => __('search')
    ));
                                                
    $wrappedform = view('input/form',array(
        'body' => $form,
        'method' => 'get',
        'action' => Config::get('url') . "admin/logbrowser"
    ));

    if ($upperval || $lowerval || $userval) {
        $hidden = "";
    } else {
        $hidden = "style=\"display:none\"";
    }
										
?>

		<div id="logbrowserSearchform" <?php echo $hidden; ?>><?php echo $wrappedform; ?></div>
		<p>
			<a href="javascript:void(0)" onclick="$('logbrowserSearchform').style.display='block'"><?php echo __('logbrowser:search'); ?></a>
		</p>
	</div>
</div>
<?php
    echo view('pagination', $vars);
?>
<table class="log_entry">
<?php
    foreach ($vars['entries'] as $entry)
    {
        echo view("admin/log_entry", array('entry' => $entry));
    }
?>
</table>
