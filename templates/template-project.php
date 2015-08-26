<?php 
if ($user = $this->getVar('user')) include_once 'template-header.php'; else include_once 'template-header-guest.php';
$info= $this->getVar('info');
?>

<div id="main">
  <div class="container-fluid" id="main_frame">
    <div class="row">
      <div class="col-md-12">
        <div class="card" id="project_card">
          <div id="project_card_menu"><i class="fa fa-cubes"></i> <span id="project_card_menu_title"><?php echo $info['basicInfo']['name']; ?></span>
            <div id="project_card_menu_buttons"> <a href="<?php echo 'edit-entity/' . $info['basicInfo']['id'] ?>"><i class="fa fa-pencil"></i></a> </div>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-8">
                <div class="row">
                  <div class="col-lg-12">
                    <div id="project_information_card" class="card">
                      <div class="card_top"> <span class="card_title"><i class="fa fa-leaf"></i> INFORMATION<br>
                        </span> </div>
                      <div class="card_content">
                        <div style="color:#4F4F4F;"> <span style="font-size:22.5px; margin-bottom:8px; display: block;"><?php echo $info['basicInfo']['name']; ?><br>
                          </span> <span style="color:#7D7D7D; font-size:15px;"><?php echo $info['event']['name']; ?> - <?php echo $info['entityGroup']['name']; ?></span>
                          <hr>
                          <div style="padding:20px 15px 0 15px;">
                            <div class="project_information_card_attribute"> <span class="project_information_card_attribute_title">DESCRIPTION <i class="fa fa-chevron-up"></i></span> <span class="project_information_card_attribute_content">
                              <?php 
							 if ($info['basicInfo']['description']) echo $info['basicInfo']['description']; else echo 'No description available at the moment.';
							 ?>
                              </span>
                              <?php if ($info['additionalAttributes']) echo '<hr>'; ?>
                            </div>
                            <?php
							if ($info['additionalAttributes']) {
								$count = count($info['additionalAttributes']);
								for ($i = 0; $i < $count; $i++) {
									echo '<div class="project_information_card_attribute"> <span class="project_information_card_attribute_title">';
									echo $info['additionalAttributes'][$i]['name'];
									echo ' <i class="fa fa-chevron-up"></i></span> <span class="project_information_card_attribute_content">';
									echo $info['additionalAttributes'][$i]['value'];
									echo '</span></div>';
									if ($i < $count - 1) echo '<hr>';
								}
							}
						?>
                          </div>
                        </div>
                      </div>
                      <div class="bottom"> </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div id="media_card" class="card">
                      <div class="card_top"> <span class="card_title"><i class="fa fa-film"></i> MEDIA</span> </div>
                      <div class="card_content">
                        <div id="card_no_contents">NO MEDIA AVAILABLE</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div id="group_members_card" class="card">
                  <div class="card_top"> <span class="card_title"><i class="fa fa-users"></i> GROUP MEMBERS</span> </div>
                  <div class="card_content">
                    <ul id="group_members_card_member_list">
                      <?php
						if ($info['users']) {
							$count = count($info['users']);
							for ($i = 0; $i < $count; $i++) {
								echo '<li>' . $info['users'][$i]['fullname'] . '<br><span style="color:grey; font-size:14px;">' . $info['users'][$i]['role']['name'] . '</span></li>';
								if ($i < $count - 1) echo '<hr>';
							}
						} else {
							echo '<div id="card_no_contents">NO INFORMATION AVAILABLE</div>';
						}
						?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
